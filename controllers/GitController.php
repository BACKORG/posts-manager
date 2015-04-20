<?php

namespace app\controllers;

class GitController extends \yii\web\Controller{
    public $enableCsrfValidation = false;

    public function actionIndex(){
        $output = shell_exec('ls -lart');
        echo "<pre>$output</pre>";
        
        echo shell_exec("git pull");
    }

}
