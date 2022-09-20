<?php

use yii\db\Migration;

/**
 * Class m220919_070513_InsertMenuTable
 */
class m220919_070513_InsertMenuTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->db->createCommand('SET FOREIGN_KEY_CHECKS = 0')->execute();

        $this->db->createCommand("TRUNCATE menu;")->execute();

        $sql = <<<SQL
DELETE FROM `menu`;
INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES
	(3, 'Menu', 32, '/admin/menu/index', 0, _binary 0x72657475726e5b276d6f64756c6527203d3e202761646d696e272c2027636f6e74726f6c6c657227203d3e20276d656e75272c202769636f6e27203d3e2027706c61792d636972636c65275d3b),
	(4, 'Permission', 32, '/admin/permission/index', NULL, _binary 0x72657475726e5b276d6f64756c6527203d3e202761646d696e272c2027636f6e74726f6c6c657227203d3e20277065726d697373696f6e272c202769636f6e27203d3e2027706c61792d636972636c65275d3b),
	(5, 'Role', 32, '/admin/role/index', NULL, _binary 0x72657475726e5b276d6f64756c6527203d3e202761646d696e272c2027636f6e74726f6c6c657227203d3e2027726f6c65272c202769636f6e27203d3e2027706c61792d636972636c65275d3b),
	(6, 'Route', 32, '/admin/route/index', NULL, NULL),
	(7, 'Rule', 32, '/admin/rule/index', NULL, NULL),
	(8, 'User', 32, '/admin/user/index', NULL, _binary 0x72657475726e5b276d6f64756c6527203d3e202761646d696e272c2027636f6e74726f6c6c657227203d3e202775736572272c202769636f6e27203d3e2027706c61792d636972636c65275d3b),
	(9, 'Session', 32, '/session/index', NULL, _binary 0x72657475726e5b27636f6e74726f6c6c657227203d3e202773657373696f6e272c202769636f6e27203d3e2027706c61792d636972636c65275d3b),
	(11, 'Gii', 31, '/gii/default/index', NULL, _binary 0x72657475726e5b27636f6e74726f6c6c657227203d3e2027676969272c202769636f6e27203d3e20276d61676963275d3b),
	(12, 'Debug', 31, '/debug/default/index', NULL, _binary 0x72657475726e5b27636f6e74726f6c6c657227203d3e20276465627567272c202769636f6e27203d3e2027627567275d3b),
	(15, 'Top Menu', NULL, NULL, NULL, NULL),
	(16, 'Left Menu', NULL, NULL, NULL, NULL),
	(25, 'Kontak', 15, '/site/contact', NULL, NULL),
	(26, 'Informasi Akun', 28, '/site/account-information', NULL, NULL),
	(28, 'Right Menu', NULL, NULL, NULL, NULL),
	(29, 'Tentang Web', 15, '/site/about', NULL, NULL),
	(31, 'Develop', 16, NULL, 1, NULL),
	(32, 'Trustee', 16, NULL, 2, NULL),
	(33, 'Beranda', 16, '/site/index', NULL, NULL);
SQL;
        $this->db->createCommand($sql)->execute();

        $this->db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->db->createCommand('SET FOREIGN_KEY_CHECKS = 0')->execute();
        $this->db->createCommand("TRUNCATE menu;")->execute();
        $this->db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220919_070513_InsertMenuTable cannot be reverted.\n";

        return false;
    }
    */
}