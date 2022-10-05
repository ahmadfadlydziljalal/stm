<?php

namespace app\models\search;

use app\models\Barang;
use app\models\BarangSatuan;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

/**
 * BarangSearch represents the model behind the search form about `app\models\Barang`.
 */
class BarangSearch extends Barang
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['nama', 'part_number'], 'safe'],
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
        $query = Barang::find()
            ->select([
                'id' => 'b.id',
                'nama' => 'b.nama',
                'part_number' => 'b.part_number',
                'satuanHarga' => new Expression('JSON_OBJECTAGG(satuan.nama, bs.harga )')
            ])
            ->alias('b')
            ->joinWith(['barangSatuans' => function ($model) {
                /** @var BarangSatuan $model */
                $model->alias('bs')
                    ->joinWith('satuan', false);
            }], false)
            ->groupBy('b.id');

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
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'part_number', $this->part_number]);

        return $dataProvider;
    }
}