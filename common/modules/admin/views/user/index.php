<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = 'Users';
?>
<div class="user-index">


    <div class="panel panel-default col-xs-12">
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i><?= ' ' . $this->title ?></div>
        <div class="panel-body">
            <p>
                <?= Html::a('Create User', ['signup'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php // echo $this->render('_search', ['model' => $searchModel]); 
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'summary' => false,
                'columns' => [
                    ['class' => 'kartik\grid\SerialColumn'],

                    //'user_id',
                    'username',
                    //'auth_key',
                    //'password_hash',
                    //'password_reset_token',
                    'email:email',
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            if ($model->status == 10) {
                                return 'Active';
                            } else {
                                return 'Inactive';
                            }
                        }
                    ],
                    //'created_at',
                    //'updated_at',

                    ['class' => 'kartik\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>