<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <script src="/js/Chart.min.js"></script>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    
    
    <?= $this->render(
            'header.php'
            //['directoryAsset' => $directoryAsset]
        ); ?>
        
        <?= $this->render(
            'left.php'
            //['directoryAsset' => $directoryAsset]
        ); ?>
   

        <?= $this->render(
            'content.php',
            ['content' => $content]
            //'directoryAsset' => $directoryAsset]
        ); ?>

  <!-- Content Wrapper. Contains page content -->
  
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
