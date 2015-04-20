<?php

namespace app\controllers;

class GitController extends \yii\web\Controller{
    public $enableCsrfValidation = false;

    public function actionIndex(){
        exec("git pull", $output);
        var_dump($output);
    }

}
