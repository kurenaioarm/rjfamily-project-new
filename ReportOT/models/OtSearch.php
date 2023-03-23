<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ot;

/**
 * OtSearch represents the model behind the search form of `app\models\Ot`.
 */


class OtSearch extends Ot
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'd1', 'd2', 'd3', 'd4', 'd5', 'd6', 'd7', 'd8', 'd9', 'd10', 'd11', 'd12', 'd13', 'd14', 'd15', 'd16', 'd17', 'd18', 'd19', 'd20', 'd21', 'd22', 'd23', 'd24', 'd25', 'd26', 'd27', 'd28', 'd29', 'd30', 'd31', 'etc', 'add_timestamp', 'status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Ot::find();

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
            'id' => $this->id,
            'add_timestamp' => $this->add_timestamp,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'd1', $this->d1])
            ->andFilterWhere(['like', 'd2', $this->d2])
            ->andFilterWhere(['like', 'd3', $this->d3])
            ->andFilterWhere(['like', 'd4', $this->d4])
            ->andFilterWhere(['like', 'd5', $this->d5])
            ->andFilterWhere(['like', 'd6', $this->d6])
            ->andFilterWhere(['like', 'd7', $this->d7])
            ->andFilterWhere(['like', 'd8', $this->d8])
            ->andFilterWhere(['like', 'd9', $this->d9])
            ->andFilterWhere(['like', 'd10', $this->d10])
            ->andFilterWhere(['like', 'd11', $this->d11])
            ->andFilterWhere(['like', 'd12', $this->d12])
            ->andFilterWhere(['like', 'd13', $this->d13])
            ->andFilterWhere(['like', 'd14', $this->d14])
            ->andFilterWhere(['like', 'd15', $this->d15])
            ->andFilterWhere(['like', 'd16', $this->d16])
            ->andFilterWhere(['like', 'd17', $this->d17])
            ->andFilterWhere(['like', 'd18', $this->d18])
            ->andFilterWhere(['like', 'd19', $this->d19])
            ->andFilterWhere(['like', 'd20', $this->d20])
            ->andFilterWhere(['like', 'd21', $this->d21])
            ->andFilterWhere(['like', 'd22', $this->d22])
            ->andFilterWhere(['like', 'd23', $this->d23])
            ->andFilterWhere(['like', 'd24', $this->d24])
            ->andFilterWhere(['like', 'd25', $this->d25])
            ->andFilterWhere(['like', 'd26', $this->d26])
            ->andFilterWhere(['like', 'd27', $this->d27])
            ->andFilterWhere(['like', 'd28', $this->d28])
            ->andFilterWhere(['like', 'd29', $this->d29])
            ->andFilterWhere(['like', 'd30', $this->d30])
            ->andFilterWhere(['like', 'd31', $this->d31])
            ->andFilterWhere(['like', 'etc', $this->etc])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
