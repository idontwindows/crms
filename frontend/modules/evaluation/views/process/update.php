<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\procurement\Process */

$this->title = 'Update Process: ' . $model->process_id;
$this->params['breadcrumbs'][] = ['label' => 'Processes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->process_id, 'url' => ['view', 'id' => $model->process_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="process-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
