<?php
use kartik\grid\GridView;
use common\models\procurement\Processresult;

$gridColumns = [
    [
                            'attribute' => 'process_id',
                            'header' => 'Process',
                            'headerOptions' => ['style' => 'text-align: center; bg-color: blue;'],
                            'contentOptions' => ['style' => 'text-align: center; font-weight: bold;'],
                            'value'=>function ($model, $key, $index, $widget){ 
                                        return $model->process_id;
                                    },
                            'pageSummary' => 'Average Waiting Time : '.Processresult::getAverageWaitingTime($sessionId).
                                            '<br/>Average Turnaround Time : '.Processresult::getAverageTurnaroundTime($sessionId).
                                            '<br/>CPU Utilization Rate :',
                            'pageSummaryOptions' => ['colspan' => 8]
                        ],
                        [
                            'attribute' => 'arrival_time',
                            'headerOptions' => ['style' => 'text-align: center'],
                            'contentOptions' => ['style' => 'text-align: center;'],
                            'value'=>function ($model, $key, $index, $widget) { 
                                        return $model->arrival_time;
                                    },
                        ],
                        [
                            'attribute' => 'begin',
                            'headerOptions' => ['style' => 'text-align: center'],
                            'contentOptions' => ['style' => 'text-align: center;'],
                            'value'=>function ($model, $key, $index, $widget) { 
                                        return $model->begin;
                                    },
                        ],
                        [
                            'attribute' => 'end',
                            'headerOptions' => ['style' => 'text-align: center'],
                            'contentOptions' => ['style' => 'text-align: center;'],
                            'value'=>function ($model, $key, $index, $widget) { 
                                        return $model->end;
                                    },
                        ],
                        [
                            'attribute' => 'turn_around_time',
                            'headerOptions' => ['style' => 'text-align: center'],
                            'contentOptions' => ['style' => 'text-align: center;'],
                            'value'=>function ($model, $key, $index, $widget) { 
                                        return $model->turn_around_time;
                                    },
                        ],
                        [
                            'attribute' => 'waiting_time',
                            'headerOptions' => ['style' => 'text-align: center'],
                            'contentOptions' => ['style' => 'text-align: center;'],
                            'value'=>function ($model, $key, $index, $widget) { 
                                        return $model->waiting_time;
                                    },
                        ],
                        [
                            'attribute' => 'cpu_utilization',
                            'headerOptions' => ['style' => 'text-align: center'],
                            'contentOptions' => ['style' => 'text-align: center;'],
                            'value'=>function ($model, $key, $index, $widget) { 
                                        return $model->cpu_utilization;
                                    },
                        ],
];

echo GridView::widget([
                    'dataProvider' => $resultDataProvider,
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

<script>
$( document ).ready(function() {
    $(".kv-page-summary").children().next().hide();
}); 
</script>