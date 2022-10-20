<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the base-model class for table "rekening_detail".
 *
 * @property integer $id
 * @property integer $rekening_id
 * @property string $bank
 * @property string $nomor_rekening
 *
 * @property \app\models\Rekening $rekening
 * @property string $aliasModel
 */
abstract class RekeningDetail extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rekening_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['rekening_id'], 'integer'],
            [['bank', 'nomor_rekening'], 'required'],
            [['bank', 'nomor_rekening'], 'string', 'max' => 255],
            [['rekening_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Rekening::class, 'targetAttribute' => ['rekening_id' => 'id']]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rekening_id' => 'Rekening ID',
            'bank' => 'Bank',
            'nomor_rekening' => 'Nomor Rekening',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRekening()
    {
        return $this->hasOne(\app\models\Rekening::class, ['id' => 'rekening_id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\active_queries\RekeningDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\active_queries\RekeningDetailQuery(get_called_class());
    }


}