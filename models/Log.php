<?php

namespace app\models;

use MongoDB\BSON\ObjectID;
use yii\mongodb\ActiveRecord;

/**
 * This is the model class for collection "log".
 *
 * @property ObjectID|string $_id
 * @property mixed $level
 * @property mixed $category
 * @property mixed $log_time
 * @property mixed $prefix
 * @property mixed $message
 */
class Log extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return ['stm', 'log'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'level',
            'category',
            'log_time',
            'prefix',
            'message',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level', 'category', 'log_time', 'prefix', 'message'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'level' => 'Level',
            'category' => 'Category',
            'log_time' => 'Log Time',
            'prefix' => 'Prefix',
            'message' => 'Message',
        ];
    }
}