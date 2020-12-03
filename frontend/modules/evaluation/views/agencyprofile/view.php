<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

use kartik\detail\DetailView;
use kartik\editable\Editable;
use kartik\grid\GridView;

use common\models\evaluation\Agency;

/* @var $this yii\web\View */
/* @var $model common\models\evaluation\Agencyprofile */

//$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Evaluation', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Agency Profile';
?>
<div class="agencyprofile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
    <?php $attributes = [
            /*[
                'group'=>true,
                //'label'=>'<center>LDDAP-ADA</center>',
                'rowOptions'=>['class'=>'info'],
            ],
            [
                'group'=>true,
                'label'=>'Details',
                'rowOptions'=>['class'=>'info']
            ],*/
            
            [
                'attribute'=>'agency_id',
                'label'=>'Request Type',
                'inputContainer' => ['class'=>'col-sm-6'],
                'value' => $model->agency->name,
                'type'=>DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                    'data'=>ArrayHelper::map(Agency::find()->orderBy(['agency_id'=>SORT_ASC])->all(),'agency_id','name'),
                    'options' => ['placeholder' => 'Select Agency'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                ],
            ],
            /*[
                'attribute'=>'name',
                'label'=>'Name',
                'inputContainer' => ['class'=>'col-sm-6'],
                'displayOnly'=>true
            ],*/
            [
                'attribute'=>'address',
                'label'=>'Address',
                'inputContainer' => ['class'=>'col-sm-6'],
                'value' => $model->agency->address,
                'displayOnly'=>true
            ],
            [
                'attribute'=>'contact',
                'label'=>'Contact Number',
                'inputContainer' => ['class'=>'col-sm-6'],
                'value' => $model->agency->contact,
                'displayOnly'=>true
            ],
            /*
            [
                'attribute'=>'request_type_id',
                'label'=>'Request Type',
                'inputContainer' => ['class'=>'col-sm-6'],
                'value' => $model->requesttype->name,
                'type'=>DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                    'data'=>ArrayHelper::map(Requesttype::find()->orderBy(['name'=>SORT_ASC])->all(),'request_type_id','name'),
                    'options' => ['placeholder' => 'Select Type'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                ],
            ],
            [
                'attribute'=>'payee_id',
                'label'=>'Payee',
                'inputContainer' => ['class'=>'col-sm-6'],
                'value' => $model->creditor->name,
                'type'=>DetailView::INPUT_SELECT2, 
                'widgetOptions'=>[
                    'data'=>ArrayHelper::map(Creditor::find()->orderBy(['name'=>SORT_ASC])->all(),'creditor_id','name'),
                    'options' => ['placeholder' => 'Select Payee'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
                ],
            ],
            [
                'attribute'=>'particulars',
                'label'=>'Particulars',
                'inputContainer' => ['class'=>'col-sm-6'],
            ],

            [
                'attribute'=>'amount',
                'label'=>'Amount (P)',
                'format'=>['decimal', 2],
                'inputContainer' => ['class'=>'col-sm-6'],
            ],*/
            /*[
                'attribute'=>'status_id',
                'label'=>'Status',
                'inputContainer' => ['class'=>'col-sm-6'],
            ],*/
        ];?>
    <?= DetailView::widget([
            'model' => $model,
            'mode'=>DetailView::MODE_VIEW,
            /*'deleteOptions'=>[ // your ajax delete parameters
                'params' => ['id' => 1000, 'kvdelete'=>true],
            ],*/
            'container' => ['id'=>'kv-demo'],
            //'formOptions' => ['action' => Url::current(['#' => 'kv-demo'])] // your action to delete
            
            //'buttons1' => ( (Yii::$app->user->identity->username == 'Admin') || $model->owner() ) ? '{update}' : '', //hides buttons on detail view
            
            'attributes' => $attributes,
            'condensed' => true,
            'responsive' => true,
            'hover' => true,
            'formOptions' => ['action' => ['agencyprofile/view', 'id' => $model->agency_profile_id]],
            'panel' => [
                //'type' => 'Primary', 
                'heading'=>'Agency Profile',
                'type'=>DetailView::TYPE_PRIMARY,
                //'footer' => '<div class="text-center text-muted">This is a sample footer message for the detail view.</div>'
            ],
        ]); ?>

</div>
