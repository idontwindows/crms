<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <?php
        echo Breadcrumbs::widget([
          'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
          'tag'=>'ol', 
          'activeItemTemplate'=>'<li class="active"><span>{link}</span></li>',
          'options'=>['class'=>'breadcrumb breadcrumb-arrow'],
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