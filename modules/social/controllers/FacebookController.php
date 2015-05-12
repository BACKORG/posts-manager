<?php

namespace app\modules\social\controllers;

use yii\web\Controller;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;

class FacebookController extends CommonController{

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
        $loginUrl = $helper->getLoginUrl();

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
                $data = $this->checkIpData();
                if($data){
                    $insertData = $data['socialData'];
                }

                $insertData['facebook_'.$me['id']] = $me;
                $insertData['facebook_'.$me['id']]['access_token'] = $accessToken;

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
}
