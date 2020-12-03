<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\evaluation\Evaluationattribute */

$this->title = $model->evaluation_attribute_id;
$this->params['breadcrumbs'][] = ['label' => 'Evaluationattributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluationattribute-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->evaluation_attribute_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->evaluation_attribute_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'evaluation_attribute_id',
            'business_unit_id',
            'attribute_name',
            'active',
        ],
    ]) ?>

</div>
