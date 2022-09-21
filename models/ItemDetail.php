<?php

namespace app\models;

use Yii;
use \app\models\base\ItemDetail as BaseItemDetail;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "item_detail".
 */
class ItemDetail extends BaseItemDetail
{

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
            ]
        );
    }
}
