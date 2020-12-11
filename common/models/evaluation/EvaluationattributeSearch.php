<?php

namespace common\models\evaluation;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\evaluation\Evaluationattribute;
use common\models\User;
use common\models\Profile;

/**
 * EvaluationattributeSearch represents the model behind the search form about `common\models\evaluation\Evaluationattribute`.
 */
class EvaluationattributeSearch extends Evaluationattribute
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['evaluation_attribute_id', 'business_unit_id', 'active'], 'integer'],
            [['attribute_name'], 'safe'],
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
        //$CurrentUser = User::findOne(['user_id'=> Yii::$app->user->identity->user_id]);
        $CurrentAgencyId = Profile::find()->where(['user_id' => Yii::$app->user->identity->user_id])->one();
        $id = $CurrentAgencyId->agency_id;
        $query = Evaluationattribute::find()->where(['agency_id' => $CurrentAgencyId]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 7,
            ],
            'sort' => [
                'defaultOrder' => [
                    'business_unit_id' => SORT_ASC,
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
            'evaluation_attribute_id' => $this->evaluation_attribute_id,
            'business_unit_id' => $this->business_unit_id,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'attribute_name', $this->attribute_name]);

        return $dataProvider;
    }
}
