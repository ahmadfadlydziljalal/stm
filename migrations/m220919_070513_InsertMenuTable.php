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
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (3, 'Menu', 32, '/admin/menu/index', null, 0x72657475726E5B276D6F64756C6527203D3E202761646D696E272C2027636F6E74726F6C6C657227203D3E20276D656E75272C202769636F6E27203D3E2027706C61792D636972636C65275D3B);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (4, 'Permission', 32, '/admin/permission/index', null, 0x72657475726E5B276D6F64756C6527203D3E202761646D696E272C2027636F6E74726F6C6C657227203D3E20277065726D697373696F6E272C202769636F6E27203D3E2027706C61792D636972636C65275D3B);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (5, 'Role', 32, '/admin/role/index', null, 0x72657475726E5B276D6F64756C6527203D3E202761646D696E272C2027636F6E74726F6C6C657227203D3E2027726F6C65272C202769636F6E27203D3E2027706C61792D636972636C65275D3B);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (6, 'Route', 32, '/admin/route/index', null, null);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (7, 'Rule', 32, '/admin/rule/index', null, null);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (8, 'User', 32, '/admin/user/index', null, 0x72657475726E5B276D6F64756C6527203D3E202761646D696E272C2027636F6E74726F6C6C657227203D3E202775736572272C202769636F6E27203D3E2027706C61792D636972636C65275D3B);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (9, 'Session', 32, '/session/index', null, 0x72657475726E5B27636F6E74726F6C6C657227203D3E202773657373696F6E272C202769636F6E27203D3E2027706C61792D636972636C65275D3B);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (11, 'Gii', 31, '/gii/default/index', null, 0x72657475726E5B27636F6E74726F6C6C657227203D3E2027676969272C202769636F6E27203D3E20276D61676963275D3B);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (12, 'Debug', 31, '/debug/default/index', null, 0x72657475726E5B27636F6E74726F6C6C657227203D3E20276465627567272C202769636F6E27203D3E2027627567275D3B);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (15, 'Top Menu', null, null, null, null);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (16, 'Left Menu', null, null, null, null);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (25, 'Kontak', 15, '/site/contact', null, null);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (26, 'Informasi Akun', 28, '/site/account-information', null, null);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (28, 'Right Menu', null, null, null, null);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (29, 'Tentang Web', 15, '/site/about', null, null);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (31, 'Develop', 16, null, 10, 0x72657475726E5B2769636F6E27203D3E202766696C652D636F6465275D3B);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (32, 'Trustee', 16, null, 30, 0x72657475726E5B2769636F6E27203D3E202766697265275D3B);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (33, 'Beranda', 16, '/site/index', 0, 0x72657475726E5B2769636F6E27203D3E2027686F757365275D3B);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (34, 'Settings', 16, '/settings/default/index', 20, 0x72657475726E5B276D6F64756C6527203D3E202773657474696E6773272C2027636F6E74726F6C6C657227203D3E202764656661756C74272C202769636F6E27203D3E202767656172275D3B);
INSERT INTO tms_starter.menu (id, name, parent, route, `order`, data) VALUES (35, 'Ganti Password', 28, '/site/change-password', null, null);
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