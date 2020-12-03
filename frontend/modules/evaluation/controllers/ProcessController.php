<?php

namespace frontend\modules\cpu\controllers;

use Yii;
use common\models\procurement\Process;
use common\models\procurement\Processresult;
use common\models\procurement\ProcessSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Query;
/**
 * ProcessController implements the CRUD actions for Process model.
 */
class ProcessController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Process models.
     * @return mixed
     */
    public function actionIndex($numberOfProcess = NULL, $sessionId = NULL, $timeQuantum = NULL)
    {
        if(isset($_GET['sessionId']))
            $sessionId = $_GET['sessionId'];
        else    
            $sessionId = Yii::$app->security->generateRandomString(12);
        
        if(isset($_GET['numberOfProcess']))
            $numberOfProcess = $_GET['numberOfProcess'];
        else
            $numberOfProcess = 0;
        
        $processes = $this->generateProcesses($numberOfProcess, $sessionId);
        
        $processDataProvider = Process::find()->where(['session_id' => $sessionId]);
        
        $resultFcfsDataProvider = Processresult::find()->where(['session_id' => $sessionId, 'process_result_type'=>1]);
        $resultRrDataProvider = Processresult::find()->where(['session_id' => $sessionId, 'process_result_type'=>2]);
        
        $resultFcfsDataProvider = new ActiveDataProvider([
            'query' => $resultFcfsDataProvider,
            'pagination' => false
        ]);
        
        $resultRrDataProvider = new ActiveDataProvider([
            'query' => $resultRrDataProvider,
            'pagination' => false
        ]);
        
        $processDataProvider = new ActiveDataProvider([
            'query' => $processDataProvider,
            'pagination' => false
        ]);
        
        return $this->render('index', [
            //'searchModel' => $searchModel,
            'processDataProvider' => $processDataProvider,
            'resultFcfsDataProvider' => $resultFcfsDataProvider,
            'resultRrDataProvider' => $resultRrDataProvider,
            'numberOfProcess' => $numberOfProcess,
            'timeQuantum' => $timeQuantum,
            'sessionId' => $sessionId,
            'processes' => $processes,
        ]);
    }

    private function generateProcesses($numberOfProcess, $sessionId)
    {
        $processes = [];
        for ($count = 1; $count <= $numberOfProcess; $count++) {
            $p = [
                'process_id' => '',
                'name' => 'P'.$count,
                'arrival_time' => 0,
                'burst_time' => 0,
                'priority' => 0,
                'session_id' => $sessionId
            ];
            array_push($processes, $p);
        }
        
        $existingProcesses = Process::find()->where(['session_id' => $sessionId])->count();
        
        if($existingProcesses != $numberOfProcess){
            \Yii::$app
            ->db
            ->createCommand()
            ->delete('tbl_process', ['session_id' => $sessionId])
            ->execute();
            
            Yii::$app->db
            ->createCommand()
            ->batchInsert('tbl_process', ['process_id','name','arrival_time', 'burst_time','priority','session_id'],$processes)
            ->execute();
        }
        
        return $processes;
    }
    /**
     * Displays a single Process model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Process model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Process();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->process_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Process model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->process_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionMembers()
    {
        //$model = $this->findModel($id);
        $members = [
            ['id'=>1, 'name'=>'ALVAREZ, JERRYWIL CHRISTOPHER VASQUEZ'],
            ['id'=>2, 'name'=>'BENHALID, RASCHID CARPIO'],
            ['id'=>3, 'name'=>'GALLENO, EDEN GREGORIO'],
            ['id'=>4, 'name'=>'JOLO, MICHAEL MORALES'],
            ['id'=>5, 'name'=>'MORATALLA, ARIS DESPALO'],
            ['id'=>6, 'name'=>'PALACIO, KLANSYS REEN ANN LACASTESANTOS'],
            ['id'=>7, 'name'=>'SALIM, MOHAMMAD RASID'],
        ];
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $members,
            'pagination' => false
        ]);
        return $this->render('_members', [
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Deletes an existing Process model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Process model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Process the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Process::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionUpdatearrivaltime() {
       if (Yii::$app->request->post('hasEditable')) {
           $ids = Yii::$app->request->post('editableKey');
           
           $index = Yii::$app->request->post('editableIndex');
           $attr = Yii::$app->request->post('editableAttribute');
           $qty = $_POST['Process'][$index][$attr];
           $model = Process::findOne($ids);
           $model->$attr = $qty; 
           if($model->save(false))
               return true;
           else
               return false;
       }
    }
    
    public function actionUpdatebursttime() {
       if (Yii::$app->request->post('hasEditable')) {
           $ids = Yii::$app->request->post('editableKey');
           
           $index = Yii::$app->request->post('editableIndex');
           $attr = Yii::$app->request->post('editableAttribute');
           $qty = $_POST['Process'][$index][$attr];
           $model = Process::findOne($ids);
           $model->$attr = $qty; 
           if($model->save(false))
               return true;
           else
               return false;
       }
    }
    
    public function actionUpdatepriority() {
       if (Yii::$app->request->post('hasEditable')) {
           $ids = Yii::$app->request->post('editableKey');
           
           $index = Yii::$app->request->post('editableIndex');
           $attr = Yii::$app->request->post('editableAttribute');
           $qty = $_POST['Process'][$index][$attr];
           $model = Process::findOne($ids);
           $model->$attr = $qty; 
           if($model->save(false))
               return true;
           else
               return false;
       }
    }
    
    public function actionFcfs($numberOfProcess, $sessionId)
    {   
        // is not safe
        Yii::$app->controller->enableCsrfValidation = false;

        // set response header
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        //$numberOfProcess = $_POST['numberOfProcess'];
        //$sessionId = $_POST['sessionId'];
        
        $processes = Process::find()
                        ->where(['session_id' => $sessionId])
                        ->orderBy([
                          'arrival_time' => SORT_ASC,
                          'name'=>SORT_ASC
                        ])
                        ->asArray()
                        ->all();
        
        
        $resultDataProvider = $this->calculateFCFS($processes, $numberOfProcess, $sessionId);
        
        return $resultDataProvider;
    }
    
    private function calculateFCFS($processes, $numberOfProcess, $sessionId)
    {
        $result = [];
        $gantt = [];
        $row = [
            'process_result_id' => 0, 
            'process_result_type' => 1, 
            'process_id' => 0,
            'session_id' => '',
            'arrival_time' => 0,
            'begin' => 0,
            'end' => 0,
            'turnaround_time' => 0,
            'waiting_time' => 0,
            'cpu' => 0
        ];
        $waiting_time = 0;
        
        foreach($processes as $p)
        {
            
            $out = $row;
            $out['process_result_id'] = '';
            $out['process_id'] = $p['name'];
            $out['session_id'] = $p['session_id'];
            $out['arrival_time'] = $p['arrival_time'];
            $out['begin'] = $waiting_time;
            $out['end'] = $waiting_time + $p['burst_time'];
            $out['turnaround_time'] = $out['end'] - $out['arrival_time'];
            $out['waiting_time'] = $waiting_time - $out['arrival_time'];
            $out['cpu'] = $p['burst_time'];
            
            $waiting_time += $p['burst_time'];
            //$g = ['process'=>$out['process_id'],'bt'=>$p['burst_time']];
            $g = ['process'=>$out['process_id'],'bt'=>$out['end']];
            
            array_push($result, $out);
            array_push($gantt, $g);
        }
        
        if($result){
            Yii::$app->db
                ->createCommand()
                ->batchInsert('tbl_process_result', ['process_result_id', 'process_result_type', 'process_id',	'session_id', 'arrival_time', 'begin', 'end', 'turn_around_time', 'waiting_time', 'cpu_utilization'],$result)
                ->execute();
        }
        
        return $gantt;
        
        
    }
    
    public function actionRr($numberOfProcess, $sessionId, $timeQuantum)
    {   
        // is not safe
        Yii::$app->controller->enableCsrfValidation = false;

        // set response header
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        
        //$numberOfProcess = $_POST['numberOfProcess'];
        //$sessionId = $_POST['sessionId'];
        
        $processes = Process::find()
                        ->where(['session_id' => $sessionId])
                        ->orderBy([
                          'arrival_time' => SORT_ASC,
                          'name'=>SORT_ASC
                        ])
                        ->asArray()
                        ->all();
        
        
        $resultDataProvider = $this->calculateRR($processes, $numberOfProcess, $sessionId, $timeQuantum);
        
        return $resultDataProvider;
    }
    
    private function calculateRR($processes, $numberOfProcess, $sessionId, $timeQuantum)
    {
        $result = [];
        $out = [];
        $gantt = [];
        $total_time = 0;
        $waiting_time = 0;
        ini_set('max_execution_time', 300);
        
        foreach($processes as $p){
            $row = [
                'process_result_id' => '', 
                'process_result_type' => 2, 
                'process_id' => $p['name'],
                'session_id' => $p['session_id'],
                'arrival_time' =>  $p['arrival_time'],
                'begin' => 0,
                'end' => 0,
                'turnaround_time' => 0,
                'waiting_time' => 0,
                'cpu' => $p['burst_time'],
            ];
            
            array_push($out, $row);
            array_push($result, [
                'burst_time' => $p['burst_time'], 
                'remaining_burst_time' => $p['burst_time'],
                'completion_time' => 0,
                'waiting_time' => 0,
            ]);
            
            $total_time += $p['burst_time'];
        }
        $t = 0;
        
        while($t < $total_time){
            for($i=0; $i<$numberOfProcess; $i++){
                if($result[$i]['remaining_burst_time'] > 0){
                    $out[$i]['begin'] = ($result[$i]['burst_time'] == $result[$i]['remaining_burst_time']) ? $t : $out[$i]['begin'];
                    
                    if($result[$i]['remaining_burst_time'] < $timeQuantum){
                        $t += $result[$i]['remaining_burst_time'];
                        $result[$i]['remaining_burst_time'] -= $result[$i]['remaining_burst_time'];
                    }else{
                        $t += $timeQuantum;
                        $result[$i]['remaining_burst_time'] -= $timeQuantum;
                    }

                    if($result[$i]['remaining_burst_time'] == 0){
                        $out[$i]['end'] = $t;
                        $result[$i]['completion_time'] = $t;
                        $out[$i]['turnaround_time'] = $result[$i]['completion_time'] - $out[$i]['arrival_time'];
                        $out[$i]['waiting_time'] = $out[$i]['turnaround_time'] - $result[$i]['burst_time'];
                    } 
                    //$out[$i]['end'] = ($result[$i]['remaining_burst_time'] == 0) ? $t : $out[$i]['end'];
                    
                    $g = ['process'=>$out[$i]['process_id'],'bt'=>$t, 'rm'=>$result[$i]['remaining_burst_time']];
                    array_push($gantt, $g);
                }
            }
        }
        
        if($out){
            Yii::$app->db
                ->createCommand()
                ->batchInsert('tbl_process_result', ['process_result_id', 'process_result_type', 'process_id',	'session_id', 'arrival_time', 'begin', 'end', 'turn_around_time', 'waiting_time', 'cpu_utilization'],$out)
                ->execute();
        }
        return $gantt;
    }
}
