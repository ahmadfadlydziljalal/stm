<?php

namespace app\models\active_queries;

/**
 * This is the ActiveQuery class for [[\app\models\Faktur]].
 *
 * @see \app\models\Faktur
 */
class FakturQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Faktur[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Faktur|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
