<?php

namespace app\models;

use app\models\base\Faktur as BaseFaktur;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "faktur".
 */
class Faktur extends BaseFaktur
{

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors,
                [
                    'class' => 'mdm\autonumber\Behavior',
                    'attribute' => 'nomor_faktur', // required
                    'value' => date('Y-m-d') . '.?', // format auto number. '?' will be replaced with generated number
                    'digit' => 4
                ],
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
}