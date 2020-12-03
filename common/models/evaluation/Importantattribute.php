<?php

namespace common\models\evaluation;

use Yii;

/**
 * This is the model class for table "tbl_important_attribute".
 *
 * @property integer $important_attribute_id
 * @property string $name
 */
class Importantattribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_important_attribute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'important_attribute_id' => 'Important Attribute ID',
            'name' => 'Name',
        ];
    }
}
