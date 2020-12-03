<?php

namespace common\models\evaluation;


use Yii;

/**
 * This is the model class for table "tbl_evaluation_attribute".
 *
 * @property integer $evaluation_attribute_id
 * @property integer $business_unit_id
 * @property string $attribute_name
 * @property integer $active
 */
class Evaluationattribute extends \yii\db\ActiveRecord
{
    public $rating5,$rating4,$rating3,$rating2,$rating1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_evaluation_attribute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['business_unit_id', 'attribute_name'], 'required'],
            [['business_unit_id', 'active'], 'integer'],
            [['attribute_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'evaluation_attribute_id' => 'Evaluation Attribute ID',
            'business_unit_id' => 'Business Unit ID',
            'attribute_name' => 'Attribute Name',
            'active' => 'Active',
        ];
    }
    
    public function getBusinessunit()
    {
        return $this->hasOne(Businessunit::className(), ['business_unit_id' => 'business_unit_id']);
    }
    public function getDeliveryrating(){
        return $this->hasMany(Deliveryrating::className(),['evaluation_attribute_id' => 'evaluation_attribute_id']);
    }
    public function getFeedback(){
        return $this->hasMany(Feedback::className(),['business_unit_id' => 'business_unit_id']);
    }
}
