<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

use common\models\evaluation\Businessunit;
/* @var $this yii\web\View */
/* @var $model common\models\evaluation\Evaluationattribute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evaluationattribute-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'business_unit_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Businessunit::find()->orderBy(['name'=>SORT_ASC])->all(),'business_unit_id','name'),
                    'language' => 'en',
                    'options' => ['placeholder' => 'Select Business Unit','readonly'=>'readonly'],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ])->label('Business Unit'); ?>
                
    <?= $form->field($model, 'attribute_name')->textArea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
