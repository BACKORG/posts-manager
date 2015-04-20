<?php

namespace app\controllers;

class GitController extends \yii\web\Controller{
    public $enableCsrfValidation = false;

    public function actionIndex(){
        system( escapeshellcmd("git pull") );
    }

}
