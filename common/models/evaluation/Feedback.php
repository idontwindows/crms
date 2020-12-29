<?php

namespace common\models\evaluation;

use Yii;

/**
 * This is the model class for table "tbl_feedback".
 *
 * @property integer $feedback_id
 * @property integer $agency_id
 * @property integer $business_unit_id
 * @property string $feedback_date
 */
class Feedback extends \yii\db\ActiveRecord
{
    public $rating5,$rating4,$rating3,$rating2,$rating1,$month,$year,$region;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['agency_id','region', 'business_unit_id', 'feedback_date','month','year'], 'required'],
            [['agency_id', 'business_unit_id'], 'integer'],
            [['customer_name', 'email'], 'string', 'max' => 200],
            [['feedback_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'feedback_id' => 'Feedback ID',
            'agency_id' => 'Agency ID',
            'business_unit_id' => 'Business Unit ID',
            'feedback_date' => 'Feedback Date',
            'customer_name' => 'Customer Name',
            'email' => 'Email Address',
        ];
    }
    public function getDeliveryrating(){
        return $this->hasOne(Deliveryrating::className(),['feedback_id' => 'feedback_id']);
    }
    public function getImportancerating(){
        return $this->hasMany(Importancerating::className(),['feedback_id' => 'feedback_id']);
    }
}
