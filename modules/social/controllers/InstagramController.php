<?php

namespace app\modules\social\controllers;

class InstagramController extends CommonController implements SocialInterface{
    private $_output = ['error' => false];

    private $_instagram;

    /**
     * initialization controller
     * @return [type] [description]
     */
    public function init(){
        // overload parent controller
        parent::init();

        $this->_instagram = new \zhexiao\instagram\zxInstagram(\Yii::$app->params['INSTAGRAM_CLIENT_ID'], \Yii::$app->params['INSTAGRAM_CLIENT_SECRET'], \Yii::$app->params['INSTAGRAM_REDIRECT_URL']);
    }

    /**
     * connect social account
     * @return [type] [description]
     */
    public function actionConnect(){
        $authLink = $this->_instagram->authLink();

        $this->redirect($authLink);
    }

    /**
     * save access token
     * @return [type] [description]
     */
    public function actionAuth(){
        $code = $this->request->get('code');
        $res = $this->_instagram->authToken($code);
        $resJson = json_decode($res, true);

        // check this ip already exist or not
        $data = $this->getData();
        if($data){
            // remove and re-insert data
            $this->removeData($data['_id']);
            $insertData = $data['socialData'];
        }

        $uid = $resJson['user']['id'];
        $insertData['instagram_'.$uid] = $resJson['user'];
        $insertData['instagram_'.$uid]['type'] = 'instagram';
        $insertData['instagram_'.$uid]['access_token'] = $resJson['access_token'];

        // insert into mongodb
        $this->insertDb([
            'ip' => \Yii::$app->request->userIP, 
            'socialData' => $insertData
        ]);

        $this->redirect('/');
    }

    /**
     * get user posts
     * @return [type] [description]
     */
    public function actionPosts($key){
        $data = $this->getData();
        if($data){
            $socialInfo = $data['socialData'][$key];
            
            $posts = $this->_instagram->getMyPosts($socialInfo['id'], $socialInfo['access_token']);

            if(count($posts['data']) > 0){
                $this->_output['data'] = $posts['data'];
            }else{
                $this->_output['error'] = true;
            }

            // output json
            $this->outputJson($this->_output);
        }
    }

    /**
     * delete posts
     * @return [type] [description]
     */
    public function actionDel(){
        $this->_output['error'] = true;
        $this->_output['msg'] = "Sorry, Instagram doesn't support delete posts from API.";
        $this->outputJson($this->_output);
        exit();
    }
}
