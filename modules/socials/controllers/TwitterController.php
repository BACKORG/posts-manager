<?php

namespace app\modules\socials\controllers;

use yii\web\Controller;
use zhexiao;

class TwitterController extends Controller
{
    public function actionIndex(){

        new zhexiao\twitter\Twitter();
        new zhexiao\facebook\Facebook();
    }
}
