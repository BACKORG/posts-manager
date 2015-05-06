<?php

namespace app\modules\social\controllers;

use yii\web\Controller;
use zhexiao;

class TwitterController extends CommonController{
    // define the codebird variable
    private $_codebird;

    /**
     * initialization controller
     * @return [type] [description]
     */
    public function init(){
        // overload parent controller
        parent::init();

        \zhexiao\twitter\Codebird::setConsumerKey(\Yii::$app->params['TWITTER_CONSUMER_KEY'], \Yii::$app->params['TWITTER_CONSUMER_SECRET']);

        $this->_codebird = \zhexiao\twitter\Codebird::getInstance();
    }

    /**
     * link twitter account
     * @return [type] [description]
     */
    public function actionLink(){
        $reply = $this->_codebird->oauth_requestToken(array(
            'oauth_callback' => \Yii::$app->params['TWITTER_CALLBACK_URL']
        ));

        // store the token
        $this->_codebird->setToken($reply->oauth_token, $reply->oauth_token_secret);

        $this->session->set('oauth_token_secret', $reply->oauth_token_secret);

        $auth_url = $this->_codebird->oauth_authorize();

        $this->redirect($auth_url);
    }

    /**
     * auth twitter account and save token
     * @return [type] [description]
     */
    public function actionAuth(){
        $oauth_token = $this->request->get('oauth_token');
        $oauth_verifier = $this->request->get('oauth_verifier');

        $oauth_secret = $this->session->get('oauth_token_secret');
        $this->_codebird->setToken($oauth_token, $oauth_secret);

        $res = $this->_codebird->oauth_accessToken(array(
            'oauth_verifier' => $oauth_verifier
        ));

        echo '<pre>';
        print_r($res);
    }
}
