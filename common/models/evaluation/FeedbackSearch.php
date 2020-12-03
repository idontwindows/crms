<?php

namespace common\models\evaluation;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\evaluation\Feedback;

/**
 * FeedbackSearch represents the model behind the search form about `common\models\evaluation\Feedback`.
 */
class FeedbackSearch extends Feedback
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feedback_id', 'agency_id', 'business_unit_id'], 'integer'],
            [['feedback_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Feedback::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'feedback_id' => $this->feedback_id,
            'agency_id' => $this->agency_id,
            'business_unit_id' => $this->business_unit_id,
            'feedback_date' => $this->feedback_date,
        ]);

        return $dataProvider;
    }
}
