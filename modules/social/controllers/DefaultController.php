<?php

namespace app\modules\social\controllers;

class DefaultController extends CommonController{
    private $_output = ['error' => false];

    // get all social data
    public function actionIndex(){
        // get currently ip data
        $data = $this->getData();
       
        if($data){
            $this->_output['socialData'] = $data['socialData'];
        }else{
            $this->_output['error'] = true;
        }

        $this->outputJson($this->_output);
    }

 
}
