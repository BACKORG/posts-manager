<?php
namespace app\controllers;
use Yii;

class GitController extends \yii\web\Controller{
    public $enableCsrfValidation = false;

    public function actionIndex(){
        $payload = Yii::$app->request->post('payload');
        $data = json_decode($payload);

        if($data->ref == "refs/heads/master"){          
            exec("git pull", $output);
            var_dump($output);
        }else{
            var_dump("This branch is not master branch.");
        }
    }
}

