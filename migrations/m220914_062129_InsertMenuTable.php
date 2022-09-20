<?php

use yii\db\Migration;

/**
 * Class m220914_062129_InsertMenuTable
 */
class m220914_062129_InsertMenuTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->db->createCommand('SET FOREIGN_KEY_CHECKS = 0')->execute();
        $sql = <<<SQL
INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`)
VALUES
	(3, 'Menu', 16, '/admin/menu/index', 10, X'72657475726E5B276D6F64756C6527203D3E202761646D696E272C2027636F6E74726F6C6C657227203D3E20276D656E75272C202769636F6E27203D3E2027706C61792D636972636C65275D3B'),
	(4, 'Permission', 16, '/admin/permission/index', 20, X'72657475726E5B276D6F64756C6527203D3E202761646D696E272C2027636F6E74726F6C6C657227203D3E20277065726D697373696F6E272C202769636F6E27203D3E2027706C61792D636972636C65275D3B'),
	(5, 'Role', 16, '/admin/role/index', 30, X'72657475726E5B276D6F64756C6527203D3E202761646D696E272C2027636F6E74726F6C6C657227203D3E2027726F6C65272C202769636F6E27203D3E2027706C61792D636972636C65275D3B'),
	(6, 'Route', 16, '/admin/route/index', 40, NULL),
	(7, 'Rule', 16, '/admin/rule/index', 50, NULL),
	(8, 'User', 16, '/admin/user/index', 70, X'72657475726E5B276D6F64756C6527203D3E202761646D696E272C2027636F6E74726F6C6C657227203D3E202775736572272C202769636F6E27203D3E2027706C61792D636972636C65275D3B'),
	(9, 'Session', 16, '/session/index', 60, X'72657475726E5B27636F6E74726F6C6C657227203D3E202773657373696F6E272C202769636F6E27203D3E2027706C61792D636972636C65275D3B'),
	(11, 'Gii', 16, '/gii/default/index', 81, X'72657475726E5B27636F6E74726F6C6C657227203D3E2027676969272C202769636F6E27203D3E20276D61676963275D3B'),
	(12, 'Debug', 16, '/debug/default/index', 100, X'72657475726E5B27636F6E74726F6C6C657227203D3E20276465627567272C202769636F6E27203D3E2027627567275D3B'),
	(15, 'Top Menu', NULL, NULL, NULL, NULL),
	(16, 'Left Menu', NULL, NULL, NULL, NULL),
	(17, 'Beranda', 16, '/site/index', 0, X'72657475726E5B2769636F6E27203D3E2027686F757365275D3B'),
	(20, '#App Settings', 16, '/site/index', 5, NULL),
	(22, '#Develop', 16, '/site/index', 80, NULL),
	(25, 'Kontak', 28, '/site/contact', NULL, NULL),
	(26, 'Informasi Akun', 28, '/site/account-information', NULL, NULL),
	(28, 'Right Menu', NULL, NULL, NULL, NULL),
	(29, 'Tentang Web', 28, '/site/about', NULL, NULL),
	(30, 'Item', 16, '/item/index', NULL, X'72657475726E5B27636F6E74726F6C6C657227203D3E20276974656D272C202769636F6E27203D3E2027706C61792D636972636C65275D3B');

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
        $this->db->createCommand('TRUNCATE menu')->execute();
        $this->db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220914_062129_InsertMenuTable cannot be reverted.\n";

        return false;
    }
    */
}