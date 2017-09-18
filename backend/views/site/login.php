<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/style.css');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title); ?></title>
    <?php $this->head() ?>
    <style>
        body{height:100%;background:#16a085;overflow:hidden;}
        canvas{z-index:-1;position:absolute;}
    </style>
</head>
<?php $this->beginBody() ?>
<dl class="admin_login">
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <dt>
        <strong><?= Html::encode($this->title) ?></strong>
        <em>Management System</em>
    </dt>
    <dd class="user_icon">
        <?= $form->field($model, 'username')->textInput(['autofocus' => true,'class'=>'login_txtbx','placeholder'=>'账号'])->label(false);?>
    </dd>
    <dd class="pwd_icon">
        <?= $form->field($model, 'password')->passwordInput(['class'=>'login_txtbx','placeholder'=>'密码'])->label(false);?>
    </dd>
    <dd class="val_icon">
        <?= $form->field($model,'verifyCode',['options'=>['class'=>'checkcode']])->widget(yii\captcha\Captcha::className()
            ,['captchaAction'=>'site/captcha',
                'imageOptions'=>['alt'=>'点击换图','title'=>'点击换图', 'class'=>'ver_btn'],
                'options'=>['class'=>'login_txtbx','placeholder'=>'验证码'],
            ]);?>
    </dd>
    <dd>
        <?= Html::submitButton('Login', ['class' => 'submit_btn', 'name' => 'login-button','value'=>'立即登陆']) ?>
    </dd>
    <?php ActiveForm::end(); ?>
</dl>
<?php
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/jquery.js',[\yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/verificationNumbers.js',[\yii\web\View::POS_HEAD]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/Particleground.js',[\yii\web\View::POS_HEAD]);
$js = <<<JS
    $(document).ready(function() {
        //粒子背景特效
        $('body').particleground({
            dotColor: '#5cbdaa',
            lineColor: '#5cbdaa'
        });
       
    });
JS;
$this->registerJs($js,\yii\web\View::POS_END);
?>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>



