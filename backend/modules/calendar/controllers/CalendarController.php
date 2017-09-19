<?php
/**
 *author:yyx
 *create_time:2017/9/19 13:24
 *description:
 */
namespace backend\modules\calendar\controllers;

use yii\web\Controller;

class CalendarController extends Controller{

    public function actionIndex()
    {
        return $this->render('index');
    }
}