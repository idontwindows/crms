<?php

namespace common\models;
use common\models\evaluation\Agency;

use Yii;

/**
 * This is the model class for table "tbl_profile".
 *
 * @property int $profile_id
 * @property int $user_id
 * @property string $lastname
 * @property string $firstname
 * @property string $designation
 * @property string|null $middleinitial
 * @property int $division_id
 * @property int $unit_id
 * @property string|null $contact_numbers
 * @property string|null $image_url
 * @property string|null $avatar
 * @property int|null $agency_id
 *
 * @property Agency $agency
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'lastname', 'firstname', 'designation', 'division_id', 'unit_id'], 'required'],
            [['user_id', 'division_id', 'unit_id', 'agency_id'], 'integer'],
            [['lastname', 'firstname', 'designation', 'middleinitial'], 'string', 'max' => 50],
            [['contact_numbers', 'image_url', 'avatar'], 'string', 'max' => 100],
            [['user_id'], 'unique'],
            [['agency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Agency::className(), 'targetAttribute' => ['agency_id' => 'agency_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'profile_id' => 'Profile ID',
            'user_id' => 'User ID',
            'lastname' => 'Lastname',
            'firstname' => 'Firstname',
            'designation' => 'Designation',
            'middleinitial' => 'Middleinitial',
            'division_id' => 'Division ID',
            'unit_id' => 'Unit ID',
            'contact_numbers' => 'Contact Numbers',
            'image_url' => 'Image Url',
            'avatar' => 'Avatar',
            'agency_id' => 'Agency ID',
        ];
    }

    /**
     * Gets query for [[Agency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAgency()
    {
        return $this->hasOne(Agency::className(), ['agency_id' => 'agency_id']);
    }
}
