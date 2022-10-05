<?php

namespace app\models;

use app\models\base\Card as BaseCard;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "card".
 */
class Card extends BaseCard
{

    const SCENARIO_CREATE_AND_UPDATE = 'create-and-update';

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
}