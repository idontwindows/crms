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
//$rating1 = '\web\dist\img\rating_scale\1.png';
$rating_1 = "<img src=".Yii::getAlias('@app')."'/web/dist/img/rating_scale.png' />";

?>

<?php //$form = ActiveForm::begin(); ?>
<?php $form = ActiveForm::begin([
    'id' => 'feedback-form',
    //'enableAjaxValidation' => true,
    //'validationUrl' => 'validation-rul',
]);?>


<div class="row">
    <div class="col-sm-8">
        
        
        <div class="panel panel-info">
        <div class="panel-heading"><b>Delivery of Services</b></div>
            <div class="panel-body">
                <?php //echo Html::button($rating_1) ?> 
                <!--?= Html::a($rating_1, '', ['class'=>'btn btn-lg btn-primary']) ?-->
                <?php $k = 0; ?>    
                <?php foreach($evaluationAttributes as $attribute){ ?>    
                    <div class="form-group">
                        <?php $modelDeliveryrating->evaluation_attribute_id = $attribute->evaluation_attribute_id; ?>
                        <?= $form->field($modelDeliveryrating, "[$k]evaluation_attribute_id")->hiddenInput()->label(false); ?>
                    </div>
                    
                    <div class="form-group">
                      <?php //$modelDeliveryrating->rating = 3; ?>
                      <?php //$form->field($modelDeliveryrating, "[$k]rating")->radioList($ratingScale, ['inline'=>true])->label($attribute->attribute_name) ?>
                      <b style="font-size:17px"><?= $attribute->attribute_name ?></b>
                        <div class="row">
                            <!--look for smiley.css at frontend/web/ -->
                            <div class="col-md-1"><?= $form->field($modelDeliveryrating, "[$k]rating")->radio(['value' => 1, 'class' => 'smiley1', 'uncheck' => null,])->label(false) ?></div>
                            <div class="col-md-1"><?= $form->field($modelDeliveryrating, "[$k]rating")->radio(['value' => 2, 'class' => 'smiley2', 'uncheck' => null,])->label(false) ?></div>
                            <div class="col-md-1"><?= $form->field($modelDeliveryrating, "[$k]rating")->radio(['value' => 3, 'class' => 'smiley3', 'uncheck' => null,])->label(false) ?></div>
                            <div class="col-md-1"><?= $form->field($modelDeliveryrating, "[$k]rating")->radio(['value' => 4, 'class' => 'smiley4', 'uncheck' => null,])->label(false) ?></div>
                            <div class="col-md-1"><?= $form->field($modelDeliveryrating, "[$k]rating")->radio(['value' => 5, 'class' => 'smiley5', 'uncheck' => null,])->label(false) ?></div>
                        </div>
                    </div>
                    <?php $k++; ?>    
                <?php } ?>
            </div>
        </div>
        
        <div class="panel panel-info">
        <div class="panel-heading"><b>Importance of the Attributes</b></div>
            <div class="panel-body">
                <?php $i = 0; ?>    
                <?php foreach($evaluationAttributes as $attribute){ ?>    

                    <div class="form-group">
                        <?php $modelImportancerating->evaluation_attribute_id = $attribute->evaluation_attribute_id; ?>
                        <?= $form->field($modelImportancerating, "[$i]evaluation_attribute_id")->hiddenInput()->label(false); ?>
                    </div>
                    <div class="form-group">
                      <?php //$formImportancerating->rating = 3; ?>
                      <b style="font-size:17px"><?= $attribute->attribute_name ?></b>
                      <?php //$form->field($modelImportancerating, "[$i]rating")->radioList($ratingScale, ['inline'=>true])->label($attribute->attribute_name) ?>
                      
                      <div class="row">
                            <!--look for smiley.css at frontend/web/ -->
                            <div class="col-md-1"><?= $form->field($modelImportancerating, "[$i]rating")->radio(['value' => 1, 'class' => 'smiley1','id' => 'smiley1' , 'uncheck' => null,])->label(false) ?></div>
                            <div class="col-md-1"><?= $form->field($modelImportancerating, "[$i]rating")->radio(['value' => 2, 'class' => 'smiley2', 'uncheck' => null,])->label(false) ?></div>
                            <div class="col-md-1"><?= $form->field($modelImportancerating, "[$i]rating")->radio(['value' => 3, 'class' => 'smiley3', 'uncheck' => null,])->label(false) ?></div>
                            <div class="col-md-1"><?= $form->field($modelImportancerating, "[$i]rating")->radio(['value' => 4, 'class' => 'smiley4', 'uncheck' => null,])->label(false) ?></div>
                            <div class="col-md-1"><?= $form->field($modelImportancerating, "[$i]rating")->radio(['value' => 5, 'class' => 'smiley5', 'uncheck' => null,])->label(false) ?></div>
                    </div>
                    </div>
                    <?php $i++; ?>  
                <?php } ?>
            </div>
        </div>
        
    <div class="panel panel-info">
        <div class="panel-heading"><b>Considering your complete experience with our agency, how likely would you recommend our services to others?</b></div>
            <div class="panel-body">
                <?php //$form->field($modelPromotion, 'rating')->radioList($ratingPromotion, ['inline'=>true])->label(false) ?>
                <?= $form->field($modelPromotion, 'rating')->textInput(['id'=>'input-21c'])->label(false) ?>

            </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="panel panel-info">
        <div class="panel-heading"><b>Legends</b></div>
            <div class="panel-body">
                <div class="row">
                <div class="col-md-2 col-md-offset-1" style="cursor:pointer;" data-toggle="tooltip" title="Very Dissatisfied"><img class="smiley1" src="/images/angry.svg" style="width: 50px; height:50px"></img></div>
                <div class="col-md-2" style="cursor:pointer;" data-toggle="tooltip" title="Quite Dissatisfied"><img class="smiley1" src="/images/sad.svg" style="width: 50px; height:50px"></img></div>
                <div class="col-md-2" style="cursor:pointer;" data-toggle="tooltip" title="Neither Satisfied nor Dissatisfied"><img class="smiley1" src="/images/neutral.svg" style="width: 50px; height:50px"></img></div>
                <div class="col-md-2" style="cursor:pointer;" data-toggle="tooltip" title="Very Satisfied"><img class="smiley1" src="/images/smile.svg" style="width: 50px; height:50px"></img></div>
                <div class="col-md-2" style="cursor:pointer;" data-toggle="tooltip" title="Outstanding"><img class="smiley1" src="/images/grinning.svg" style="width: 50px; height:50px"></img></div>
                </div>
            </div>
        </div>
        
        <div class="panel panel-info">
        <div class="panel-heading "><b>Customer Information</b></div>
            <div class="panel-body">
                <?= $form->field($model, 'agency_id')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'business_unit_id')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'customer_name')->textInput() ?>
                <?= $form->field($model, 'email')->textInput() ?>
                <?= $form->field($model, 'feedback_date')->hiddenInput()->label(false) ?>
            </div>
        </div>
       

        
        <div class="panel panel-info">
        <div class="panel-heading"><b>Please give us your comments and/or suggestions to improve our services.</b></div>
            <div class="panel-body">
                <?= $form->field($modelComment, 'answer')->textArea()->label('') ?>
            </div>
        </div>
        
        <div class="panel panel-info">
        <div class="panel-heading"><b>What other Attributes deemed appropriate for the Business Unit.</b></div>
            <div class="panel-body">
                <?= $form->field($modelOtherattribute, 'answer')->textArea()->label('') ?>
            </div>
        </div>
    </div>
</div>

<?= Html::submitButton('Submit', ['class' => 'btn btn-success', 'id'=>'btnSubmit']) ?>
<?php ActiveForm::end(); ?>

<?php
$js=<<<JS
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();  
    $("#input-21c").rating({
                min: 0, max: 10, step: 1, size: "xl", stars: "10"
            }); 
  });
JS;
$this->registerJs($js,\yii\web\View::POS_READY)
?>




