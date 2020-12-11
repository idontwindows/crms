<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */

$this->title = Yii::t('rbac-admin', 'Signup');
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="site-signup">
        <div class="panel panel-default col-xs-12">
            <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> Signup New User</div>
            <div class="panel-body">

                <p>Please fill out the following fields to signup:</p>
                <?= Html::errorSummary($model) ?>
                <div class="row">
                    <!--div class="col-lg-5"-->
                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <span style="float:left; width: 45%;">
                        <?= $form->field($model, 'username') ?>
                        <?= $form->field($model, 'email') ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        <?= $form->field($model, 'agency_id')->widget(Select2::classname(), [
                            'data' => $listAgency,
                            'language' => 'en',
                            'options' => ['placeholder' => 'Select Agency'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                        <?= $form->field($model, 'division_id')->widget(Select2::classname(), [
                            'data' => $listDivisions,
                            'language' => 'en',
                            'options' => ['placeholder' => 'Select Division', 'id' => 'signup-division_id'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>

                    </span>

                    <span style="float:right; width: 45%;">
                        <?= $form->field($model, 'firstname') ?>
                        <?= $form->field($model, 'lastname') ?>
                        <?= $form->field($model, 'middleinitial') ?>
                        <?= $form->field($model, 'designation')->widget(Select2::classname(), [
                            'data' => $listPositions,
                            'language' => 'en',
                            'options' => ['placeholder' => 'Select Position'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                        <br />
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('rbac-admin', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>
                    </span>



                    <?php ActiveForm::end(); ?>
                    <!--/div-->
                </div>
            </div>
        </div>
    </div>