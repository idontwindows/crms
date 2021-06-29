<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use kartik\form\ActiveForm;  
use kartik\widgets\ActiveForm;
use common\models\evaluation\Evaluationattribute;
use common\models\evaluation\Businessunit;
use yii\helpers\Url;
use kartik\dialog\Dialog;
/* @var $this yii\web\View */
/* @var $model common\models\evaluation\Feedback */
/* @var $form yii\widgets\ActiveForm */
//$rating1 = '\web\dist\img\rating_scale\1.png';
//$rating_1 = "<img src=".Yii::getAlias('@app')."'/web/dist/img/rating_scale.png' />";

echo Dialog::widget();
?>
  <script src="/js/evaluation/owl.carousel.js"></script>

<?php $form = ActiveForm::begin([
  'id' => 'feedback-form',
  'action' => ['create', 'business_unit_id' => $_GET['business_unit_id'], 'agency_id' => $_GET['agency_id']],
  //'enableAjaxValidation' => true,
  //'validationUrl' => 'validation-rul',
]); ?>

<div class="wrapper">
  <div class="carousel owl-carousel">
    <?php //echo Html::button($rating_1) 
    ?>
    <!--?= Html::a($rating_1, '', ['class'=>'btn btn-lg btn-primary']) ?-->
    <?php $k = 0; ?>
    <?php foreach ($evaluationAttributes as $attribute) { ?>
      <!-- One "tab" for each step in the form: look for multistep.js and multistep.css or go to https://www.w3schools.com/howto/howto_js_form_steps.asp for reference-->
      <div class="tab">
        <!--tab begin-->
        <div class="panel panel-info">
          <!--panel begin-->
          <div class="panel-heading"><b>Delivery of Services <span style="color:red">(Required)</span></b></div>
          <div class="panel-body" style="max-height: 1000px; height: 200px;">
            <!--panel body begin-->
            <div class="form-group">
              <?php $modelDeliveryrating->evaluation_attribute_id = $attribute->evaluation_attribute_id; ?>
              <?= $form->field($modelDeliveryrating, "[$k]evaluation_attribute_id")->hiddenInput()->label(false); ?>

            </div>

            <div class="form-group">
              <!--form-group begin-->
              <?php //$modelDeliveryrating->rating = 3; 
              ?>
              <?php //$form->field($modelDeliveryrating, "[$k]rating")->radioList($ratingScale, ['inline'=>true])->label($attribute->attribute_name) 
              ?>
              <div class="d-flex align-items-center justify-content-center">
                <input type="hidden" id=<?= 'rating' . $k ?> name="hidden-deliveryrating" value="">
                <b style="font-size:1.8vw;"><?= $attribute->attribute_name ?></b>
              </div>

              <div class="d-flex align-items-center justify-content-center">

                <div id="checkboxes">
                  <div class="checkboxgroup">
                    <input type="radio" class='smiley1' name=<?= 'Deliveryrating[' . $k . '][rating]' ?> id="my_radio_button_id1" value="1" />
                    <label for="my_radio_button_id1">Very Dissatisfied</label>
                  </div>
                  <div class="checkboxgroup">
                    <input type="radio" class='smiley2' name=<?= 'Deliveryrating[' . $k . '][rating]' ?> id="my_radio_button_id2" value="2" />
                    <label for="my_radio_button_id2">Quite Dissatisfied</label>
                  </div>
                  <div class="checkboxgroup">
                    <input type="radio" class='smiley3' name=<?= 'Deliveryrating[' . $k . '][rating]' ?> id="my_radio_button_id3" value="3" />
                    <label for="my_radio_button_id3">Neither Satisfied nor Dissatisfied</label>
                  </div>
                  <div class="checkboxgroup">
                    <input type="radio" class='smiley4' name=<?= 'Deliveryrating[' . $k . '][rating]' ?> id="my_radio_button_id4" value="4" />
                    <label for="my_radio_button_id4">Very Satisfied</label>
                  </div>
                  <div class="checkboxgroup">
                    <input type="radio" class='smiley4' name=<?= 'Deliveryrating[' . $k . '][rating]' ?> id="my_radio_button_id5" value="5" />
                    <label for="my_radio_button_id5">Outstanding</label>
                  </div>
                </div>

                <!--row begin-->
                <!--look for smiley.css at frontend/web/css -->
                <!--
                <div class="col-md-2"><?= $form->field($modelDeliveryrating, "[$k]rating")->radio(['value' => 1, 'class' => 'smiley1', 'uncheck' => null,])->label(false) ?></div>
                <div class="col-md-2"><?= $form->field($modelDeliveryrating, "[$k]rating")->radio(['value' => 2, 'class' => 'smiley2', 'uncheck' => null,])->label(false) ?></div>
                <div class="col-md-2"><?= $form->field($modelDeliveryrating, "[$k]rating")->radio(['value' => 3, 'class' => 'smiley3', 'uncheck' => null,])->label(false) ?></div>
                <div class="col-md-2"><?= $form->field($modelDeliveryrating, "[$k]rating")->radio(['value' => 4, 'class' => 'smiley4', 'uncheck' => null,])->label(false) ?></div>
                <div class="col-md-2"><?= $form->field($modelDeliveryrating, "[$k]rating")->radio(['value' => 5, 'class' => 'smiley5', 'uncheck' => null,])->label(false) ?></div>
                -->
                <!--row end-->
              </div>
            </div>
            <!--form-group end-->
          </div>
          <!--panel body begin-->
        </div>
        <!--panel end-->
      </div>
      <!--tab end-->
      <?php $k++; ?>
    <?php } ?>


    <?php $i = 0; ?>
    <?php foreach ($evaluationAttributes as $attribute) { ?>
      <div class="tab">
        <!--tab begin-->
        <div class="panel panel-info">
          <!--panel begin-->
          <div class="panel-heading"><b>Importance of the Attributes <span style="color:red">(Required)</span></b></div>
          <div class="panel-body" style="max-height: 1000px; height: 200px;">
            <!--panel body begin-->
            <div class="form-group">
              <?php $modelImportancerating->evaluation_attribute_id = $attribute->evaluation_attribute_id; ?>
              <?= $form->field($modelImportancerating, "[$i]evaluation_attribute_id")->hiddenInput()->label(false); ?>
            </div>
            <div class="form-group">
              <div class="d-flex align-items-center justify-content-center">
                <!--from-group begin-->
                <?php //$formImportancerating->rating = 3; 
                ?>
                <b style="font-size:1.8vw;"><?= $attribute->attribute_name ?></b>
                <?php //$form->field($modelImportancerating, "[$i]rating")->radioList($ratingScale, ['inline'=>true])->label($attribute->attribute_name) 
                ?>
              </div>

              <div class="d-flex align-items-center justify-content-center">

                <div id="checkboxes">
                  <div class="checkboxgroup">
                    <input type="radio" class='number1' name=<?= 'Importancerating[' . $i . '][rating]' ?> id="my_radio_button_id1" value="1" />
                  </div>
                  <div class="checkboxgroup">
                    <input type="radio" class='number2' name=<?= 'Importancerating[' . $i . '][rating]' ?> id="my_radio_button_id2" value="2" />
                  </div>
                  <div class="checkboxgroup">
                    <input type="radio" class='number3' name=<?= 'Importancerating[' . $i . '][rating]' ?> id="my_radio_button_id3" value="3" /> 
                  </div>
                  <div class="checkboxgroup">
                    <input type="radio" class='number4' name=<?= 'Importancerating[' . $i . '][rating]' ?> id="my_radio_button_id4" value="4" />                
                  </div>
                  <div class="checkboxgroup">
                    <input type="radio" class='number5' name=<?= 'Importancerating[' . $i . '][rating]' ?> id="my_radio_button_id5" value="5" />
                  </div>
                </div>

                <!--row begin-->
                <!--look for smiley.css at frontend/web/css -->
                <!--
                <div class="col-md-2"><?= $form->field($modelImportancerating, "[$i]rating")->radio(['value' => 1, 'class' => 'number1', 'uncheck' => null,])->label(false) ?></div>
                <div class="col-md-2"><?= $form->field($modelImportancerating, "[$i]rating")->radio(['value' => 2, 'class' => 'number2', 'uncheck' => null,])->label(false) ?></div>
                <div class="col-md-2"><?= $form->field($modelImportancerating, "[$i]rating")->radio(['value' => 3, 'class' => 'number3', 'uncheck' => null,])->label(false) ?></div>
                <div class="col-md-2"><?= $form->field($modelImportancerating, "[$i]rating")->radio(['value' => 4, 'class' => 'number4', 'uncheck' => null,])->label(false) ?></div>
                <div class="col-md-2"><?= $form->field($modelImportancerating, "[$i]rating")->radio(['value' => 5, 'class' => 'number5', 'uncheck' => null,])->label(false) ?></div>
                -->
              </div>
              <!--row end-->
            </div>
            <!--from-group end-->
          </div>
          <!--panel body end-->
        </div>
        <!--panel end-->
      </div>
      <!--tab end-->
      <?php $i++; ?>
    <?php } ?>



    <div class="tab">
      <!--tab begin-->
      <div class="panel panel-info">
        <!--panel begin-->
        <div class="panel-heading"><b>OVER-ALL CUSTOMER EXPERIENCE <span style="color:red">(Required)</span></b></div>
        <div class="panel-body" style="max-height: 1000px; height: 200px;">
          <!--panel body begin-->
          <div class="form-group">
            <div class="d-flex align-items-center justify-content-center">
              <!--from-group begin-->
              <?php //$formImportancerating->rating = 3; 
              ?>
              <b style="font-size:1.8vw;">OVER-ALL CUSTOMER EXPERIENCE</b>
              <?php //$form->field($modelImportancerating, "[$i]rating")->radioList($ratingScale, ['inline'=>true])->label($attribute->attribute_name) 
              ?>
            </div>

            <div class="d-flex align-items-center justify-content-center">
              <div id="checkboxes">
                <div class="checkboxgroup">
                  <input type="radio" class='smiley1' name="CustomerExperience[rating]" id="my_radio_button_id1" value="1" />
                  <label for="my_radio_button_id1">Very Dis-satisfied</label>
                </div>
                <div class="checkboxgroup">
                  <input type="radio" class='smiley2' name="CustomerExperience[rating]" id="my_radio_button_id2" value="2" />
                  <label for="my_radio_button_id2">Quite Dis-satisfied</label>
                </div>
                <div class="checkboxgroup">
                  <input type="radio" class='smiley3' name="CustomerExperience[rating]" id="my_radio_button_id3" value="3" />
                  <label for="my_radio_button_id3">Neutral</label>
                </div>
                <div class="checkboxgroup">
                  <input type="radio" class='smiley4' name="CustomerExperience[rating]" id="my_radio_button_id4" value="4" />
                  <label for="my_radio_button_id4">Quite Satisfied</label>
                </div>
                <div class="checkboxgroup">
                  <input type="radio" class='smiley4' name="CustomerExperience[rating]" id="my_radio_button_id5" value="5" />
                  <label for="my_radio_button_id5">Very Satisfied</label>
                </div>
              </div>

              <!--row begin-->
              <!--look for smiley.css at frontend/web/css -->
              <!--
              <div class="col-md-2"><?= $form->field($modelCustomerExperience, "rating")->radio(['value' => 1, 'class' => 'smiley1', 'uncheck' => null,])->label(false) ?></div>
              <div class="col-md-2"><?= $form->field($modelCustomerExperience, "rating")->radio(['value' => 2, 'class' => 'smiley2', 'uncheck' => null,])->label(false) ?></div>
              <div class="col-md-2"><?= $form->field($modelCustomerExperience, "rating")->radio(['value' => 3, 'class' => 'smiley3', 'uncheck' => null,])->label(false) ?></div>
              <div class="col-md-2"><?= $form->field($modelCustomerExperience, "rating")->radio(['value' => 4, 'class' => 'smiley4', 'uncheck' => null,])->label(false) ?></div>
              <div class="col-md-2"><?= $form->field($modelCustomerExperience, "rating")->radio(['value' => 5, 'class' => 'smiley5', 'uncheck' => null,])->label(false) ?></div>
              -->
            </div>
            <!--row end-->
          </div>
          <!--from-group end-->
        </div>
        <!--panel body end-->
      </div>
      <!--panel end-->
    </div>
    <!--tab end-->


    <div class="tab">
      <!--tab begin-->
      <div class="panel panel-info">
        <!--panel begin-->
        <div class="panel-heading"><b>Considering your complete experience with our agency, how likely would you recommend our services to others? <span style="color:red">(Required)</span></b></div>
        <div class="panel-body">
          <div class="d-flex align-items-center justify-content-center">
            <!--panel body begin-->
            <?php //$form->field($modelPromotion, 'rating')->radioList($ratingPromotion, ['inline'=>true])->label(false) 
            ?>
            <?= $form->field($modelPromotion, 'rating')->textInput(['id' => 'input-21c'])->label(false) ?>
          </div>
        </div>
        <!--panel body end-->
      </div>
      <!--panel end-->
    </div>
    <!--tab end-->

    <div class="tab">
      <!--tab begin-->
      <div class="panel panel-info">
        <!--panel begin-->
        <div class="panel-heading"><b>Please give us your comments and/or suggestions to improve our services. (Optional)</b></div>
        <div class="panel-body" style="max-height: 200px; height: 200px;">
          <!--panel body begin-->
          <?= $form->field($modelComment, 'answer')->textArea(['class' => 'use-keyboard-input', 'style' => 'height:130px'])->label('') ?>
        </div>
        <!--panel body end-->
      </div>
      <!--panel end-->
    </div>
    <!--tab end-->

    <div class="tab">
      <!--tab begin-->
      <div class="panel panel-info">
        <!--panel begin-->
        <div class="panel-heading"><b>What other Attributes deemed appropriate for the Business Unit. (Optional)</b></div>
        <div class="panel-body" style="max-height: 200px; height: 200px;">
          <!--panel body begin-->
          <?= $form->field($modelOtherattribute, 'answer')->textArea(['class' => 'use-keyboard-input', 'style' => 'height:130px'])->label('') ?>
        </div>
        <!--panel body end-->
      </div>
      <!--panel end-->
    </div>
    <!--tab end-->

    <div class="tab">
      <!--tab begin-->
      <div class="panel panel-info">
        <!--panel begin-->
        <div class="panel-heading "><b>Customer Information (Optional)</b></div>
        <div class="panel-body">
          <!--panel body begin-->
          <?= $form->field($model, 'agency_id')->hiddenInput()->label(false); ?>
          <?= $form->field($model, 'business_unit_id')->hiddenInput()->label(false) ?>
          <?= $form->field($model, 'customer_name')->textInput(['class' => 'use-keyboard-input']) ?>
          <?= $form->field($model, 'email')->textInput(['class' => 'use-keyboard-input']) ?>
          <?= $form->field($model, 'feedback_date')->hiddenInput()->label(false) ?>
        </div>
        <!--panel body end-->
      </div>
      <!--panel end-->
    </div>
    <!--tab end-->

    <div class="tab">
      <!--tab begin-->
      <div class="panel panel-info">
        <!--panel begin-->
        <div class="panel-heading"><b>Signature <span style="color:red">(Required)</span></b></div>
        <div class="panel-body" style="max-height: 1000px; height: 150px;">
          <!--panel body begin-->
          <div class="row">
            <!--row begin-->
            <div class="col-md">
              <!--col-md begin-->

              <?= $form->field($model, 'signature')->hiddenInput(['value' => ''])->label(false); ?>
              <!--
              <canvas id="signature" class="border border-secondary rounded" width=400px height=100px ></canvas>
              -->
              <div class="border border-secondary rounded" style="height:100px; margin-bottom:10px">
                <img src="/images/tap.png" alt="" id="signature" height=90px style="width:40%" value=<?php echo Url::to(['signatureform']); ?> title="Signature">
                <!--
              <div><button type="button" class="btn btn-primary btn-lg" id="clear-signature">Clear</button></div>
              -->
              </div>



            </div>
            <!--col-md end-->
          </div>
          <!--row end-->
        </div>
        <!--panel body end-->
      </div class="d-flex align-items-center justify-content-center">
      <?= Html::submitButton('Submit', ['class' => 'btn btn-success btn-lg', 'id' => 'btnSubmit']) ?>
      <!--panel end-->
    </div>
    <!--tab end-->
  </div>
