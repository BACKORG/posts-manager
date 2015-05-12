<?php

namespace app\modules\social\controllers;

use yii\web\Controller;
use yii\mongodb\Query;

class CommonController extends Controller{
    // define session variable
    public $session;

    // define request variable
    public $request;

    // define mongodb collection
    public $mongoColl;

    public function init(){
        $this->session = \Yii::$app->session;
        $this->request = \Yii::$app->request;
        $this->mongoColl = \Yii::$app->mongodb->getCollection('social');
    }

    /**
     * check user ip exist or not
     * @return [type] [description]
     */
    public function getData(){
        $ip = \Yii::$app->request->userIp;
        $query = new Query;
        $data = $query->from('social')->where(['ip' => $ip])->one();

        return $data;
    }

    /**
     * remove data by mongo id
     * @param  [type] $_id [description]
     * @return [type]      [description]
     */
    public function removeData($_id){
        // remove document
        $this->mongoColl->remove([
            '_id' => $_id
        ]);
    }

    /**
     * insert new data to mongodb
     * @return [type] [description]
     */
    public function insertDb($parameter){
        $this->mongoColl->insert($parameter); 
    }
}
