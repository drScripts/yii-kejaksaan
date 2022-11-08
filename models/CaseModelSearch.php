<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CaseModel;

/**
 * CaseModelSearch represents the model behind the search form of `app\models\CaseModel`.
 */
class CaseModelSearch extends CaseModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'satKerId', 'locationId', 'caseTypeId', 'caseStageId'], 'integer'],
            [['name', 'spdpNumber', 'spdpDate', 'document'], 'safe'],
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
        $query = CaseModel::find();

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
            'satKerId' => $this->satKerId,
            'locationId' => $this->locationId,
            'spdpDate' => $this->spdpDate,
            'caseTypeId' => $this->caseTypeId,
            'caseStageId' => $this->caseStageId,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'spdpNumber', $this->spdpNumber])
            ->andFilterWhere(['ilike', 'document', $this->document]);

        return $dataProvider;
    }
}
