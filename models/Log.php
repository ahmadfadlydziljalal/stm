<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "log".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $level
 * @property mixed $category
 * @property mixed $log_time
 * @property mixed $prefix
 * @property mixed $message
 */
class Log extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return ['tms_starter', 'log'];
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
