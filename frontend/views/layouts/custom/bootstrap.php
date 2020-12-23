<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\evaluation\Agency;

AppAsset::register($this);
$agency = Agency::find()->where(['agency_id' => $_GET['agency_id']])->one();
$StartYear = 2019;
$CurYear = date('Y');
if ($StartYear >= $CurYear) {
    $CopyrightYear = $StartYear;
} else {
    $CopyrightYear = $StartYear . '-' . $CurYear;
}
$Host = "//" . Yii::$app->getRequest()->serverName;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <title>CSF</title>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <nav class="navbar" style="background-color:#343A40">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/site/index" style="color:white; font-weight:bold"><span class="glyphicon glyphicon-stats"></span> CRMS</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" style="color:white; pointer-events: none;"><?= $agency ? $agency->name : '' ?></a></li>
            </ul>
        </div>

    </nav>

    <div>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
    <div class="footer">
        <div class="pull-right hidden-xs" style="margin-right:5px; color:black;">
            CRMS <b>Version</b> 1.0
        </div>
        <div style="margin-left:5px; color:black;">
            <strong>Copyright &copy; <?= $CopyrightYear ?> <a href="//region9.dost.gov.ph" target="_blank">DOST-IX</a>.</strong> All rights
            reserved. | <a href="<?= $Host ?>">frontend</a>.
        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>