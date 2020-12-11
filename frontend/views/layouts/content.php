<?php

use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

$StartYear=2019;
$CurYear=date('Y');
if($StartYear>=$CurYear){
    $CopyrightYear=$StartYear;
}else{
    $CopyrightYear=$StartYear.'-'.$CurYear;
}
$Host= "//".Yii::$app->getRequest()->serverName;

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <?php
    echo Breadcrumbs::widget([
      'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
      'tag' => 'ol',
      'activeItemTemplate' => '<li class="active"><span>{link}</span></li>',
      'options' => ['class' => 'breadcrumb breadcrumb-arrow'],
      'homeLink' => [
        'label' => '<i class="glyphicon glyphicon-home"></i>',
        'encode' => false,
        'url' => Yii::$app->homeUrl,
      ],
      'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]);
    ?>
  </section>
  <!-- Main content -->
  <section class="content">
    <?= Alert::widget() ?>
    <?= $content ?>
  </section>
  <!-- /.content -->
</div>

<footer class="main-footer">
  <div class="pull-right hidden-xs">
    CRMS <b>Version</b> 1.0
  </div>
  <strong>Copyright &copy; <?= $CopyrightYear ?> <a href="//region9.dost.gov.ph" target="_blank">DOST-IX</a>.</strong> All rights
  reserved. | <a href="<?= $Host ?>">frontend</a>.
</footer>