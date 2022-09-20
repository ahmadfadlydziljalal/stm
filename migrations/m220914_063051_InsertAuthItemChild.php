<?php

use yii\db\Migration;

/**
 * Class m220914_063051_InsertAuthItemChild
 */
class m220914_063051_InsertAuthItemChild extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->db->createCommand('SET FOREIGN_KEY_CHECKS = 0')->execute();
        $sql = <<<SQL
INSERT INTO `auth_item_child` (`parent`, `child`)
VALUES
	('super-admin', '/*'),
	('super-admin', '/admin/*'),
	('super-admin', '/admin/assignment/*'),
	('super-admin', '/admin/assignment/assign'),
	('super-admin', '/admin/assignment/index'),
	('super-admin', '/admin/assignment/revoke'),
	('super-admin', '/admin/assignment/view'),
	('super-admin', '/admin/default/*'),
	('super-admin', '/admin/default/index'),
	('super-admin', '/admin/menu/*'),
	('super-admin', '/admin/menu/create'),
	('super-admin', '/admin/menu/delete'),
	('super-admin', '/admin/menu/index'),
	('super-admin', '/admin/menu/update'),
	('super-admin', '/admin/menu/view'),
	('super-admin', '/admin/permission/*'),
	('super-admin', '/admin/permission/assign'),
	('super-admin', '/admin/permission/create'),
	('super-admin', '/admin/permission/delete'),
	('super-admin', '/admin/permission/get-users'),
	('super-admin', '/admin/permission/index'),
	('super-admin', '/admin/permission/remove'),
	('super-admin', '/admin/permission/update'),
	('super-admin', '/admin/permission/view'),
	('super-admin', '/admin/role/*'),
	('super-admin', '/admin/role/assign'),
	('super-admin', '/admin/role/create'),
	('super-admin', '/admin/role/delete'),
	('super-admin', '/admin/role/get-users'),
	('super-admin', '/admin/role/index'),
	('super-admin', '/admin/role/remove'),
	('super-admin', '/admin/role/update'),
	('super-admin', '/admin/role/view'),
	('super-admin', '/admin/route/*'),
	('super-admin', '/admin/route/assign'),
	('super-admin', '/admin/route/create'),
	('super-admin', '/admin/route/index'),
	('super-admin', '/admin/route/refresh'),
	('super-admin', '/admin/route/remove'),
	('super-admin', '/admin/rule/*'),
	('super-admin', '/admin/rule/create'),
	('super-admin', '/admin/rule/delete'),
	('super-admin', '/admin/rule/index'),
	('super-admin', '/admin/rule/update'),
	('super-admin', '/admin/rule/view'),
	('super-admin', '/admin/user/*'),
	('super-admin', '/admin/user/activate'),
	('super-admin', '/admin/user/change-password'),
	('super-admin', '/admin/user/delete'),
	('super-admin', '/admin/user/index'),
	('super-admin', '/admin/user/login'),
	('super-admin', '/admin/user/logout'),
	('super-admin', '/admin/user/request-password-reset'),
	('super-admin', '/admin/user/reset-password'),
	('super-admin', '/admin/user/signup'),
	('super-admin', '/admin/user/view'),
	('super-admin', '/dark-light-toggle/*'),
	('super-admin', '/dark-light-toggle/index'),
	('super-admin', '/debug/*'),
	('super-admin', '/debug/default/*'),
	('super-admin', '/debug/default/db-explain'),
	('super-admin', '/debug/default/download-mail'),
	('super-admin', '/debug/default/index'),
	('super-admin', '/debug/default/toolbar'),
	('super-admin', '/debug/default/view'),
	('super-admin', '/debug/user/*'),
	('super-admin', '/debug/user/reset-identity'),
	('super-admin', '/debug/user/set-identity'),
	('super-admin', '/gii/*'),
	('super-admin', '/gii/default/*'),
	('super-admin', '/gii/default/action'),
	('super-admin', '/gii/default/diff'),
	('super-admin', '/gii/default/index'),
	('super-admin', '/gii/default/preview'),
	('super-admin', '/gii/default/view'),
	('super-admin', '/item/*'),
	('super-admin', '/item/create'),
	('super-admin', '/item/delete'),
	('super-admin', '/item/index'),
	('super-admin', '/item/update'),
	('super-admin', '/item/view'),
	('super-admin', '/session/*'),
	('super-admin', '/session/create'),
	('super-admin', '/session/delete'),
	('super-admin', '/session/index'),
	('super-admin', '/session/update'),
	('super-admin', '/session/view'),
	('super-admin', '/site/*'),
	('super-admin', '/site/about'),
	('super-admin', '/site/account-information'),
	('super-admin', '/site/captcha'),
	('super-admin', '/site/contact'),
	('super-admin', '/site/error'),
	('super-admin', '/site/index'),
	('super-admin', '/site/login'),
	('super-admin', '/site/logout'),
	('super-admin', '/user/*'),
	('super-admin', '/user/create'),
	('super-admin', '/user/create-with-sihrd-integration'),
	('super-admin', '/user/update'),
	('super-admin', '/user/update-with-sihrd-integration');

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
        $this->db->createCommand('TRUNCATE auth_item_child')->execute();
        $this->db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220914_063051_InsertAuthItemChild cannot be reverted.\n";

        return false;
    }
    */
}