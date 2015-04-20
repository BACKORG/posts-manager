<?php

namespace app\controllers;

class GitController extends \yii\web\Controller{
    public function actionIndex(){
        echo '<pre>';
        print_r($_POST);
        return $this->render('index');
    }

}
