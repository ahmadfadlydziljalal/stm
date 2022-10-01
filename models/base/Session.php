<?php

namespace app\models\base;

use MongoDB\BSON\ObjectID;
use yii\mongodb\ActiveRecord;

/**
 * This is the model class for collection "session".
 *
 * @property ObjectID|string $_id
 * @property mixed $id
 * @property mixed $expire
 * @property mixed $data
 * @property mixed $user_id
 * @property mixed $last_write
 * @property string $thd_id [bigint unsigned]
 * @property string $conn_id [bigint unsigned]
 * @property string $user [varchar(288)]
 * @property string $db [varchar(64)]
 * @property string $command [varchar(16)]
 * @property string $state [varchar(64)]
 * @property int $time [bigint]
 * @property string $current_statement
 * @property string $statement_latency [varchar(11)]
 * @property string $progress [decimal(26,2)]
 * @property string $lock_latency [varchar(11)]
 * @property string $rows_examined [bigint unsigned]
 * @property string $rows_sent [bigint unsigned]
 * @property string $rows_affected [bigint unsigned]
 * @property string $tmp_tables [bigint unsigned]
 * @property string $tmp_disk_tables [bigint unsigned]
 * @property string $full_scan [varchar(3)]
 * @property string $last_statement
 * @property string $last_statement_latency [varchar(11)]
 * @property string $current_memory [varchar(11)]
 * @property string $last_wait [varchar(128)]
 * @property string $last_wait_latency [varchar(13)]
 * @property string $source [varchar(64)]
 * @property string $trx_latency [varchar(11)]
 * @property string $trx_state [enum('ACTIVE', 'COMMITTED', 'ROLLED BACK')]
 * @property string $trx_autocommit [enum('YES', 'NO')]
 * @property string $pid [varchar(1024)]
 * @property string $program_name [varchar(1024)]
 */
abstract class Session extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return ['tms_starter', 'session'];
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
            'user_id',
            'last_write',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'expire', 'data', 'user_id', 'last_write'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            '_id' => 'ID',
            'id' => 'Id',
            'expire' => 'Expire',
            'data' => 'Data',
            'user_id' => 'User ID',
            'last_write' => 'Last Write',
        ];
    }

    
}