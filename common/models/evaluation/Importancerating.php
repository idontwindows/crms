<?php

namespace common\models\evaluation;

use Yii;

/**
 * This is the model class for table "tbl_importance_rating".
 *
 * @property integer $importance_rating_id
 * @property integer $feedback_id
 * @property integer $evaluation_attribute_id
 * @property integer $rating
 */
class Importancerating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_importance_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feedback_id', 'evaluation_attribute_id'], 'required'],
            [['feedback_id', 'evaluation_attribute_id', 'rating'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'importance_rating_id' => 'Importance Rating ID',
            'feedback_id' => 'Feedback ID',
            'evaluation_attribute_id' => 'Evaluation Attribute ID',
            'rating' => 'Rating',
        ];
    }
}
