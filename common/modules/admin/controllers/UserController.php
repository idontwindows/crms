<?php

namespace common\modules\admin\controllers;

use common\models\evaluation\Agency;
use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Signup;
use common\models\evaluation\Position;
use common\models\evaluation\Division;
use yii\helpers\ArrayHelper;
use common\models\components\Helper;
use common\models\form\ChangePassword;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //$model= User::findOne(['id'=>$id]);
        //if ($model->load(Yii::$app->request->post())) {
        if ($_POST && $model) {
            $oldPwd=$model->password_hash;
            $obj=Yii::$app->request->post();
            $model->email=$obj['User']['email'];
            $model->username=$obj['User']['username'];
            $model->updated_at=strtotime("now");
            if($oldPwd!=$obj['User']['password_hash']){
                $model->password=$obj['User']['password_hash'];
            }
            $model->save(true);
            Helper::invalidate();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionSignup()
    {
        $model = new Signup();

        $divisions = Division::find()->all();
        //$units = Unit::find()->all();
        $positions = Position::find()->all();
        $agency = Agency::find()->all();

        $listDivisions = ArrayHelper::map($divisions,'division_id','name');
        //$listUnits = ArrayHelper::map($units,'unit_id','name');
        $listPositions = ArrayHelper::map($positions,'name','name');
        $listAgency = ArrayHelper::map($agency,'agency_id','name');

        if ($model->load(Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
                if(Yii::$app->user->isGuest){
                    
                }else{
                   return $this->run('/admin/user'); 
                } 
            }
        }

        return $this->render('signup', [
                'model' => $model,
                'listDivisions' => $listDivisions,
                'listPositions'=>$listPositions,
                'listAgency' => $listAgency 
        ]);
    }
   
    public function actionChangePassword()
    {
        $model = new ChangePassword();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->change()) {
            return $this->goHome();
        }

        return $this->render('change-password', [
                'model' => $model,
        ]);
    }
}
