<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use kartik\form\ActiveForm;  
use kartik\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

use common\models\evaluation\Businessunit;
/* @var $this yii\web\View */
/* @var $model common\models\evaluation\Feedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-form">

    <!--?php $form = ActiveForm::begin(); ?-->
    <?php $form = ActiveForm::begin([
        //'id' => 'feedback-form',
        //'action' => 'save-url',
        //'enableAjaxValidation' => true,
        //'validationUrl' => 'validation-rul',
    ]); ?>
    <?= $form->field($model, 'agency_id')->hiddenInput()->label(false); ?>

    <!--?= $form->field($model, 'business_unit_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Businessunit::find()->orderBy(['name'=>SORT_ASC])->all(),'business_unit_id','name'),
                    'language' => 'en',
                    'options' => ['placeholder' => 'Select Business Unit','readonly'=>'readonly'],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ])->label('Business Unit'); ?-->

    <?= $form->field($model, 'business_unit_id')->hiddenInput()->label(false) ?>
    <!--?= $form->field($model, 'customer_name')->textInput() ?-->
    <?= $form->field($model, 'feedback_date')->hiddenInput()->label(false) ?>

        <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>



<div class="box box-info">
    <div class="box-header">
      <i class="fa fa-user"></i>

      <h3 class="box-title">Customer Information</h3>

    </div>
    <div class="box-body">


    <?= $form->field($model, 'customer_name')->textInput() ?>


    </div>
    <div class="box-footer clearfix">
      <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
        <i class="fa fa-arrow-circle-right"></i></button>
    </div>
</div>



<div class="box box-info">
    <div class="box-header">
      <i class="fa fa-commenting"></i>

      <h3 class="box-title">Delivery of Service</h3>

    </div>
    <div class="box-body">
      <?php $k = 0; ?>    
      <?php foreach($evaluationAttributes as $attribute){ ?>    
            <div class="form-group">
                <?php $modelDeliveryrating->evaluation_attribute_id = $attribute->evaluation_attribute_id; ?>
                <?= $form->field($modelDeliveryrating, "[$k]evaluation_attribute_id")->hiddenInput()->label(false); ?>
            </div>
            <div class="form-group">
              <?php //$modelDeliveryrating->rating = 3; ?>
              <?= $form->field($modelDeliveryrating, "[$k]rating")->radioList($ratingScale, ['inline'=>true])->label($attribute->attribute_name) ?>
            </div>
            <?php $k++; ?>    
      <?php } ?>
    </div>
    <div class="box-footer clearfix">
      <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
        <i class="fa fa-arrow-circle-right"></i></button>
    </div>
</div>

<div class="box box-info">
    <div class="box-header">
      <i class="fa fa-user"></i>

      <h3 class="box-title">Importance of the Attributes</h3>

    </div>
    <div class="box-body">
      <?php $i = 0; ?>    
      <?php foreach($evaluationAttributes as $attribute){ ?>    
       
            <div class="form-group">
                <?php $modelImportancerating->evaluation_attribute_id = $attribute->evaluation_attribute_id; ?>
                <?= $form->field($modelImportancerating, "evaluation_attribute_id[$i]")->hiddenInput()->label(false); ?>
            </div>
            <div class="form-group">
              <?php //$formImportancerating->rating = 3; ?>
              <?= $form->field($modelImportancerating, "rating[$i]")->radioList($ratingScale, ['inline'=>true])->label($attribute->attribute_name) ?>
            </div>
            <?php $i++; ?>  
      <?php } ?>

    </div>
    <div class="box-footer clearfix">
      <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
        <i class="fa fa-arrow-circle-right"></i></button>
    </div>
</div>


<div class="box box-info">
    <div class="box-header">
      <i class="fa fa-retweet"></i>

      <h3 class="box-title">Considering your complete experience with our agency, how likely would you recommend our services to others?</h3>

    </div>
    <div class="box-body">

        <div class="form-group">
          <?php //$formImportancerating->rating = 3; ?>
          <?= $form->field($modelPromotion, 'rating')->radioList($ratingPromotion, ['inline'=>true])->label(false) ?>
        </div>
        
    </div>
    <div class="box-footer clearfix">
      <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
        <i class="fa fa-arrow-circle-right"></i></button>
    </div>
</div>

<div class="box box-info">
    <div class="box-header">
      <i class="fa fa-comments"></i>

      <h3 class="box-title">Please give us your comments and/or suggestions to improve our services.</h3>

    </div>
    <div class="box-body">

            <div class="form-group">
              <?= $form->field($modelComment, 'answer')->textArea()->label('') ?>
            </div>
        

      <?php ActiveForm::end(); ?>
    </div>
    <div class="box-footer clearfix">
      <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
        <i class="fa fa-arrow-circle-right"></i></button>
    </div>
</div>

<script>
//$(document).on("onSubmit", "#feedback-form", function () {
    // send data to actionSave by ajax request.
    //return false; // Cancel form submitting.
//});
/*    
$(document).on("beforeSubmit", "#customer-form", function () {
    // send data to actionSave by ajax request.
    return false; // Cancel form submitting.
});
</script>


