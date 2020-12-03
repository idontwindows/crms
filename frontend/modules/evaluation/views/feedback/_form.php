<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use kartik\form\ActiveForm;  
use kartik\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\evaluation\Evaluationattribute;

use common\models\evaluation\Businessunit;
/* @var $this yii\web\View */
/* @var $model common\models\evaluation\Feedback */
/* @var $form yii\widgets\ActiveForm */
//$rating1 = '\web\dist\img\rating_scale\1.png';
//$rating_1 = "<img src=".Yii::getAlias('@app')."'/web/dist/img/rating_scale.png' />";

?>

<?php $form = ActiveForm::begin([
    'id' => 'feedback-form',
    //'enableAjaxValidation' => true,
    //'validationUrl' => 'validation-rul',
]);?>

                <?php //echo Html::button($rating_1) ?> 
                <!--?= Html::a($rating_1, '', ['class'=>'btn btn-lg btn-primary']) ?-->
                <?php $k = 0; ?>    
                <?php foreach($evaluationAttributes as $attribute){ ?>    
                 <!-- One "tab" for each step in the form: look for multistep.js and multistep.css or go to https://www.w3schools.com/howto/howto_js_form_steps.asp for reference-->
                    <div class="tab"> <!--tab begin-->
                        <div class="panel panel-info"> <!--panel begin-->
                            <div class="panel-heading"><b>Delivery of Services</b></div>
                                <div class="panel-body" style="max-height: 1000px; height: 200px;"> <!--panel body begin-->
                                        <div class="form-group">
                                            <?php $modelDeliveryrating->evaluation_attribute_id = $attribute->evaluation_attribute_id; ?>
                                            <?= $form->field($modelDeliveryrating, "[$k]evaluation_attribute_id")->hiddenInput()->label(false); ?>
                                        </div>
                                        
                                        <div class="form-group"><!--form-group begin-->
                                        <?php //$modelDeliveryrating->rating = 3; ?>
                                        <?php //$form->field($modelDeliveryrating, "[$k]rating")->radioList($ratingScale, ['inline'=>true])->label($attribute->attribute_name) ?>
                                        <b style="font-size:30px"><?= $attribute->attribute_name ?></b>
                                            <div class="row"><!--row begin-->
                                                <!--look for smiley.css at frontend/web/css -->
                                                <div class="col-md-2"><?= $form->field($modelDeliveryrating, "[$k]rating")->radio(['value' => 1, 'class' => 'smiley1', 'uncheck' => null,])->label(false) ?></div>
                                                <div class="col-md-2"><?= $form->field($modelDeliveryrating, "[$k]rating")->radio(['value' => 2, 'class' => 'smiley2', 'uncheck' => null,])->label(false) ?></div>
                                                <div class="col-md-2"><?= $form->field($modelDeliveryrating, "[$k]rating")->radio(['value' => 3, 'class' => 'smiley3', 'uncheck' => null,])->label(false) ?></div>
                                                <div class="col-md-2"><?= $form->field($modelDeliveryrating, "[$k]rating")->radio(['value' => 4, 'class' => 'smiley4', 'uncheck' => null,])->label(false) ?></div>
                                                <div class="col-md-2"><?= $form->field($modelDeliveryrating, "[$k]rating")->radio(['value' => 5, 'class' => 'smiley5', 'uncheck' => null,])->label(false) ?></div>
                                            </div><!--row end-->
                                        </div><!--form-group end-->
                                </div> <!--panel body begin-->
                         </div><!--panel end-->
                    </div> <!--tab end-->
                    <?php $k++; ?> 
                <?php } ?>
       
                <?php $i = 0; ?>    
                <?php foreach($evaluationAttributes as $attribute){ ?>    
                    <div class="tab"><!--tab begin-->
                        <div class="panel panel-info"><!--panel begin-->
                            <div class="panel-heading"><b>Importance of the Attributes</b></div>
                                <div class="panel-body" style="max-height: 1000px; height: 200px;"><!--panel body begin--> 
                                    <div class="form-group">
                                        <?php $modelImportancerating->evaluation_attribute_id = $attribute->evaluation_attribute_id; ?>
                                        <?= $form->field($modelImportancerating, "[$i]evaluation_attribute_id")->hiddenInput()->label(false); ?>
                                    </div>
                                    <div class="form-group"><!--from-group begin-->
                                    <?php //$formImportancerating->rating = 3; ?>
                                    <b style="font-size:30px"><?= $attribute->attribute_name ?></b>
                                    <?php //$form->field($modelImportancerating, "[$i]rating")->radioList($ratingScale, ['inline'=>true])->label($attribute->attribute_name) ?>
                                        <div class="row"><!--row begin-->
                                            <!--look for smiley.css at frontend/web/css -->
                                            <div class="col-md-2"><?= $form->field($modelImportancerating, "[$i]rating")->radio(['value' => 1, 'class' => 'smiley1', 'uncheck' => null,])->label(false) ?></div>
                                            <div class="col-md-2"><?= $form->field($modelImportancerating, "[$i]rating")->radio(['value' => 2, 'class' => 'smiley2', 'uncheck' => null,])->label(false) ?></div>
                                            <div class="col-md-2"><?= $form->field($modelImportancerating, "[$i]rating")->radio(['value' => 3, 'class' => 'smiley3', 'uncheck' => null,])->label(false) ?></div>
                                            <div class="col-md-2"><?= $form->field($modelImportancerating, "[$i]rating")->radio(['value' => 4, 'class' => 'smiley4', 'uncheck' => null,])->label(false) ?></div>
                                            <div class="col-md-2"><?= $form->field($modelImportancerating, "[$i]rating")->radio(['value' => 5, 'class' => 'smiley5', 'uncheck' => null,])->label(false) ?></div>
                                        </div><!--row end-->
                                    </div><!--from-group end-->
                                </div><!--panel body end--> 
                        </div><!--panel end-->
                    </div><!--tab end-->
                    <?php $i++; ?>  
                <?php } ?>
   
