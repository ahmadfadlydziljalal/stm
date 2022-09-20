<?php

use yii\db\Migration;

/**
 * Class m220914_062930_InsertAuthItem
 */
class m220914_062930_InsertAuthItem extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->db->createCommand('SET FOREIGN_KEY_CHECKS = 0')->execute();
        $sql = <<<SQL
DELETE FROM `auth_item`;
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/*', 2, NULL, NULL, NULL, 1662276433, 1662276433),
	('/admin/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/assignment/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/assignment/assign', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/assignment/index', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/assignment/view', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/default/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/default/index', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/menu/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/menu/create', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/menu/delete', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/menu/index', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/menu/update', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/menu/view', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/permission/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/permission/assign', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/permission/create', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/permission/delete', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/permission/get-users', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/permission/index', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/permission/remove', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/permission/update', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/permission/view', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/role/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/role/assign', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/role/create', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/role/delete', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/role/get-users', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/role/index', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/role/remove', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/role/update', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/role/view', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/route/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/route/assign', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/route/create', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/route/index', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/route/refresh', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/route/remove', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/rule/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/rule/create', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/rule/delete', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/rule/index', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/rule/update', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/rule/view', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/user/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/user/activate', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/user/change-password', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/user/delete', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/user/index', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/user/login', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/user/logout', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/user/reset-password', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/user/signup', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/admin/user/view', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/dark-light-toggle/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/dark-light-toggle/index', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/debug/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/debug/default/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/debug/default/db-explain', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/debug/default/download-mail', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/debug/default/index', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/debug/default/toolbar', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/debug/default/view', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/debug/user/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/debug/user/reset-identity', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/debug/user/set-identity', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/gii/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/gii/default/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/gii/default/action', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/gii/default/diff', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/gii/default/index', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/gii/default/preview', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/gii/default/view', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/item/*', 2, NULL, NULL, NULL, 1662972733, 1662972733),
	('/item/create', 2, NULL, NULL, NULL, 1662972733, 1662972733),
	('/item/delete', 2, NULL, NULL, NULL, 1662972733, 1662972733),
	('/item/index', 2, NULL, NULL, NULL, 1662972733, 1662972733),
	('/item/update', 2, NULL, NULL, NULL, 1662972733, 1662972733),
	('/item/view', 2, NULL, NULL, NULL, 1662972733, 1662972733),
	('/session/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/session/create', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/session/delete', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/session/index', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/session/update', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/session/view', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/settings/*', 2, NULL, NULL, NULL, 1663658205, 1663658205),
	('/settings/default/*', 2, NULL, NULL, NULL, 1663658205, 1663658205),
	('/settings/default/create', 2, NULL, NULL, NULL, 1663658205, 1663658205),
	('/settings/default/delete', 2, NULL, NULL, NULL, 1663658205, 1663658205),
	('/settings/default/index', 2, NULL, NULL, NULL, 1663658205, 1663658205),
	('/settings/default/toggle', 2, NULL, NULL, NULL, 1663658205, 1663658205),
	('/settings/default/update', 2, NULL, NULL, NULL, 1663658205, 1663658205),
	('/settings/default/view', 2, NULL, NULL, NULL, 1663658205, 1663658205),
	('/site/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/site/about', 2, NULL, NULL, NULL, 1662937535, 1662937535),
	('/site/account-information', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/site/captcha', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/site/change-password', 2, NULL, NULL, NULL, 1663663060, 1663663060),
	('/site/contact', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/site/error', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/site/index', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/site/login', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/site/logout', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/user/*', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/user/create', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/user/create-with-sihrd-integration', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/user/update', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('/user/update-with-sihrd-integration', 2, NULL, NULL, NULL, 1662784979, 1662784979),
	('super-admin', 1, NULL, NULL, NULL, 1662277025, 1662549609),
	('user-default', 1, NULL, NULL, NULL, 1663663252, 1663663252);
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
        $this->db->createCommand('TRUNCATE auth_item')->execute();
        $this->db->createCommand('SET FOREIGN_KEY_CHECKS = 1')->execute();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220914_062930_InsertAuthItem cannot be reverted.\n";

        return false;
    }
    */
}