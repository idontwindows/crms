<?php

namespace common\models\evaluation;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class DashboardForm extends Model
{
    public $agency_id;
    public $business_unit_id;
    public $period;
    public $nps;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['agency_id', 'business_unit_id', 'period'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'agency_id' => 'Agency',
            'business_unit_id' => 'Business Unit',
            'period' => 'Period',
        ];
    }

}