</div>
<?php ActiveForm::end(); ?>

<div class="container">
  <!-- The Thank you Modal -->
  <div class="modal fade" id="modalTY">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header" style="background-color:#5bc0de">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <?= $this->render('_thankyou') ?>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="container">
  <!-- SignaturePad Modal -->
  <div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header" style="background-color:#5bc0de">
          <h4 class="modal-title" style="color:#f7f7f7">Signature</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <?= $this->render('_signatureform') ?>
        </div>


      </div>
    </div>
  </div>
</div>

<style>
  img {
    display: block;
    margin-left: auto;
    margin-right: auto;
  }

  #otherattribute-answer,
  #comment-answer,
  #feedback-customer_name,
  #feedback-email {
    font-size: 18px;
  }

  .checkboxgroup {
    display: inline-block;
    text-align: center;
    margin-top: 5px;
    width: 150px;
  }

  .checkboxgroup label {
    display: block;
    font-size: 1vw;
  }
</style>

<?php
$js = <<<JS
$(document).ready(function(){
    //star rating
    $("#input-21c").rating({
        min: 0, max: 10, step: 1, size: "xl", stars: "10"
    });  
  
    //function submitfrom(){
      //jQuery AJAX submit form
      $('#feedback-form').submit(function(e) {
      e.preventDefault(); // avoid to execute the actual submit of the form.
      e.stopPropagation();
      if(e.result == true){
        if($("#feedback-signature").attr("value") != ""){
          var form = $(this);
          var url = form.attr('action');
          $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                  $('#modalTY').modal('show');
                }
              });
          }else{
            krajeeDialog.alert('<i class="fa fa-info-circle" style="font-size:40px"></i><b style="font-size:20px">    Please tap to sign...</b>',
                function (result) {
                        if (result) {
                          $("#btnSubmit").prop("disabled", false)
                        } 
            });
          }
        }
        e.result = false;
      });
    //}
 

    //touch events
    $("body").on("touchstart",".smiley1",function () {
      $(this).prop("checked", true);
    });
    $("body").on("touchstart",".smiley2",function () {
      $(this).prop("checked", true);
    });
    $("body").on("touchstart",".smiley3",function () {
      $(this).prop("checked", true);
    });
    $("body").on("touchstart",".smiley4",function () {
      $(this).prop("checked", true);
    });
    $("body").on("touchstart",".smiley5",function () {
      $(this).prop("checked", true);
    });
    $("body").on("touchstart",".number1",function () {
      $(this).prop("checked", true);
    });
    $("body").on("touchstart",".number2",function () {
      $(this).prop("checked", true);
    });
    $("body").on("touchstart",".number3",function () {
      $(this).prop("checked", true);
    });
    $("body").on("touchstart",".number4",function () {
      $(this).prop("checked", true);
    });
    $("body").on("touchstart",".number5",function () {
      $(this).prop("checked", true);
    });
    $("body").on("touchstart","#comment-answer",function () {
      $(this).focus();
      $(".keyboard").removeClass("keyboard--hidden");
    });
    $("body").on("touchstart","#otherattribute-answer",function () {
      $(this).focus();
      $(".keyboard").removeClass("keyboard--hidden");
    });
    $("body").on("touchstart","#feedback-customer_name",function () {
      $(this).focus();
      $(".keyboard").removeClass("keyboard--hidden");
    });
    $("body").on("touchstart","#feedback-email",function () {
      $(this).focus();
      $(".keyboard").removeClass("keyboard--hidden");
    });
    /*
    $("body").on("touchstart","#btnSubmit",function () {
        submitfrom();
    });*/
    $("#btnSubmit").on('touchstart', function (event) {  
          event.preventDefault();
          $(this).submit()
          $(this).prop('disabled', true);
     });
    $("body").on("touchend","#signature",function () {
        $('#modal').modal('show');
    });
    $("body").on("click","#signature",function () {
        $('#modal').modal('show');
    });
    $("body").on("click","#btn-close-modal", function(){
      location.replace("../feedback/index")
    });
    $('#modalTY').on('hidden.bs.modal', function (e) {
      location.replace("../feedback/index")
    });
});
JS;

