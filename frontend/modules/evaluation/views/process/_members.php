<?php
use kartik\grid\GridView;
?>


<div class="panel panel-info">
        <div class="panel-heading"><b>Group 3 Members</b></div>
        <div class="panel-body" id="result-fcfs">
            <?php \yii\widgets\Pjax::begin(); ?>
            <?php
                $gridColumns = [
                        [
                            'attribute' => 'id',
                            'header' => 'ID',
                            'headerOptions' => ['style' => 'text-align: center; bg-color: blue;'],
                            'contentOptions' => ['style' => 'text-align: center; font-weight: bold;'],
                            
                        ],
                        [
                            'attribute' => 'name',
                            'headerOptions' => ['style' => 'text-align: center'],
                            'contentOptions' => ['style' => 'text-align: left; padding-left: 30px;'],
                            /*'value'=>function ($model, $key, $index, $widget) { 
                                        return $model->arrival_time;
                                    },*/
                        ],
                        
                ];

                echo GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'id'=>'processes', //additional
                                    'pjax' => true, // pjax is set to always true for this demo
                                    'pjaxSettings' => [
                                        'options' => [
                                            'enablePushState' => false,
                                        ]
                                    ],
                                    'responsive'=>false,
                                    'striped'=>true,
                                    'hover'=>true,
                                    'columns' => $gridColumns,
                                    'showPageSummary' => true,
                ]);  
                    ?>
                <?php \yii\widgets\Pjax::end(); ?>
                </div>
            </div>