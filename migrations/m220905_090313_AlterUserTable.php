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
        $this->insert('user',[
            'id' => 423,
            'username' => '3698-PS-22071989',
            'auth_key' => 'qYBrnBPIuAbjJs_0kp50MG8psDpVOo2k',
            'password_hash' => '$2y$13$QTsv8sZFqeNBcS.fHyMT7.ruuYG8HHP0jTPNXi436XEBvaVhAxh3G',
            'password_reset_token' => NULL,
            'email' => 'dzil@tresnamuda.co.id',
            'status' => 10,
            'created_at' => '1625132789',
            'updated_at' => '1660821791',
            'karyawan_id' => 209
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user', 'id=423');
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