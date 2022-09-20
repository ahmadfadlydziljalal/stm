<?php

use yii\db\Migration;

/**
 * Class m220905_090313_AlterUserTable
 */
class m220905_090313_AlterUserTable extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'karyawan_id', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'karyawan_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220905_090313_AlterUserTable cannot be reverted.\n";

        return false;
    }
    */
}