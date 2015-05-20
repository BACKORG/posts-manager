<?php

namespace app\modules\social\controllers;

class RedditController extends CommonController{
    private $_output = ['error' => false];

    private $_reddit;

    /**
     * initialization controller
     * @return [type] [description]
     */
    public function init(){
        // overload parent controller
        parent::init();

        $this->_reddit = new \zhexiao\reddit\zxReddit(\Yii::$app->params['REDDIT_CLIENT_ID'], \Yii::$app->params['REDDIT_CLIENT_SECRET'], \Yii::$app->params['REDDIT_REDIRECT_URL']);
    }

    /**
     * connect social account
     * @return [type] [description]
     */
    public function actionConnect(){
        $authLink = $this->_reddit->authLink();

        $this->redirect($authLink);
    }

    /**
     * save access token
     * @return [type] [description]
     */
    public function actionAuth($code){
        $tokenData = $this->_reddit->getToken($code);

        $user = $this->_reddit->get([
            'link' => '/api/v1/me',
            'token' => $tokenData->access_token
        ]);


        // check this ip already exist or not
        $data = $this->getData();
        if($data){
            // remove and re-insert data
            $this->removeData($data['_id']);
            $insertData = $data['socialData'];
        }

        $uname = $user['name'];
        $insertData['reddit_'.$uname] = $user;
        $insertData['reddit_'.$uname]['type'] = 'reddit';
        $insertData['reddit_'.$uname]['access_token'] = $tokenData->access_token;
        $insertData['reddit_'.$uname]['refresh_token'] = $tokenData->refresh_token;

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
            
            $posts = $this->_reddit->get([
                'link' => '/user/'.$socialInfo['name'].'/submitted',
                'token' => $socialInfo['access_token']
            ]);

            if(isset($posts['data']['children']) && count($posts['data']['children'])>0){
                $this->_output['data'] = $posts['data']['children'];
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
       
    }
}
