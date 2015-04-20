<?php
namespace app\controllers;
use Yii;

class GitController extends \yii\web\Controller{
    public $enableCsrfValidation = false;

    public function actionIndex(){
        $ref = Yii::$app->request->post('ref');
        print_r($ref);

        exec("git pull", $output);
        var_dump($output);
    }
}

