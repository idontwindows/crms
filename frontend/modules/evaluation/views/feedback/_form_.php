<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

use common\models\evaluation\Businessunit;
/* @var $this yii\web\View */
/* @var $model common\models\evaluation\Feedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'agency_id')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'business_unit_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Businessunit::find()->orderBy(['name'=>SORT_ASC])->all(),'business_unit_id','name'),
                    'language' => 'en',
                    'options' => ['placeholder' => 'Select Business Unit','readonly'=>'readonly'],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ])->label('Business Unit'); ?>

    <?= $form->field($model, 'feedback_date')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<style type="text/css">

.imgHover:hover{
    border-radius: 15px;
    box-shadow: 0 0 0 4pt #3c8dbc;
    transition: box-shadow 0.5s ease-in-out;
}
</style>




        <div class="box-body">
          <div class="row">
            
            <!-- /.col -->
            <div class="col-md-3">
              

               <div  style="padding-top: 1px;padding-bottom: 1px;display:block;text-align: center">
                   <a href="#" title="Cashier"><img class="imgHover" src="/images/businessunits/3-CASH.png" style="height:120px;width: 120px"></a>
              </div>
            </div>
            
            <div class="col-md-3">
           
               <div  style="padding-top: 1px;padding-bottom: 1px;display:block;text-align: center">
                 <a href="#" title="Customer Wallet"><img class="imgHover" src="/images/businessunits/3-PURCH.png" style="height:120px;width: 120px"></a>
              </div>
            </div>
            
            <div class="col-md-3">
           
               <div  style="padding-top: 1px;padding-bottom: 1px;display:block;text-align: center">
                 <a href="#" title="Customer Wallet"><img class="imgHover" src="/images/businessunits/4-HR.png" style="height:120px;width: 120px"></a>
              </div>
            </div>
        
            <div class="col-md-3">
           
               <div  style="padding-top: 1px;padding-bottom: 1px;display:block;text-align: center">
                 <a href="#" title="Customer Wallet"><img class="imgHover" src="/images/businessunits/5-MAINTENANCE.png" style="height:120px;width: 120px"></a>
              </div>
            </div>
            
            
            <div class="col-md-3">
           
               <div  style="padding-top: 1px;padding-bottom: 1px;display:block;text-align: center">
                 <a href="#" title="Customer Wallet"><img class="imgHover" src="/images/businessunits/6-STIS.png" style="height:120px;width: 120px"></a>
              </div>
            </div>
            
            <div class="col-md-3">
           
               <div  style="padding-top: 1px;padding-bottom: 1px;display:block;text-align: center">
                 <a href="#" title="Customer Wallet"><img class="imgHover" src="/images/businessunits/7-STSCHO.png" style="height:120px;width: 120px"></a>
              </div>
            </div>
            
            <div class="col-md-3">
           
               <div  style="padding-top: 1px;padding-bottom: 1px;display:block;text-align: center">
                 <a href="#" title="Customer Wallet"><img class="imgHover" src="/images/businessunits/8-INNOVSS.png" style="height:120px;width: 120px"></a>
              </div>
            </div>
            
            <div class="col-md-3">
           
               <div  style="padding-top: 1px;padding-bottom: 1px;display:block;text-align: center">
                 <a href="#" title="Customer Wallet"><img class="imgHover" src="/images/businessunits/9-INTERV.png" style="height:120px;width: 120px"></a>
              </div>
            </div>
            <!-- /.col -->
            
            <!-- /.col -->  
          </div>
        </div>
        <!-- /.box-body -->

        
   

