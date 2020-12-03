<?php

namespace common\models\evaluation;

use Yii;

/**
 * This is the model class for table "tbl_agency_profile".
 *
 * @property integer $agency_profile_id
 * @property integer $agency_id
 * @property string $name
 * @property string $address
 * @property string $contact
 */
class Agencyprofile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_agency_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['agency_id', 'name', 'address', 'contact'], 'required'],
            [['agency_id'], 'integer'],
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
            'agency_profile_id' => 'Agency Profile ID',
            'agency_id' => 'Agency ID',
            'name' => 'Name',
            'address' => 'Address',
            'contact' => 'Contact',
        ];
    }
    
    public function getAgency()
    {
        return $this->hasOne(Agency::className(), ['agency_id' => 'agency_id']);
    }
}
