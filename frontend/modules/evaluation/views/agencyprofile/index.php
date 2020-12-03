<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\evaluation\AgencyprofileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Agencyprofiles';
$this->params['breadcrumbs'][] = ['label' => 'Evaluation', 'url' => ['/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agencyprofile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Agencyprofile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'agency_profile_id',
            'agency_id',
            'name',
            'address',
            'contact',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
