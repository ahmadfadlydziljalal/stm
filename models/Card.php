<?php

namespace app\models;

use app\models\base\Card as BaseCard;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "card".
 */
class Card extends BaseCard
{

    const SCENARIO_CREATE_AND_UPDATE = 'create-and-update';
    const GET_ALL = 'all';
    const GET_ONLY_TOKO_SAYA = 'only-toko-saya';
    const GET_APART_FROM_TOKO_SAYA = 'selain-toko-saya';

    public ?array $cardBelongsTypesForm = [];
    public ?string $cardTypeName = null;

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
                ['cardTypeName', 'safe'],
                ['cardBelongsTypesForm', 'each', 'rule' => ['integer']],
                [['cardBelongsTypesForm'], 'required', 'on' => self::SCENARIO_CREATE_AND_UPDATE],
            ]
        );
    }

    public function getSingkatanNama(): string
    {
        return StringHelper::truncate($this->nama, 18);
    }
}