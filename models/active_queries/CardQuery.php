<?php

namespace app\models\active_queries;

use app\components\helpers\ArrayHelper;
use app\models\Card;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\app\models\Card]].
 *
 * @see \app\models\Card
 */
class CardQuery extends ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Card|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function map()
    {
        return ArrayHelper::map(parent::select('id, nama')->all(), 'id', 'nama');
    }

    /**
     * @inheritdoc
     * @return Card[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }
}