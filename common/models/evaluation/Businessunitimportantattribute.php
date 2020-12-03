<?php

namespace common\models\evaluation;

use Yii;

/**
 * This is the model class for table "tbl_business_unit_important_attribute".
 *
 * @property integer $business_unit_important_attribute_id
 * @property integer $business_unit_id
 * @property integer $important_attribute_id
 */
class Businessunitimportantattribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_business_unit_important_attribute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['business_unit_id', 'important_attribute_id'], 'required'],
            [['business_unit_id', 'important_attribute_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'business_unit_important_attribute_id' => 'Business Unit Important Attribute ID',
            'business_unit_id' => 'Business Unit ID',
            'important_attribute_id' => 'Important Attribute ID',
        ];
    }
}
