<?php
namespace app\controllers;
use Yii;

class GitController extends \yii\web\Controller{
    public $enableCsrfValidation = false;

    public function actionIndex(){
        $payload = Yii::$app->request->post('payload');
        $data = json_decode($payload);
        echo '<pre>';
        print_r($data);
        exit();

        exec("git pull", $output);
        var_dump($output);
    }
}

