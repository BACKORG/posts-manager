<?php

namespace app\controllers;

class GitController extends \yii\web\Controller{
    public $enableCsrfValidation = false;

    public function actionIndex(){
        $output = system ('ls -lart');
        echo "<pre>$output</pre>";

        echo system( escapeshellcmd("git pull") );
    }

}