<div class="tab"><!--tab begin-->
  <div class="panel panel-info"><!--panel begin-->
        <div class="panel-heading"><b>Considering your complete experience with our agency, how likely would you recommend our services to others?</b></div>
            <div class="panel-body"><!--panel body begin-->
                <?php //$form->field($modelPromotion, 'rating')->radioList($ratingPromotion, ['inline'=>true])->label(false) ?>
                <?= $form->field($modelPromotion, 'rating')->textInput(['id'=>'input-21c'])->label(false) ?>
            </div><!--panel body end-->
        </div><!--panel end-->
</div><!--tab end-->

<div class="tab"><!--tab begin-->
    <div class="panel panel-info"><!--panel begin-->
        <div class="panel-heading"><b>Please give us your comments and/or suggestions to improve our services.</b></div>
            <div class="panel-body" style="max-height: 200px; height: 200px;"><!--panel body begin-->
                <?= $form->field($modelComment, 'answer')->textArea(['class'=>'use-keyboard-input', 'style'=>'height:130px'])->label('') ?>
            </div><!--panel body end-->
    </div><!--panel end-->
</div><!--tab end-->

<div class="tab"><!--tab begin-->      
        <div class="panel panel-info"><!--panel begin-->
        <div class="panel-heading"><b>What other Attributes deemed appropriate for the Business Unit.</b></div>
            <div class="panel-body" style="max-height: 200px; height: 200px;"><!--panel body begin-->
                <?= $form->field($modelOtherattribute, 'answer')->textArea(['class'=>'use-keyboard-input', 'style'=>'height:130px'])->label('') ?>
            </div><!--panel body end-->
        </div><!--panel end-->
</div><!--tab end-->

  <div class="tab"><!--tab begin-->
        <div class="panel panel-info"><!--panel begin-->
            <div class="panel-heading "><b>Customer Information</b></div>
            <div class="panel-body"><!--panel body begin-->
                <?= $form->field($model, 'agency_id')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'business_unit_id')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'customer_name')->textInput(['class'=>'use-keyboard-input']) ?>
                <?= $form->field($model, 'email')->textInput(['class'=>'use-keyboard-input']) ?>
                <?= $form->field($model, 'feedback_date')->hiddenInput()->label(false) ?>
            </div><!--panel body end-->
        </div><!--panel end-->
  </div><!--tab end-->

  <div class="tab"><!--tab begin-->
    <div class="panel panel-info"><!--panel begin-->
        <div class="panel-heading "><b>Sinature</b></div>
            <div class="panel-body"><!--panel body begin-->
            <div class="row"><!--row begin-->
                <div class="col-md col-md-offset-1"><!--col-md begin-->
                <?= $form->field($model, 'signature')->hiddenInput()->label(false); ?>    
                <canvas id="signature" class="border border-secondary rounded" width=1045px height=300px></canvas>
                <div><button type="button" class="btn btn-primary btn-lg" id="clear-signature">Clear</button></div>
             
                </div><!--col-md end-->
            </div><!--row end-->
        </div><!--panel body end-->
    </div><!--panel end-->
  </div><!--tab end-->

  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" class="btn btn-info btn-lg" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" class="btn btn-primary btn-lg" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>

   <!-- Circles which indicates the steps of the form: -->
   <div style="text-align:center;margin-top:40px;">
    <?php $attrib = Evaluationattribute::find()->where(['business_unit_id' => $_GET['business_unit_id']])->count(); ?>
    <?php for ($x = 1; $x <= $attrib + $attrib + 5; $x++) { ?>
    <span class="step"></span>
    <?php } ?>
  </div>

  <?php ActiveForm::end(); ?>




<?php
$js=<<<JS
$(document).ready(function(){
    //tooltip text
    //$('[data-toggle="tooltip"]').tooltip();  
    $("body").on("click","#prevBtn",function () {
        $(".keyboard").addClass("keyboard--hidden")
    });
    $("body").on("click","#nextBtn",function () {
        $(".keyboard").addClass("keyboard--hidden")
    });

    //star rating
    $("#input-21c").rating({
        min: 0, max: 10, step: 1, size: "xl", stars: "10"
    });  
    
    //signature canvas
    var canvas = document.getElementById("signature");
    var signaturePad = new SignaturePad(canvas);
    
    $('#clear-signature').on('click', function(){
        signaturePad.clear();
    });

    $("body").on("touchend","#signature",function () {
        var canvas = document.getElementById("signature");
        var dataURL = canvas.toDataURL();
        document.getElementById("feedback-signature").value = dataURL;   
    });

});
JS;

$this->registerJs($js,\yii\web\View::POS_READY);
/*
$data = 'data:image/png;base64,AAAFBfj42Pj4';

list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);
$data = base64_decode($data);

file_put_contents('/tmp/image.png', $data);
*/
?>





