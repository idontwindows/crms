<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\FeedbackAsset;
use common\widgets\Alert;

FeedbackAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="/css/icon.css"> 
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    
    <script src="/js/evaluation/signature_pad.min.js"></script>

    <script src="/js/evaluation/jquery-3.2.1.slim.min.js"></script>
    <script src="/js/evaluation/popper.min.js"></script>
    <script src="/js/evaluation/bootstrap.min.js"></script>
  
    
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php echo $content; ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
