<?php

namespace common\models\evaluation;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\evaluation\Agencyprofile;

/**
 * AgencyprofileSearch represents the model behind the search form about `common\models\evaluation\Agencyprofile`.
 */
class AgencyprofileSearch extends Agencyprofile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['agency_profile_id', 'agency_id'], 'integer'],
            [['name', 'address', 'contact'], 'safe'],
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
        $query = Agencyprofile::find();

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
            'agency_profile_id' => $this->agency_profile_id,
            'agency_id' => $this->agency_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'contact', $this->contact]);

        return $dataProvider;
    }
}
