<?php
//use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use kartik\select2\Select2;
use kartik\widgets\ActiveForm;
use common\models\evaluation\Agency;
use common\models\evaluation\Businessunit;
?>
<!--pre>
<?php //print_r($csf); ?>    
<?php //print_r($csfResults); ?>    
</pre-->         
<section class="content-header">
    
    <?php $form = ActiveForm::begin([
        'id'=>'filter-form-prime', 
        //'enableAjaxValidation' => true,
        'type'=>ActiveForm::TYPE_HORIZONTAL
    ]); ?>
    
    <div class="form-group row mb-0">
        <div class="col-lg-5">
            <h1>Dashboard</h1>
        </div>
        <div class="col-lg-2">
                <?= $form->field($model, 'period', ['template' => '{hint} {input}'])->widget(Select2::classname(), [
                        //'data' => ArrayHelper::map(Agency::find()->orderBy(['agency_id'=>SORT_ASC])->all(),'agency_id','name'),
                        'data' => ['2020' => 2020, '2019' => 2019, '2018' => 2018, '2017' => 2017],
                        'language' => 'de',
                        'options' => ['placeholder' => ''],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'width' => '200px',
                        ],
                        'size' => Select2::SMALL,
                        
                    ])->label(false)->hint('Period')  ;?>
        </div>
        <div class="col-lg-2">
                <?= $form->field($model, 'agency_id', ['template' => '{hint} {input}'])->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Agency::find()->orderBy(['agency_id'=>SORT_ASC])->all(),'agency_id','name'),
                        'language' => 'de',
                        'options' => ['placeholder' => ''],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'width' => '200px',
                        ],
                        'size' => Select2::SMALL,
                        
                    ])->label(false)->hint('Agency')  ;?>
        </div>
        <div class="col-lg-2">
                <?= $form->field($model, 'business_unit_id', ['template' => '{hint} {input}'])->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Businessunit::find()->orderBy(['business_unit_id'=>SORT_ASC])->all(),'business_unit_id','name'),
                        'language' => 'de',
                        'options' => ['placeholder' => ''],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'width' => '200px',
                        ],
                        'size' => Select2::SMALL,
                    ])->label(false)->hint('Business Unit')  ;?>
        </div>
        <?= Html::submitButton('Apply', ['id' => 'btnApply', 'class' => 'btn btn-success btn-sm', 'style'=>'float: left; width: 100px; margin-top: 25px;']) ?>
    </div>
    <?php ActiveForm::end(); ?> 

</section>
<br>
<section> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3><?php echo $csf['respondents']; ?></h3>

              <p>Respondents</p>
              <br><br>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                    <?php $fmt = Yii::$app->formatter; ?>
                    <?php echo $fmt->asDecimal($csf['rating']); ?><sup style="font-size: 20px">%</sup></h3>

              <p>Customer Satisfaction Rating</p>
              <br><br>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-light-blue-gradient">
            <div class="inner">
             
              <h3><?php echo $fmt->asDecimal($csf['nps']['score']); ?></h3>
              <div class="btn-toolbar" role="toolbar" style='margin-left: 5px; margin-right: auto ;'>
                  <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button type="button" class="btn btn-danger" style='width: 180px;'><?php echo $csf['nps']['detractors']; ?></button>
                    <button type="button" class="btn btn-secondary" style='width: 60px;'><?php echo $csf['nps']['passives']; ?></button>
                    <button type="button" class="btn btn-success" style='width: 120px;'><?php echo $csf['nps']['promoters']; ?></button>
                  </div>
              </div>
              
              <br>
              <p style='float: left;'>Net Promoter Score</p>
              
              <br>
              <br>
              
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->




<script>

//$(document).on("beforeSubmit", "#filter-form-prime", function () {
    // send data to actionSave by ajax request.
    //return false; // Cancel form submitting.
//});
</script>