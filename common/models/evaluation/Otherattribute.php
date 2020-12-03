<?php

namespace common\models\evaluation;

use Yii;

/**
 * This is the model class for table "tbl_other_attribute".
 *
 * @property int $other_attribute_id
 * @property int $feedback_id
 * @property string $answer
 */
class Otherattribute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_other_attribute';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['feedback_id', 'answer'], 'required'],
            [['feedback_id'], 'integer'],
            [['answer'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'other_attribute_id' => 'Other Attribute ID',
            'feedback_id' => 'Feedback ID',
            'answer' => 'Answer',
        ];
    }
}
