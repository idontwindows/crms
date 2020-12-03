<?php

namespace common\models\evaluation;

use Yii;

/**
 * This is the model class for table "tbl_customer_experience".
 *
 * @property int $customer_experience_id
 * @property int $feedback_id
 * @property int $rating
 *
 * @property Feedback $feedback
 */
class CustomerExperience extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_customer_experience';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['feedback_id', 'rating'], 'required'],
            [['feedback_id', 'rating'], 'integer'],
            [['feedback_id'], 'exist', 'skipOnError' => true, 'targetClass' => Feedback::className(), 'targetAttribute' => ['feedback_id' => 'feedback_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_experience_id' => 'Customer Experience ID',
            'feedback_id' => 'Feedback ID',
            'rating' => 'Rating',
        ];
    }

    /**
     * Gets query for [[Feedback]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeedback()
    {
        return $this->hasOne(Feedback::className(), ['feedback_id' => 'feedback_id']);
    }
}
