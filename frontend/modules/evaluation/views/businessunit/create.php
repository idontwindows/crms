<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\evaluation\Businessunit */

$this->title = 'Create Businessunit';
$this->params['breadcrumbs'][] = ['label' => 'Businessunits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="businessunit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
