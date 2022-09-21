<?php

namespace app\models;

use Yii;
use \app\models\base\ItemDetailDetail as BaseItemDetailDetail;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "item_detail_detail".
 */
class ItemDetailDetail extends BaseItemDetailDetail
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
