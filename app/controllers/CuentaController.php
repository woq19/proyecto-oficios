<?php 
namespace app\controllers;
use \Controller;
use \Response;
use \DataBase;

class CuentaController extends Controller{
    public function actionIndex($var = 'carlitos'){
        echo 'Hola '.$var;
    }
}

