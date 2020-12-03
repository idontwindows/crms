<?php

namespace common\models\evaluation;

use Yii;

/**
 * This is the model class for table "tbl_comment".
 *
 * @property integer $comment_id
 * @property integer $feedback_id
 * @property string $answer
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_comment';
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comment_id' => 'Comment ID',
            'feedback_id' => 'Feedback ID',
            'answer' => 'Answer',
        ];
    }
}
