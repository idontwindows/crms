<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

use common\models\evaluation\Division;
/* @var $this yii\web\View */
/* @var $model common\models\evaluation\Businessunit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="businessunit-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--?= $form->field($model, 'division_id')->textInput() ?-->
    <?= $form->field($model, 'division_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Division::find()->all(),'division_id','name'),
                        'language' => 'de',
                        //'options' => ['placeholder' => ''],
                        'pluginOptions' => [
                            'allowClear' => true,
                            //'width' => '200px',
                        ],
                        //'size' => Select2::SMALL,
                    ]);?>
                    
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
