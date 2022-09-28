<?php

namespace app\models;

use MongoDB\BSON\ObjectID;
use yii\mongodb\ActiveRecord;

/**
 * This is the model class for collection "cache".
 *
 * @property ObjectID|string $_id
 * @property mixed $id
 * @property mixed $expire
 * @property mixed $data
 */
class Cache extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return ['tms_starter', 'cache'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes(): array
    {
        return [
            '_id',
            'id',
            'expire',
            'data',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'expire', 'data'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            '_id' => '_id',
            'id' => 'id',
            'expire' => 'Expire',
            'data' => 'Data',
        ];
    }
}