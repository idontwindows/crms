<?php

namespace common\models\evaluation;

use Yii;

/**
 * This is the model class for table "tbl_business_unit".
 *
 * @property integer $business_unit_id
 * @property integer $division_id
 * @property string $code
 * @property string $name
 */
class Businessunit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_business_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['division_id', 'code', 'name'], 'required'],
            [['division_id'], 'integer'],
            [['code'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'business_unit_id' => 'Business Unit ID',
            'division_id' => 'Division ID',
            'code' => 'Code',
            'name' => 'Name',
        ];
    }
    
    public function getDivision()
    {
        return $this->hasOne(Division::className(), ['division_id' => 'division_id']);
    }
}
