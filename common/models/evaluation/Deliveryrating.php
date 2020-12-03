<?php

namespace common\models\evaluation;

use Yii;

/**
 * This is the model class for table "tbl_delivery_rating".
 *
 * @property integer $delivery_rating_id
 * @property integer $feedback_id
 * @property integer $evaluation_attribute_id
 * @property integer $rating
 */
class Deliveryrating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_delivery_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['evaluation_attribute_id',], 'required'],
            [['feedback_id', 'evaluation_attribute_id', 'rating'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'delivery_rating_id' => 'Delivery Rating ID',
            'feedback_id' => 'Feedback ID',
            'evaluation_attribute_id' => 'Evaluation Attribute ID',
            'rating' => 'Rating',
        ];
    }

    public function getFeedback()
    {
        //return $this->hasOne(Feedback::className(), ['feedback_id' => 'feedback_id'])->andOnCondition(['active' => 1]);
        return $this->hasOne(Feedback::className(), ['feedback_id' => 'feedback_id'])->andOnCondition(['active' => 1]);
    }
}
