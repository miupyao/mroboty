<?php

namespace backend\modules\user\controllers;

use yii\data\Pagination;
use yii\web\Controller;
use backend\modules\user\models\User;
use yii\web\UploadedFile;

/**
 * Default controller for the `User` module
 */
class UserController extends Controller
{
    private $errors;
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $count = User::find()->count();

        $pages = new Pagination([
            'totalCount'=>$count,
            'defaultPageSize'=> 1
        ]);
        $data = User::find()->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index',[
            'data' => $data,
            'pages'=> $pages,
            'count'=> $count
        ]);
    }
    /**
     * 新增用户
    */
    public function actionAdd()
    {
        $model = new User();
        if(\Yii::$app->request->isPost&&$model->load(\Yii::$app->request->post()))
        {
            $model->avatar = UploadedFile::getInstance($model, 'avatar');
            var_dump($model->upload());
            exit;
            if($model->upload()&&$model->add())
            {
                return $this->redirect(['user/index']);
            }
        }
        return $this->render('form',[
           'model'=>$model,
        ]);
    }
}