$this->registerJs($js, \yii\web\View::POS_READY);
?>


<script>
  var carousel = $('.carousel')

  function startCarousel() {
    carousel.owlCarousel({
      margin: 20,
      //loop: true,
      autoplay: false,
      //autoplayTimeout: 2000,
      //autoplayHoverPause: true,
      onChanged: function(e) {
        var tab = $(".tab").length;
        var index = e.item.index;
        var dr1 = 'input[name="Deliveryrating[';
        var dr2 = '][rating]"]:checked';
        var ir1 = 'input[name="Importancerating[';
        var ir2 = '][rating]"]:checked';
        var tab1 = tab - 6;
        var index1 = index - 1;
        var tab3 = tab1;
        tab1 = tab1 / 2;
        var tab2 = tab1 - 1;

        if (tab1 > index1) {
          if ($(dr1 + index1 + dr2).length === 0) { //check if radio button is selected or checked
            carousel.trigger('prev.owl.carousel', [300]);

          }
        } else if (tab3 > index1 && tab2 < index1) {
          var index2 = index - tab1;
          index2 = index2 - 1;
          if ($(ir1 + index2 + ir2).length === 0) { //check if radio button is selected or checked
            carousel.trigger('prev.owl.carousel', [300]);
            console.log(tab3 + ">" + index1 + "and" + tab2 + "<" + index1);

          }
        } else if (tab3 == index1) {
          if ($('input[name="CustomerExperience[rating]"]:checked').length === 0) {
            carousel.trigger('prev.owl.carousel', [300]);
          }
          console.log(tab3 + "==" + index1);
          // console.log(index1);
        } else if (tab3 < index) {
          if ($(".rating-stars").attr("title") == "Not Rated") {
            carousel.trigger('prev.owl.carousel', [300]);
          }
          console.log("from star");
        }

        $(".keyboard").addClass("keyboard--hidden");
        //console.log(index);
      },
      onTranslated: function(e) {

        console.log('transtale success');

      },
      responsive: {
        0: {
          items: 1,
          nav: false
        },
        600: {
          items: 1,
          nav: false
        },
        1000: {
          items: 1,
          nav: false
        }
      }

    });
  }


  jQuery(document).ready(function($) {
    startCarousel();
    $("body").on("click", "#btnOk", function() {
      var agency_id = <?php echo $_GET['agency_id']; ?>;
      var url = "../feedback/index?agency_id=" + agency_id;
      location.replace(url)
    });
  });
</script>