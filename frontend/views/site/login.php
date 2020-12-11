<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrap">
    <div class="site-login">
        <!-- partial:index.partial.html -->
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <h2 class="form-signin-heading">Please login</h2>
        <?= $form->field($model, 'email')->textInput(['autofocus' => false, 'placeholder' => 'Email'])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
        <label class="checkbox">
        <?= $form->field($model, 'rememberMe')->checkbox() ?>
        </label>
        <?= Html::submitButton('Login', ['class' => 'btn btn-lg btn-primary btn-block', 'name' => 'login-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <!-- partial -->
</div>