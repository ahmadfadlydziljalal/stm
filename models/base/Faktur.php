<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "faktur".
 *
 * @property integer $id
 * @property integer $card_id
 * @property string $nomor_faktur
 * @property string $tanggal_faktur
 * @property string $nomor_purchase_order
 * @property integer $jenis_transaksi_id
 *
 * @property \app\models\Card $card
 * @property \app\models\FakturDetail[] $fakturDetails
 * @property \app\models\JenisTransaksi $jenisTransaksi
 * @property string $aliasModel
 */
abstract class Faktur extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faktur';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['card_id', 'tanggal_faktur', 'jenis_transaksi_id'], 'required'],
            [['card_id', 'jenis_transaksi_id'], 'integer'],
            [['tanggal_faktur'], 'safe'],
            [['nomor_faktur', 'nomor_purchase_order'], 'string', 'max' => 255],
            [['card_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Card::class, 'targetAttribute' => ['card_id' => 'id']],
            [['jenis_transaksi_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\JenisTransaksi::class, 'targetAttribute' => ['jenis_transaksi_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'card_id' => 'Card ID',
            'nomor_faktur' => 'Nomor Faktur',
            'tanggal_faktur' => 'Tanggal Faktur',
            'nomor_purchase_order' => 'Nomor Purchase Order',
            'jenis_transaksi_id' => 'Jenis Transaksi ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCard()
    {
        return $this->hasOne(\app\models\Card::class, ['id' => 'card_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFakturDetails()
    {
        return $this->hasMany(\app\models\FakturDetail::class, ['faktur_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisTransaksi()
    {
        return $this->hasOne(\app\models\JenisTransaksi::class, ['id' => 'jenis_transaksi_id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\active_queries\FakturQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\active_queries\FakturQuery(get_called_class());
    }


}
