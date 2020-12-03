<?php

namespace common\models\evaluation;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\evaluation\Businessunit;

/**
 * BusinessunitSearch represents the model behind the search form about `common\models\evaluation\Businessunit`.
 */
class BusinessunitSearch extends Businessunit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['business_unit_id', 'division_id'], 'integer'],
            [['code', 'name'], 'safe'],
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
        $query = Businessunit::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 7,
            ],
            'sort' => [
                'defaultOrder' => [
                    'division_id' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'business_unit_id' => $this->business_unit_id,
            'division_id' => $this->division_id,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
