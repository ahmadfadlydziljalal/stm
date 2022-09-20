<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%session}}`.
 */
class m220907_035642_CreateSessionTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
        $this->createTable('{{%session}}', [
            'id' => $this->char(64)->notNull(),
            'expire' => $this->integer(11)->null()->defaultValue(null),
            'data' => $this->binary()->null()->defaultValue(null),
            'user_id' => $this->integer(11)->null()->defaultValue(null),
            'last_write' => $this->integer(11)->null()->defaultValue(null),
        ], $tableOptions);

        $this->addPrimaryKey('pk_on_session', '{{%session}}', ['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropPrimaryKey('pk_on_session', '{{%session}}');
        $this->dropTable('{{%session}}');
    }
}