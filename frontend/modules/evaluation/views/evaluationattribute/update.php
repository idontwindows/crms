<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\evaluation\Evaluationattribute */

$this->title = 'Update Evaluationattribute: ' . $model->evaluation_attribute_id;
$this->params['breadcrumbs'][] = ['label' => 'Evaluationattributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->evaluation_attribute_id, 'url' => ['view', 'id' => $model->evaluation_attribute_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="evaluationattribute-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
