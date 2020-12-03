<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\evaluation\Businessunit */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Businessunits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="businessunit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->business_unit_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->business_unit_id], [
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
            'business_unit_id',
            'division_id',
            'code',
            'name',
        ],
    ]) ?>

</div>
