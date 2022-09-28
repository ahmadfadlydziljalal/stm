<?php

namespace app\models\search;

use app\models\Log;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class LogSearch extends Log
{

    public function rules()
    {
        return [
            [['_id'], 'safe'],
            [['level'], 'integer'],
            [['category', 'log_time', 'prefix', 'message'], 'safe']
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
        $query = Log::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
            'sort' => [
                'defaultOrder' => [
                    'log_time' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($get = Yii::$app->request->get('LogSearch')) {
            if ($get['_id']) {
                $query->andFilterWhere(['_id' => $this->_id]);
            }
            if ($get['level']) {
                $query->andFilterWhere(['level' => (int)$this->level]);
            }
        }

        return $dataProvider;
    }
}