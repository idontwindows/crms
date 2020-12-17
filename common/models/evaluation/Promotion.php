<?php

namespace common\models\evaluation;

use Yii;

/**
 * This is the model class for table "tbl_promotion".
 *
 * @property integer $promotion_id
 * @property integer $feedback_id
 * @property integer $rating
 */
class Promotion extends \yii\db\ActiveRecord
{
    public $promoters;
    public $detractors;
    public $total;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_promotion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feedback_id', 'rating'], 'required'],
            [['feedback_id', 'rating'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'promotion_id' => 'Promotion ID',
            'feedback_id' => 'Feedback ID',
            'rating' => 'Rating',
        ];
    }
    public function getFeedback(){
        return $this->hasOne(Feedback::className(),['feedback_id' => 'feedback_id']);
    }
}
