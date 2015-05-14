<?php

namespace app\modules\social\controllers;

use yii\web\Controller;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;

class FacebookController extends CommonController{
    private $_output = ['error' => false];

    private $_fb_session;

    /**
     * initialization controller
     * @return [type] [description]
     */
    public function init(){
        // overload parent controller
        parent::init();
        // open ssession
        $this->session->open();

        // set app
        FacebookSession::setDefaultApplication(\Yii::$app->params['FACEBOOK_APP_ID'], \Yii::$app->params['FACEBOOK_APP_SECRET']);
    }

    /**
     * link account
     * @return [type] [description]
     */
    public function actionConnect(){
        $helper = new FacebookRedirectLoginHelper(\Yii::$app->params['FACEBOOK_REDIRECT_URL']);
        $loginUrl = $helper->getLoginUrl([
            'scope' => 'read_stream, manage_pages, publish_actions'
        ]);

        $this->redirect($loginUrl);
    }

    /**
     * auth account and save token
     * @return [type] [description]
     */
    public function actionAuth(){
        $helper = new FacebookRedirectLoginHelper(\Yii::$app->params['FACEBOOK_REDIRECT_URL'], \Yii::$app->params['FACEBOOK_APP_ID'], \Yii::$app->params['FACEBOOK_APP_SECRET']);

        try {
            $session = $helper->getSessionFromRedirect();
        } catch(FacebookSDKException $e) {
            $session = null;
        }

        if ($session) {
            // User logged in, get the AccessToken entity.
            $tokenObj = $session->getAccessToken(); 
            // Exchange the short-lived token for a long-lived token.
            $accessToken = (string) $tokenObj->extend();

            try {
                $me = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject()->asArray();
                $insertData = [];

                // check this ip already exist or not
                $data = $this->getData();
                if($data){
                    // remove and re-insert data
                    $this->removeData($data['_id']);
                    $insertData = $data['socialData'];
                }

                $insertData['facebook_'.$me['id']] = $me;
                $insertData['facebook_'.$me['id']]['type'] = 'facebook';
                $insertData['facebook_'.$me['id']]['access_token'] = $accessToken;

                // get this user's fanpage if exist
                $insertData = $this->getFacebookPages($session, $me['id'], $insertData);

                // insert into mongodb
                $this->insertDb([
                    'ip' => \Yii::$app->request->userIP, 
                    'socialData' => $insertData
                ]);

                $this->redirect('/');

            } catch(FacebookRequestException $ex) {
              // When Facebook returns an error
            } catch(\Exception $ex) {
              // When validation fails or other local issues
            }
        }
    }

    /**
     * get posts
     * @return [type] [description]
     */
    public function actionPosts($key){
        if( $this->setToken($key) ){
            try {
                $posts = (new FacebookRequest(
                    $this->_fb_session, 'GET', '/me/feed'
                ))->execute()->getGraphObject()->asArray();


                if(count($posts['data']) > 0){
                    $this->_output['data'] = $posts['data'];
                    $this->_output['next_page'] = isset($posts['paging']->next)? $posts['paging']->next:'';
                }else{
                    $this->_output['error'] = true;
                }

                // output json
                $this->outputJson($this->_output);
            } catch (FacebookRequestException $ex) {
                echo $ex->getMessage();
            } catch (\Exception $ex) {
                echo $ex->getMessage();
            }  
        }
    }

    /**
     * delete post
     * @return [type] [description]
     */
    public function actionDel(){
        if($this->request->isPost){
            $key = $this->request->post('key');
            $ids = $this->request->post('id');

            if(count($ids) > 0 && $this->setToken($key)){
                foreach ($ids as  $id) {
                    try {
                        $request = new FacebookRequest(
                            $this->_fb_session,
                            'DELETE',
                            $id
                        );
                        $request->execute();
                    } catch (FacebookRequestException $ex) {
                        echo $ex->getMessage();
                    } catch (\Exception $ex) {
                        echo $ex->getMessage();
                    } 
                }
            }
        }
    }

    /**
     * set facebook token from key
     */
    private function setToken($key){
        $data = $this->getData();
        if($data){
            $socialInfo = $data['socialData'][$key];
            try {
                $this->_fb_session = new FacebookSession($socialInfo['access_token']);

                return true;
            } catch (\Exception $ex) {
                return false;           
            }  
        }

        return false;
    }

    /**
     * get facebook fanpage data
     * @param  [type] $session    [description]
     * @param  [type] $userid     [description]
     * @param  [type] $insertData [description]
     * @return [type]             [description]
     */
    private function getFacebookPages($session, $userid, $insertData){
        $pages = (new FacebookRequest($session, 'GET', '/'.$userid.'/accounts'))->execute()->getGraphObject()->asArray();
        if(isset($pages['data']) && count($pages['data'])>0){
            foreach ($pages['data'] as $page) {
                $insertData['facebook_fanpage_'.$page->id] = (array) $page;
                $insertData['facebook_fanpage_'.$page->id]['type'] = 'facebook_fanpage';
            }
        }

        return $insertData;
    }
}
