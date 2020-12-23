<?php

namespace frontend\modules\evaluation\controllers;

use Yii;
use common\models\evaluation\Feedback;
use common\models\evaluation\FeedbackSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Url;

use common\models\evaluation\Agencyprofile;
use common\models\evaluation\Businessunit;
use common\models\evaluation\Comment;
use common\models\evaluation\Customer;
use common\models\evaluation\Deliveryrating;
use common\models\evaluation\Evaluationattribute;
use common\models\evaluation\Importancerating;
use common\models\evaluation\Otherattribute;
use common\models\evaluation\Promotion;
use common\models\evaluation\CustomerExperience;
use common\models\User;


/**
 * FeedbackController implements the CRUD actions for Feedback model.
 */


class FeedbackController extends Controller
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
     * Lists all Feedback models.
     * @return mixed
     */
    public function actionIndex($agency_id)
    {
        //$searchModel = new FeedbackSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (Yii::$app->user->isGuest){
            $this->layout = '@app/views/layouts/custom/bootstrap';
        }

        //$agencyprofile = Agencyprofile::find()->one();


        $counter = [];
        
        $businessUnits = Businessunit::find()->asArray()->all();
        foreach($businessUnits as $businessUnit){
            $counter[$businessUnit['business_unit_id']] = Feedback::find()->where(['business_unit_id' => $businessUnit['business_unit_id'],'agency_id'=> !Yii::$app->user->isGuest ? $this->getCurrentAgencyid() : $agency_id])->count();
        }
        return $this->render('index_', [
            //'searchModel' => $searchModel,
            //'dataProvider' => $dataProvider,
            //'businessUnits' => $businessUnits,
            'counter' => $counter,
            'currentAgencyId' => $this->getCurrentAgencyid()
        ]);
    }

    /**
     * Displays a single Feedback model.
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
     * Creates a new Feedback model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($business_unit_id,$agency_id)
    {
        $this->layout = 'feedback';
        $model = new Feedback();
        
        //$modelCustomer = new Customer();
        $modelComment = new Comment();
        $modelDeliveryrating = new Deliveryrating();
        $modelImportancerating = new Importancerating();
        $modelPromotion = new Promotion();
        $modelOtherattribute = new Otherattribute();
        $modelCustomerExperience = new CustomerExperience();
        
        $ratingScale = [
            '1' => 'Very Dissatisfied',
            '2' => 'Quite Dissatisfied',
            '3' => 'Neither Satisfied nor Dissatisfied',
            '4' => 'Very Satisfied',
            '5' => 'Outstanding',
        ];
        $ratingPromotion = [
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4,
            '5' => 5,
            '6' => 6,
            '7' => 7,
            '8' => 8,
            '9' => 9,
            '10' => 10,
        ];
        
        date_default_timezone_set('Asia/Manila');
        $model->feedback_date = date("Y-m-d H:i:s");
        //$model->business_unit_id = $_GET['business_unit_id'];
        $model->business_unit_id = $business_unit_id;
        
        $model->agency_id = $_GET['agency_id'];
        
  
        //$evaluationAttributes = Evaluationattribute::find($model->business_unit_id)->all();
        $evaluationAttributes = Evaluationattribute::find()->where(['business_unit_id' => $business_unit_id,'agency_id' => !Yii::$app->user->isGuest ? $this->getCurrentAgencyid() : $agency_id])->all();
        
        
        if ($model->load(Yii::$app->request->post()) && $modelDeliveryrating->load(Yii::$app->request->post())) {
            //if($model->validate(true)){
                //if($this->validateDeliveryRatings($_POST['Deliveryrating']) && $model->save()){
                $uniq = uniqid();
                define('UPLOAD_DIR', 'signature/');
                $base64_string = $_POST['Feedback']['signature'];
                $data = explode(',', $base64_string);
                $file = UPLOAD_DIR . $uniq . '.png';
                file_put_contents($file, base64_decode($data[1]));
                $model->signature = $file;
        

                if($model->save(false)){
                    foreach($_POST['Deliveryrating'] as $deliveryRating){
                        $modelDeliveryrating = new Deliveryrating();
                        $modelDeliveryrating->feedback_id = $model->feedback_id;
                        $modelDeliveryrating->evaluation_attribute_id = $deliveryRating['evaluation_attribute_id'];
                        $modelDeliveryrating->rating = $deliveryRating['rating'];
                        $modelDeliveryrating->save();
                    }
                    
                    foreach($_POST['Importancerating'] as $importanceRating){
                        $modelImportancerating = new Importancerating();
                        $modelImportancerating->feedback_id = $model->feedback_id;
                        $modelImportancerating->evaluation_attribute_id = $importanceRating['evaluation_attribute_id'];
                        $modelImportancerating->rating = $importanceRating['rating'];
                        $modelImportancerating->save();
                    }
                    
                    $promotion = new Promotion();
                    $promotion->feedback_id = $model->feedback_id;
                    $promotion->rating = $_POST['Promotion']['rating'];
                    $promotion->save();
                    
                    $comment = new Comment();
                    $comment->feedback_id = $model->feedback_id;
                    $comment->answer = $_POST['Comment']['answer'];
                    $comment->save();
                    
                    $otherAttribute = new Otherattribute();
                    $otherAttribute->feedback_id = $model->feedback_id;
                    $otherAttribute->answer = $_POST['Otherattribute']['answer'];
                    $otherAttribute->save();

                    $modelCustomerExperience = new CustomerExperience();
                    $modelCustomerExperience->feedback_id = $model->feedback_id;
                    $modelCustomerExperience->rating = $_POST['CustomerExperience']['rating'];
                    $modelCustomerExperience->save();
                    
                    //return $this->redirect(['view', 'id' => $model->feedback_id]); 
                    //return $this->renderAjax(['thankyou']);
               
                }else{
                    return Yii::$app->session->setFlash('kv-detail-success', 'Please complete the form!');
                }
            //}
            
            
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelComment' => $modelComment,
                'modelDeliveryrating' => $modelDeliveryrating,
                'modelImportancerating' => $modelImportancerating,
                'modelOtherattribute' => $modelOtherattribute,
                'modelPromotion' => $modelPromotion,
                'evaluationAttributes' => $evaluationAttributes,
                'ratingScale' => $ratingScale,
                'ratingPromotion' => $ratingPromotion,
                'modelCustomerExperience' => $modelCustomerExperience,
                
            ]);
        }
    }

    private function validateDeliveryRatings($ratings)
    {
        $model = new Deliveryrating();
        //$validated = false;
        
        if(!$model->validateMultiple($ratings))
                return false;
        
        /*foreach($ratings as $rating){
            $model->load(Yii::$app->request->post($rating));
            //$validated = $rating['rating'] ? true : false;
            if(!$model->validate())
                return false;
        }*/
        else
            return true;
    }
    /**
     * Updates an existing Feedback model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->feedback_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Feedback model.
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
     * Finds the Feedback model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Feedback the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Feedback::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionOwldemo()
    {
        $this->layout = 'feedback';
        return $this->render('__form');
    }
    public function getCurrentAgencyid(){
        if(!Yii::$app->user->isGuest){
            $CurrentUser= User::findOne(['user_id'=> Yii::$app->user->identity->user_id]);
            return $CurrentUser->profile->agency_id;
        }else{
            return null;
        }

    }

    /*
    public function actionSignatureform()
    {
        return $this->renderAjax('_signatureform');
    }*/
}
