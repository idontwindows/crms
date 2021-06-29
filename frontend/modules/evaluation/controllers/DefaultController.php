<?php

namespace frontend\modules\evaluation\controllers;

use common\models\evaluation\Agency;
use common\models\evaluation\DashboardForm;
use common\models\evaluation\Deliveryrating;
use common\models\evaluation\Evaluationattribute;
use common\models\evaluation\Feedback;
use common\models\evaluation\Importancerating;
use common\models\evaluation\Promotion;
use common\models\evaluation\CustomerExperience;
use common\models\evaluation\Agencyprofile;
use common\models\evaluation\VwEvaluationRating;
use frontend\models\evaluationreport;

use yii\web\Controller;
use Yii;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use common\models\User;
use arturoliveira\ExcelView;

/**
 * Default controller for the `Lab` module
 */
class DefaultController extends Controller
{

    public function behaviors()
    {
        return [

            'access' => [
                'class' => AccessControl::className(),
                'only' => ['dashboard'],
                'rules' => [

                    [
                        'actions' => ['dashboard'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $CurrentUser = User::findOne(['user_id' => Yii::$app->user->identity->user_id]);
            $CurrentAgencyid = $CurrentUser->profile->agency_id;
        }
        return $this->redirect(['feedback/index', 'agency_id' => $CurrentAgencyid]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    /*
     public function actionDashboard($period = NULL, $agencyID = NULL, $businessUnitId = NULL)
    {
        $model = new DashboardForm();
        $filter = $model->load(Yii::$app->request->post());
        
        if ($model->load(Yii::$app->request->post())) {
            //return $this->refresh();
            $respondents = Feedback::find()->where(['agency_id' => $model->agency_id, 'business_unit_id' => $model->business_unit_id])->count();
            $csfResults = $this->csfResult($respondents, $model->business_unit_id);
            $csfRating = $this->csfRating($respondents, $csfResults);
            $csf['respondents'] = $respondents;
            $csf['result'] = $csfRating;
            $csf['rating'] = $this->satisfactionIndex($csfRating);
            $csf['nps'] = $this->getNetPromoterScore($respondents);
                
            return $this->render('dashboard', [
                'model' => $model,
                'respondents' => $respondents,
                'csf' => $csf,
                //'csfResults' => $csfResults,
                //'csfRating' => $csfRating,
                //'post' => Yii::$app->request->post(),
            ]);
        } else {
            //$respondents = Feedback::find()->where(['agency_id' => 1])->count();
            $respondents = Feedback::find()->count();
            $csfResults = $this->csfResult($respondents, $model->business_unit_id);
            $csfRating = $this->csfRating($respondents, $csfResults);
            $csf['respondents'] = $respondents;
            $csf['result'] = $csfRating;
            $csf['rating'] = $this->satisfactionIndex($csfRating);
            $csf['nps'] = $this->getNetPromoterScore($respondents);
            
            return $this->render('dashboard', [
                'model' => $model,
                'respondents' => $respondents,
                'csf' => $csf,
                //'csfResults' => $csfResults,
                //'csfRating' => $csfRating,
                //'post' => Yii::$app->request->post(),
            ]);
        }
    }*/

    public function csfResult($respondents, $businessUnitId = NULL)
    {
        $result = [];
        $index = 0;
        if ($businessUnitId) {
            $attributes = Evaluationattribute::find()->where(['business_unit_id' => $businessUnitId])->asArray()->all();
            foreach ($attributes as $attr) {
                $deliveryRatingTally = ['delivery_rating' => ['tally' => [
                    '1' => $this->getDeliveryRatingTally($attr['evaluation_attribute_id'], 1),
                    '2' => $this->getDeliveryRatingTally($attr['evaluation_attribute_id'], 2),
                    '3' => $this->getDeliveryRatingTally($attr['evaluation_attribute_id'], 3),
                    '4' => $this->getDeliveryRatingTally($attr['evaluation_attribute_id'], 4),
                    '5' => $this->getDeliveryRatingTally($attr['evaluation_attribute_id'], 5),
                ]]];

                $deliveryRatingTally['delivery_rating']['total_score'] = $this->computeScore($deliveryRatingTally['delivery_rating']['tally']);
                $deliveryRatingTally['delivery_rating']['SS'] = $deliveryRatingTally['delivery_rating']['total_score'] / $respondents;

                $importanceRatingTally = ['importance_rating' => ['tally' => [
                    '1' => $this->getImportanceRatingTally($attr['evaluation_attribute_id'], 1),
                    '2' => $this->getImportanceRatingTally($attr['evaluation_attribute_id'], 2),
                    '3' => $this->getImportanceRatingTally($attr['evaluation_attribute_id'], 3),
                    '4' => $this->getImportanceRatingTally($attr['evaluation_attribute_id'], 4),
                    '5' => $this->getImportanceRatingTally($attr['evaluation_attribute_id'], 5),
                ]]];

                $importanceRatingTally['importance_rating']['total_score'] = $this->computeScore($importanceRatingTally['importance_rating']['tally']);
                $importanceRatingTally['importance_rating']['IS'] = $importanceRatingTally['importance_rating']['total_score'] / $respondents;

                $result[$index] = array_merge($attr, $deliveryRatingTally, $importanceRatingTally);
                $index++;
            }
        } else {
            $attributes = Evaluationattribute::find()->asArray()->all();
            foreach ($attributes as $attr) {
                $deliveryRatingTally = ['delivery_rating' => ['tally' => [
                    '1' => $this->getDeliveryRatingTally($attr['evaluation_attribute_id'], 1),
                    '2' => $this->getDeliveryRatingTally($attr['evaluation_attribute_id'], 2),
                    '3' => $this->getDeliveryRatingTally($attr['evaluation_attribute_id'], 3),
                    '4' => $this->getDeliveryRatingTally($attr['evaluation_attribute_id'], 4),
                    '5' => $this->getDeliveryRatingTally($attr['evaluation_attribute_id'], 5),
                ]]];

                $deliveryRatingTally['delivery_rating']['total_score'] = $this->computeScore($deliveryRatingTally['delivery_rating']['tally']);
                $deliveryRatingTally['delivery_rating']['SS'] = $deliveryRatingTally['delivery_rating']['total_score'] / $respondents;

                $importanceRatingTally = ['importance_rating' => ['tally' => [
                    '1' => $this->getImportanceRatingTally($attr['evaluation_attribute_id'], 1),
                    '2' => $this->getImportanceRatingTally($attr['evaluation_attribute_id'], 2),
                    '3' => $this->getImportanceRatingTally($attr['evaluation_attribute_id'], 3),
                    '4' => $this->getImportanceRatingTally($attr['evaluation_attribute_id'], 4),
                    '5' => $this->getImportanceRatingTally($attr['evaluation_attribute_id'], 5),
                ]]];

                $importanceRatingTally['importance_rating']['total_score'] = $this->computeScore($importanceRatingTally['importance_rating']['tally']);
                $importanceRatingTally['importance_rating']['IS'] = $importanceRatingTally['importance_rating']['total_score'] / $respondents;

                $result[$index] = array_merge($attr, $deliveryRatingTally, $importanceRatingTally);
                $index++;
            }
        }
        return $result;
    }

    public function getDeliveryRatingTally($evaluationAttributeId, $rating)
    {
        return Deliveryrating::find()->where(['evaluation_attribute_id' => $evaluationAttributeId, 'rating' => $rating])->count();
    }

    public function getImportanceRatingTally($evaluationAttributeId, $rating)
    {
        return Importancerating::find()->where(['evaluation_attribute_id' => $evaluationAttributeId, 'rating' => $rating])->count();
    }

    public function computeScore($tally)
    {
        $score = 0;
        for ($i = 1; $i <= 5; $i++) {
            $score += $i * $tally[$i];
        }

        return $score;
    }

    public function csfRating($respondents, $csfResults)
    {
        $rating = [];
        $sum_IS = 0;
        $sum_WS = 0;
        foreach ($csfResults as $result) {
            array_push($rating, [
                'evaluation_attribute_id' => $result['evaluation_attribute_id'],
                'SS' => $result['delivery_rating']['SS'],
                'IS' => $result['importance_rating']['IS'],
                'gap' => $result['importance_rating']['IS'] - $result['delivery_rating']['SS'],
                //'WF' => $result['importance_rating']['IS'] - $result['delivery_rating']['SS'],
            ]);
            $sum_IS += $result['importance_rating']['IS'];
        }

        for ($i = 0; $i < count($rating); $i++) {
            $rating[$i]['WF'] = ($rating[$i]['IS'] / $sum_IS) * 100;
            $rating[$i]['WS'] = ($rating[$i]['SS'] * $rating[$i]['WF']) / 100;
            $sum_WS += $rating[$i]['WS'];
        }

        return $rating;
    }

    public function satisfactionIndex($result)
    {
        $sum = 0;
        foreach ($result as $res) {
            $sum += $res['WS'];
        }

        return ($sum / 5) * 100;
    }

    public function getNetPromoterScore($respondents)
    {
        $promoters = Promotion::find()->where('rating > 8')->count();
        $passives = Promotion::find()->andWhere([
            'or',
            ['rating' => 7],
            ['rating' => 8]
        ])->count();
        //::find()->where(['between', 'date', "2014-12-31", "2015-02-31" ])->all();
        $detractors = Promotion::find()->where('rating < 7')->count();
        if ($respondents != 0) {
            $nps =  (($promoters / $respondents) * 100) - (($detractors / $respondents) * 100);
        } else {
            $nps = 0;
        }

        return ['score' => $nps, 'promoters' => $promoters, 'passives' => $passives, 'detractors' => $detractors];
    }

    public function actionDashboard($id = 20, $month = 0, $year = 0)
    {

        /***********************************
         * AUTHOR: EDUARDO R. ZARAGOZA JR. *
         * DATE CREATED: DEC 01, 2020      *
         * DOST Regional Office IX         *                         
         ***********************************/

        //$agencyprofile = Agencyprofile::find()->one();
        if($id == 0){

        }else{
            $CurrentUser = User::findOne(['user_id' => Yii::$app->user->identity->user_id]);

        if (Yii::$app->user->can('super-admin')) {
            if (isset($_GET['region'])) {
                $CurrentAgencyid =  $_GET['region'];
            } else {
                $CurrentAgencyid = $CurrentUser->profile->agency_id;
            }
        } else {
            $CurrentAgencyid = $CurrentUser->profile->agency_id;
        }

        $model = new Feedback();
        /*--------delivery rating--------*/
        $feedback = Feedback::find();
        $totalresponse = $feedback->select(['count(*) as totalresponse'])
            ->where(['month(feedback_date)' => $month, 'year(feedback_date)' => $year, 'business_unit_id' => $id, 'agency_id' => $CurrentAgencyid])
            ->asArray()
            ->one();
        $evaluationAttribs = Evaluationattribute::find()->where(['business_unit_id' => $id, 'agency_id' => $CurrentAgencyid])->asArray()->all();

        foreach ($evaluationAttribs as $row) {

            $deliveryrating5 = '(SELECT COUNT(*)
                        FROM tbl_feedback AS a
                        INNER JOIN tbl_delivery_rating AS b ON b.feedback_id = a.feedback_id
                        WHERE b.evaluation_attribute_id =' . $row['evaluation_attribute_id'] .
                ' AND rating = 5
                            AND MONTH(a.feedback_date) =' . $month .
                ' AND YEAR(a.feedback_date) =' . $year .
                ' AND a.agency_id =' . $CurrentAgencyid .
                ' AND a.business_unit_id =' . $id . ')';
            $deliveryrating4 = '(SELECT COUNT(*)
                        FROM tbl_feedback AS a
                        INNER JOIN tbl_delivery_rating AS b ON b.feedback_id = a.feedback_id
                        WHERE b.evaluation_attribute_id =' . $row['evaluation_attribute_id'] .
                ' AND rating = 4
                            AND MONTH(a.feedback_date) =' . $month .
                ' AND YEAR(a.feedback_date) =' . $year .
                ' AND a.agency_id =' . $CurrentAgencyid .
                ' AND a.business_unit_id =' . $id . ')';
            $deliveryrating3 = '(SELECT COUNT(*)
                        FROM tbl_feedback AS a
                        INNER JOIN tbl_delivery_rating AS b ON b.feedback_id = a.feedback_id
                        WHERE b.evaluation_attribute_id =' . $row['evaluation_attribute_id'] .
                ' AND rating = 3
                            AND MONTH(a.feedback_date) =' . $month .
                ' AND YEAR(a.feedback_date) =' . $year .
                ' AND a.agency_id =' . $CurrentAgencyid .
                ' AND a.business_unit_id =' . $id . ')';
            $deliveryrating2 = '(SELECT COUNT(*)
                        FROM tbl_feedback AS a
                        INNER JOIN tbl_delivery_rating AS b ON b.feedback_id = a.feedback_id
                        WHERE b.evaluation_attribute_id =' . $row['evaluation_attribute_id'] .
                ' AND rating = 2
                            AND MONTH(a.feedback_date) =' . $month .
                ' AND YEAR(a.feedback_date) =' . $year .
                ' AND a.agency_id =' . $CurrentAgencyid .
                ' AND a.business_unit_id =' . $id . ')';
            $deliveryrating1 = '(SELECT COUNT(*)
                        FROM tbl_feedback AS a
                        INNER JOIN tbl_delivery_rating AS b ON b.feedback_id = a.feedback_id
                        WHERE b.evaluation_attribute_id =' . $row['evaluation_attribute_id'] .
                ' AND rating = 1
                            AND MONTH(a.feedback_date) =' . $month .
                ' AND YEAR(a.feedback_date) =' . $year .
                ' AND a.agency_id =' . $CurrentAgencyid .
                ' AND a.business_unit_id =' . $id . ')';

            $deliveryscore5 =  $deliveryrating5 . ' *5'; //same as (SELECT COUNT(*)...) * 5
            $deliveryscore4 =  $deliveryrating4 . ' *4'; //same as (SELECT COUNT(*)...) * 4
            $deliveryscore3 =  $deliveryrating3 . ' *3'; //same as (SELECT COUNT(*)...) * 3
            $deliveryscore2 =  $deliveryrating2 . ' *2'; //same as (SELECT COUNT(*)...) * 2
            $deliveryscore1 =  $deliveryrating1 . ' *1'; //same as (SELECT COUNT(*)...) * 1

            $deliveryscoretotal = $deliveryscore5 . ' + ' . $deliveryscore4 . ' + ' . $deliveryscore3 . ' + ' . $deliveryscore2 . ' + ' . $deliveryscore1; //compute total scores

            $ss = '((' . $deliveryscoretotal . ')' . '/' . $totalresponse['totalresponse'] . ')'; //compute ss

            /*--------importance rating--------*/
            $importancerating5 = '(SELECT COUNT(*)
                        FROM tbl_feedback AS a
                        INNER JOIN tbl_importance_rating AS b ON b.feedback_id = a.feedback_id
                        WHERE b.evaluation_attribute_id =' . $row['evaluation_attribute_id'] .
                ' AND rating = 5
                            AND MONTH(a.feedback_date) =' . $month .
                ' AND YEAR(a.feedback_date) =' . $year .
                ' AND a.agency_id =' . $CurrentAgencyid .
                ' AND a.business_unit_id =' . $id . ')';
            $importancerating4 = '(SELECT COUNT(*)
                        FROM tbl_feedback AS a
                        INNER JOIN tbl_importance_rating AS b ON b.feedback_id = a.feedback_id
                        WHERE b.evaluation_attribute_id =' . $row['evaluation_attribute_id'] .
                ' AND rating = 4
                            AND MONTH(a.feedback_date) =' . $month .
                ' AND YEAR(a.feedback_date) =' . $year .
                ' AND a.agency_id =' . $CurrentAgencyid .
                ' AND a.business_unit_id =' . $id . ')';
            $importancerating3 = '(SELECT COUNT(*)
                        FROM tbl_feedback AS a
                        INNER JOIN tbl_importance_rating AS b ON b.feedback_id = a.feedback_id
                        WHERE b.evaluation_attribute_id =' . $row['evaluation_attribute_id'] .
                ' AND rating = 3
                            AND MONTH(a.feedback_date) =' . $month .
                ' AND YEAR(a.feedback_date) =' . $year .
                ' AND a.agency_id =' . $CurrentAgencyid .
                ' AND a.business_unit_id =' . $id . ')';
            $importancerating2 = '(SELECT COUNT(*)
                        FROM tbl_feedback AS a
                        INNER JOIN tbl_importance_rating AS b ON b.feedback_id = a.feedback_id
                        WHERE b.evaluation_attribute_id =' . $row['evaluation_attribute_id'] .
                ' AND rating = 2
                            AND MONTH(a.feedback_date) =' . $month .
                ' AND YEAR(a.feedback_date) =' . $year .
                ' AND a.agency_id =' . $CurrentAgencyid .
                ' AND a.business_unit_id =' . $id . ')';
            $importancerating1 = '(SELECT COUNT(*)
                        FROM tbl_feedback AS a
                        INNER JOIN tbl_importance_rating AS b ON b.feedback_id = a.feedback_id
                        WHERE b.evaluation_attribute_id =' . $row['evaluation_attribute_id'] .
                ' AND rating = 1
                            AND MONTH(a.feedback_date) =' . $month .
                ' AND YEAR(a.feedback_date) =' . $year .
                ' AND a.agency_id =' . $CurrentAgencyid .
                ' AND a.business_unit_id =' . $id . ')';

            $importancescore5 = $importancerating5 . ' *5'; //same as (SELECT COUNT(*)...) * 5
            $importancescore4 = $importancerating4 . ' *4'; //same as (SELECT COUNT(*)...) * 4
            $importancescore3 = $importancerating3 . ' *3'; //same as (SELECT COUNT(*)...) * 3
            $importancescore2 = $importancerating2 . ' *2'; //same as (SELECT COUNT(*)...) * 2
            $importancescore1 = $importancerating1 . ' *1'; //same as (SELECT COUNT(*)...) * 1

            $importancetotalscore = $importancescore5 . ' + ' . $importancescore4 . ' + ' . $importancescore3 . ' + ' . $importancescore2 . ' + ' . $importancescore1;

            $is = '((' . $importancetotalscore . ')' . '/' . $totalresponse['totalresponse'] . ')';

            $gap = '(' . $is . '-' . $ss . ')';

            //$isTotal = +$is;

            $evaluationAttrib[] = Evaluationattribute::find()->select([
                'evaluation_attribute_id',
                'business_unit_id',
                'attribute_name',

                'deliveryscoretotal' =>  $deliveryscoretotal,
                'score5' => $deliveryscore5,
                'score4' => $deliveryscore4,
                'score3' => $deliveryscore3,
                'score2' => $deliveryscore2,
                'score1' => $deliveryscore1,
                'rating5' => $deliveryrating5,
                'rating4' => $deliveryrating4,
                'rating3' => $deliveryrating3,
                'rating2' => $deliveryrating2,
                'rating1' => $deliveryrating1,
                'ss' => $ss,
                'gap' => $gap
            ])
                ->where(['business_unit_id' => $id, 'evaluation_attribute_id' => $row['evaluation_attribute_id']])
                ->asArray()->one();

            $importanceAttrib[] =  Evaluationattribute::find()->select([
                'evaluation_attribute_id',
                'business_unit_id',
                'attribute_name',
                //'rating52' =>strval((int)$importancerating5 * 2),
                'importancetotalscore' => $importancetotalscore,
                'score5' => $importancescore5,
                'score4' => $importancescore4,
                'score3' => $importancescore3,
                'score2' => $importancescore2,
                'score1' => $importancescore1,
                'rating5' => $importancerating5,
                'rating4' => $importancerating4,
                'rating3' => $importancerating3,
                'rating2' => $importancerating2,
                'rating1' => $importancerating1,
                'is' => $is
            ])
                ->where(['business_unit_id' => $id, 'evaluation_attribute_id' => $row['evaluation_attribute_id']])
                ->asArray()->one();
        }

        $customerExperiencerating5 = CustomerExperience::find()
            ->select(['rate5' => 'COUNT(*)'])
            ->where([
                'tbl_feedback.business_unit_id' => $id,
                'MONTH(tbl_feedback.feedback_date)' => $month,
                'YEAR(tbl_feedback.feedback_date)' => $year,
                'tbl_feedback.agency_id' => $CurrentAgencyid,
                'rating' => 5
            ])
            ->joinWith('feedback', false)
            ->asArray()
            ->one();
        $customerExperiencerating4 = CustomerExperience::find()
            ->select(['rate4' => 'COUNT(*)'])
            ->where([
                'tbl_feedback.business_unit_id' => $id,
                'MONTH(tbl_feedback.feedback_date)' => $month,
                'YEAR(tbl_feedback.feedback_date)' => $year,
                'tbl_feedback.agency_id' => $CurrentAgencyid,
                'rating' => 4
            ])
            ->joinWith('feedback', false)
            ->asArray()
            ->one();
        $customerExperiencerating3 = CustomerExperience::find()
            ->select(['rate3' => 'COUNT(*)'])
            ->where([
                'tbl_feedback.business_unit_id' => $id,
                'MONTH(tbl_feedback.feedback_date)' => $month,
                'YEAR(tbl_feedback.feedback_date)' => $year,
                'tbl_feedback.agency_id' => $CurrentAgencyid,
                'rating' => 3
            ])
            ->joinWith('feedback', false)
            ->asArray()
            ->one();
        $customerExperiencerating2 = CustomerExperience::find()
            ->select(['rate2' => 'COUNT(*)'])
            ->where([
                'tbl_feedback.business_unit_id' => $id,
                'MONTH(tbl_feedback.feedback_date)' => $month,
                'YEAR(tbl_feedback.feedback_date)' => $year,
                'tbl_feedback.agency_id' => $CurrentAgencyid,
                'rating' => 2
            ])
            ->joinWith('feedback', false)
            ->asArray()
            ->one();
        $customerExperiencerating1 = CustomerExperience::find()
            ->select(['rate1' => 'COUNT(*)'])
            ->where([
                'tbl_feedback.business_unit_id' => $id,
                'MONTH(tbl_feedback.feedback_date)' => $month,
                'YEAR(tbl_feedback.feedback_date)' => $year,
                'tbl_feedback.agency_id' => $CurrentAgencyid,
                'rating' => 1
            ])
            ->joinWith('feedback', false)
            ->asArray()
            ->one();

        if ($totalresponse['totalresponse'] != 0) {
            $customerExperiencescore5 = ($customerExperiencerating5['rate5'] / $totalresponse['totalresponse']) * 100;
            $customerExperiencescore4 = ($customerExperiencerating4['rate4'] / $totalresponse['totalresponse']) * 100;
            $customerExperiencescore3 = ($customerExperiencerating3['rate3'] / $totalresponse['totalresponse']) * 100;
            $customerExperiencescore2 = ($customerExperiencerating2['rate2'] / $totalresponse['totalresponse']) * 100;
            $customerExperiencescore1 = ($customerExperiencerating1['rate1'] / $totalresponse['totalresponse']) * 100;
        } else {
            $customerExperiencescore5 = 0;
            $customerExperiencescore4 = 0;
            $customerExperiencescore3 = 0;
            $customerExperiencescore2 = 0;
            $customerExperiencescore1 = 0;
        }

        $evaluationAttrib[] = [
            'attribute_name' => 'OVER-ALL CUSTOMER EXPERIENCE',
            'deliveryscoretotal' =>  '',
            'score5' => $customerExperiencescore5,
            'score4' => $customerExperiencescore4,
            'score3' => $customerExperiencescore3,
            'score2' => $customerExperiencescore2,
            'score1' => $customerExperiencescore1,
            'rating5' => $customerExperiencerating5['rate5'],
            'rating4' => $customerExperiencerating4['rate4'],
            'rating3' => $customerExperiencerating3['rate3'],
            'rating2' => $customerExperiencerating2['rate2'],
            'rating1' => $customerExperiencerating1['rate1'],
            'ss' => ''
        ];


        //echo '<pre>';
        //var_dump($evaluationAttrib);
        //echo '</prep';
        $importanceAttriblength = count($importanceAttrib);
        $totalIS = 0;
        $totalWF = 0;
        $totalWS = 0;
        for ($i = 0; $i <= $importanceAttriblength - 1; $i++) {
            $totalIS = $totalIS + $importanceAttrib[$i]['is'];
        }
        for ($j = 0; $j <= $importanceAttriblength - 1; $j++) {
            if (!$importanceAttrib[$j]['is'] == 0) {
                $totalWF = $totalWF + (($importanceAttrib[$j]['is'] / $totalIS) * 100);
            } else {
                $totalWF = 0;
            }
        }
        for ($k = 0; $k <= $importanceAttriblength - 1; $k++) {
            if (!$importanceAttrib[$k]['is'] == 0) {
                $totalWS = $totalWS + ($evaluationAttrib[$k]['ss'] * (($importanceAttrib[$k]['is'] / $totalIS) * 100) / 100);
            } else {
                $totalWS = 0;
            }
        }
        if (!$totalWS == 0) {
            $totalSatifactionRating = ($totalWS / 5) * 100;
        } else {
            $totalSatifactionRating = 0;
        }


        $evaluatioAttribProvider = new ArrayDataProvider([
            'allModels' => $evaluationAttrib,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['evaluation_attribute_id'],
            ],
        ]);
        $importanceAttribbProvider = new ArrayDataProvider([
            'allModels' => $importanceAttrib,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['evaluation_attribute_id'],
            ],
        ]);

        $nps = $this->computeNps($id, $year, $month);
        return $this->render('dashboard', [
            'nps' => $nps,
            'evaluatioAttribProvider' =>  $evaluatioAttribProvider,
            'importanceAttribbProvider' => $importanceAttribbProvider,
            'evaluationAttrib' => $evaluationAttrib,
            'totalresponse' => $totalresponse,
            'totalSatifactionRating' => $totalSatifactionRating,
            'feedback' => $feedback,
            'model' => $model
            //'totalIs' => $isTotal
        ]);
    }
        }
        
    public function computeNps($unitid, $year, $month)
    {
        //$month = '12';
        //$unitid = '20';
        //$year = '2020';
        //$agencyid = '9';

        $CurrentUser = User::findOne(['user_id' => Yii::$app->user->identity->user_id]);

        if (Yii::$app->user->can('super-admin')) {
            if (isset($_GET['region'])) {
                $CurrentAgencyid =  $_GET['region'];
            } else {
                $CurrentAgencyid = $CurrentUser->profile->agency_id;
            }
        } else {
            $CurrentAgencyid = $CurrentUser->profile->agency_id;
        }
        //$promotion = Promotion::find();
        if ($unitid == 0) {
            $promoters = Promotion::find()->where('rating >= 9 
            and MONTH(a.feedback_date)= ' . $month .
                ' and YEAR(a.feedback_date)= ' . $year .
                //' and a.business_unit_id= ' . $unitid .
                ' and a.agency_id= ' . $CurrentAgencyid)
                ->joinWith('feedback as a')->count();
            $detractors = Promotion::find()->where('rating <= 6 
            and MONTH(a.feedback_date)= ' . $month .
                ' and YEAR(a.feedback_date)= ' . $year .
                //' and a.business_unit_id= ' . $unitid .
                ' and a.agency_id= ' . $CurrentAgencyid)
                ->joinWith('feedback as a')->count();
            $passive = Promotion::find()->where('rating BETWEEN 7 and 8
            and MONTH(a.feedback_date)= ' . $month .
                ' and YEAR(a.feedback_date)= ' . $year .
                //' and a.business_unit_id= ' . $unitid .
                ' and a.agency_id= ' . $CurrentAgencyid)
                ->joinWith('feedback as a')->count();
            $total = Promotion::find()->where(
                'MONTH(a.feedback_date)= ' . $month .
                    ' and YEAR(a.feedback_date)= ' . $year .
                    //' and a.business_unit_id= ' . $unitid .
                    ' and a.agency_id= ' . $CurrentAgencyid
            )
                ->joinWith('feedback as a')->count();
        }else{
            $promoters = Promotion::find()->where('rating >= 9 
            and MONTH(a.feedback_date)= ' . $month .
            ' and YEAR(a.feedback_date)= ' . $year .
            ' and a.business_unit_id= ' . $unitid .
            ' and a.agency_id= ' . $CurrentAgencyid)
            ->joinWith('feedback as a')->count();
        $detractors = Promotion::find()->where('rating <= 6 
            and MONTH(a.feedback_date)= ' . $month .
            ' and YEAR(a.feedback_date)= ' . $year .
            ' and a.business_unit_id= ' . $unitid .
            ' and a.agency_id= ' . $CurrentAgencyid)
            ->joinWith('feedback as a')->count();
        $passive = Promotion::find()->where('rating BETWEEN 7 and 8
        and MONTH(a.feedback_date)= ' . $month .
            ' and YEAR(a.feedback_date)= ' . $year .
            ' and a.business_unit_id= ' . $unitid .
            ' and a.agency_id= ' . $CurrentAgencyid)
            ->joinWith('feedback as a')->count();
        $total = Promotion::find()->where(
            'MONTH(a.feedback_date)= ' . $month .
                ' and YEAR(a.feedback_date)= ' . $year .
                ' and a.business_unit_id= ' . $unitid .
                ' and a.agency_id= ' . $CurrentAgencyid
        )
            ->joinWith('feedback as a')->count();
        }
        
        if ($total) {
            $nps = (($promoters / $total) * 100) - (($detractors / $total) * 100);
        } else {
            $nps = 0;
        }
        $npsArray = [$promoters, $detractors, $nps, $passive];
        return $npsArray;
    }
    public function actionReport2(){  
        $exporter = new evaluationreport();
        //if(Yii::$app->request->isAjax){
        $exporter->loaddoc();
        ob_end_clean();
        $exporter->save('./report/report.xls');
    }
}
