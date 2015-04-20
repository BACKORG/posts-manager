<?php
namespace app\controllers;
use Yii;

class GitController extends \yii\web\Controller{
    public $enableCsrfValidation = false;

    public function actionIndex(){
        var_dump($_POST);
        $ref = Yii::$app->request->post('ref');
        var_dump($ref);
        exit();

        exec("git pull", $output);
        var_dump($output);
    }
}
