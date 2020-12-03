<?php

namespace common\models\evaluation;

use Yii;

/**
 * This is the model class for table "tbl_agency".
 *
 * @property integer $agency_id
 * @property integer $region_id
 * @property string $name
 * @property string $address
 * @property string $contact
 */
class Agency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_agency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'name', 'address', 'contact'], 'required'],
            [['region_id'], 'integer'],
            [['name', 'address'], 'string', 'max' => 200],
            [['contact'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'agency_id' => 'Agency ID',
            'region_id' => 'Region ID',
            'name' => 'Name',
            'address' => 'Address',
            'contact' => 'Contact',
        ];
    }
}
