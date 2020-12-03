<?php

namespace common\models\evaluation;

use Yii;

/**
 * This is the model class for table "tbl_division".
 *
 * @property integer $division_id
 * @property string $code
 * @property string $name
 *
 * @property DivisionHead[] $divisionHeads
 */
class Division extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_division';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
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
            'division_id' => 'Division ID',
            'code' => 'Code',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDivisionHeads()
    {
        return $this->hasMany(DivisionHead::className(), ['division_id' => 'division_id']);
    }
    
    public function getBusinessunits()
    {
        return $this->hasMany(Businessunit::className(), ['division_id' => 'division_id']);
    }
}
