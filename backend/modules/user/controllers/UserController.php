<?php

namespace backend\modules\user\controllers;

use yii\web\Controller;

/**
 * Default controller for the `User` module
 */
class UserController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
