<?php
//use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\evaluation\Feedback;

use kartik\select2\Select2;
use kartik\widgets\ActiveForm;
use common\models\evaluation\Agency;
use common\models\evaluation\Businessunit;
?>
<section class="content-header">
  <h1 style="font-weight:bold; font-size:40px">Dashboard</h1>
  <div class="row">
    <?php $form = ActiveForm::begin(['id' => 'dashboard-form',
      'action' => 'dashboard',
      'method' => 'get']); ?>
    <div class="col-lg-3 col-6">
      <?= $form->field($model, 'business_unit_id')
        ->dropDownList(
          ArrayHelper::map(Businessunit::find()->asArray()->all(), 'business_unit_id', 'name'),           // Flat array ('id'=>'label')
          ['prompt' => 'Select Unit','id' => 'listBusiness', 'name' => 'id']    // options
        )->label(false); ?>
    </div>
    <div class="col-sm-3 col-6">
      <?= $form->field($model, 'month')
        ->dropDownList(
          [
            1 => 'January',
            2 => 'February',
            3 => 'Mrach',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
          ],           // Flat array ('id'=>'label')
          ['prompt' => 'Select Month', 'id' => 'listMonth', 'name' => 'month']    // options
        )->label(false); ?>
    </div>
    <div class="col-lg-3 col-6">
      <?= $form->field($model, 'year')
        ->dropDownList(
          [
            2020 => 2020,
            2021 => 2021
          ],           // Flat array ('id'=>'label')
          ['prompt' => 'Select Year', 'id' => 'listYear', 'name' => 'year']    // options
        )->label(false); ?>
    </div>
    <div class="col-sm-3 col-6">
      <?= Html::submitButton('Apply', ['id' => 'btnApply', 'class' => 'btn btn-success btn-sm', 'style' => 'float: left; width: 100px; height:33px']) ?>  
    </div>

    <?php ActiveForm::end(); ?>
  </div>
  <div class="row">
    <!-- ./col -->
    <div class="col-lg-4 col-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?= $totalresponse['totalresponse'] ?></h3>

          <p>Respondents</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer" id="link-respondents" onclick="showCsf()">More info <i class="fa fa-arrow-circle-right"></i></a>
        <button type="button" id="box-footer-respondents" style="display:none">Trigger Click</button>
      </div>
    </div>
    <div class="col-lg-4 col-6">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <h3><?= number_format((float)$totalSatifactionRating, 2, '.', '') ?><sup style="font-size: 20px">%</sup></h3>

          <p>Customer Satisfaction Rating</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer box-footer-csf" id="link-csf" onclick="showCsf()">More info <i class="fa fa-arrow-circle-right"></i></a>
        <button type="button" id="box-footer-csr" style="display:none">Trigger Click</button>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?= number_format((float)$nps, 2, '.', '') ?></h3>

          <p>Net Promoter Score</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer box-footer-nps">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>

  <div class="box box-info box-info-csf" style="display:none">
    <div class="box-header with-border">
      <h3 class="box-title">Customer Satisfaction Feedback</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body" style="">
      <?= $this->render('reports', [
        'evaluatioAttribProvider' =>  $evaluatioAttribProvider,
        'importanceAttribbProvider' => $importanceAttribbProvider,
        'evaluationAttrib' => $evaluationAttrib,
        'totalresponse' => $totalresponse,
        //'customerExperiencerating5' => $customerExperiencerating5,
      ]); ?>
    </div>
    <!-- /.box-body 
    <div class="box-footer clearfix" style="">
      <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
      <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
    </div>
    /.box-footer -->
  </div>
  <?php
  //echo '<pre>';
  //echo ($evaluationAttrib[1]['score5'] + 1);
  //echo $month;
  //var_dump (Feedback::find()->select('MONTH(feedback_date) as month')->all());
  //echo '</pre>';
  ?>

</section>

<script>
document.getElementById('listBusiness').value = "<?php echo isset($_GET['id']) ? $_GET['id'] : '';?>"
document.getElementById('listMonth').value = "<?php echo isset($_GET['month']) ? $_GET['month'] : '';?>"
document.getElementById('listYear').value = "<?php echo isset($_GET['year']) ? $_GET['year'] : '';?>"
  jQuery(document).ready(function($) {
    $("#box-footer-respondents").click(function() {
      $("#link-respondents")[0].click();
    });
    $("#box-footer-csr").click(function() {
      $("#link-csr")[0].click();
    });
  });

  function showCsf() {
    $(".box-info-csf").slideToggle();
  }
</script>