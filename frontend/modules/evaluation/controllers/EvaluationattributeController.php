<?php

namespace frontend\modules\evaluation\controllers;

use Yii;
use common\models\evaluation\Evaluationattribute;
use common\models\evaluation\EvaluationattributeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;

/**
 * EvaluationattributeController implements the CRUD actions for Evaluationattribute model.
 */
class EvaluationattributeController extends Controller
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
     * Lists all Evaluationattribute models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EvaluationattributeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Evaluationattribute model.
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
     * Creates a new Evaluationattribute model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $CurrentUser= User::findOne(['user_id'=> Yii::$app->user->identity->user_id]);
        $CurrentAgencyId = $CurrentUser->profile->agency_id;
        $model = new Evaluationattribute();
        $model->agency_id = $CurrentAgencyId;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Attribute Successfully Created!');
            }
            return $this->redirect(['index']);
            
        }elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('_form', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Evaluationattribute model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Attribute Successfully updated');
            }
            return $this->redirect(['index']);
 
        }elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('_form', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Evaluationattribute model.
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
     * Finds the Evaluationattribute model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Evaluationattribute the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evaluationattribute::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
