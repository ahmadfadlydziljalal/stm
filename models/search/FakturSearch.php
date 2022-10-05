<?php

namespace app\models\search;

use app\models\Faktur;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FakturSearch represents the model behind the search form about `app\models\Faktur`.
 */
class FakturSearch extends Faktur
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['id', 'jenis_transaksi_id', 'card_id'], 'integer'],
            [['tanggal_faktur', 'nomor_faktur', 'nomor_purchase_order'], 'safe'],
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
        $query = Faktur::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'card_id' => $this->card_id,
            'tanggal_faktur' => $this->tanggal_faktur,
            'jenis_transaksi_id' => $this->jenis_transaksi_id,
        ]);

        $query->andFilterWhere(['like', 'nomor_faktur', $this->nomor_faktur])
            ->andFilterWhere(['like', 'nomor_purchase_order', $this->nomor_purchase_order]);

        return $dataProvider;
    }
}