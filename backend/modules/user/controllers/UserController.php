<?php

namespace backend\modules\user\controllers;

use yii\data\Pagination;
use yii\web\Controller;
use backend\modules\user\models\User;
use backend\modules\user\models\UserSearchConditionsForm;
/**
 * Default controller for the `User` module
 */
class UserController extends Controller
{
    public $_where_value;
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new UserSearchConditionsForm();
        if(empty(\Yii::$app->request->get('search')))
        {
            \Yii::$app->session->set('user_serach_conditions',null);
        }
        $username = [];
        $email = [];
        if(\Yii::$app->request->isPost&&\Yii::$app->request->post('UserSearchConditionsForm')&&$model->load(\Yii::$app->request->post()))
        {
            $data = \Yii::$app->request->post('UserSearchConditionsForm');
            \Yii::$app->session->set('user_search_conditions',$data);
        }
        if(!empty(\Yii::$app->session->get('user_search_conditions')))
        {
            $this->_where_value = \Yii::$app->session->get('user_search_conditions')['search'];
            $username = ['like','username',$this->_where_value];
            $email = ['like','email',$this->_where_value];
        }
        $count = User::find()->count();
        $pages = new Pagination([
            'totalCount'=>$count,
            'defaultPageSize'=> 5 
        ]);
        $data = User::find()->where('status >= 0')->orWhere($username)->orWhere($email)->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index',[
            'data' => $data,
            'pages'=> $pages,
            'count'=> $count,
            'model'=> $model,
            'where_value'=>$this->_where_value,
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
            if($model->addUser())
            {
                return $this->redirect(['user/index']);
            }
        }
        return $this->render('form',[
           'model'=>$model,
        ]);
    }
    /**
     * 修改用户
     */
    public function actionEdit($id)
    {
        $model = User::find()->where(['id'=>$id])->one();
        if(\Yii::$app->request->isPost&&$model->load(\Yii::$app->request->post()))
        {
            if($model->save())
            {
                return $this->redirect(['user/index']);
            }
        }
        return $this->render('form',[
            'model'=>$model,
        ]);
    }
    /**
     * 删除用户
     */
    public function actionDel($id)
    {
        $model = User::find()->where(['id'=>$id])->one();
        $model->status = -1;
        if($model->save())
        {
            return $this->redirect(['user/index']);
        }
    }
}
