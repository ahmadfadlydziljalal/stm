<?php

namespace app\models\search;

use app\models\Cache;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CacheSearch represents the model behind the search form about `app\models\Cache`.
 */
class CacheSearch extends Cache
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['_id', 'id', 'data'], 'safe'],
            [['expire'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios(): array
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Cache::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
            'sort' => [
                'defaultOrder' => [
                    'expire' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query
            ->andFilterWhere(['expire' => $this->expire])
            ->andFilterWhere(['_id' => $this->_id]);

        /*$query
            ->andFilterCompare('id', $this->id, '=')
            ->andFilterCompare('data', $this->data, '=');*/

        return $dataProvider;
    }
}