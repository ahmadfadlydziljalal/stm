<?php

use yii\db\Migration;

/**
 * Class m220920_125500_InsertSettingTable
 */
class m220920_125500_InsertSettingTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = <<<SQL
DELETE FROM `settings`;
INSERT INTO `settings` (`id`, `type`, `section`, `key`, `value`, `active`, `created`, `modified`) VALUES
	(1, 'string', 'site', 'name', 'TMS Starter', 1, '2022-09-20 19:38:11', NULL),
	(2, 'string', 'site', 'description', 'Web App dengan Management User,  \r\nRole Based User Authenticatio, \r\nserta Module Settings. <br/> <br/>\r\n\r\nCukup sediakan sebuah komputer dengan <strong>Docker Engine</strong> terpasang dengan baik, \r\nmaka sistem ini bisa langsung dikembangkan sesuai dengan analisa dan peruntukan proses bisnis Anda.\r\n', 1, '2022-09-20 19:42:02', '2022-09-20 19:52:04'),
	(3, 'string', 'site', 'icon', '<i class="bi bi-airplane-engines"></i>', 1, '2022-09-20 19:43:22', '2022-09-20 19:44:11'),
	(4, 'string', 'site', 'maintainer', 'Fadly Dzil', 1, '2022-09-20 19:44:51', '2022-09-20 19:45:10'),
	(5, 'string', 'site', 'companyClient', 'Client Saya', 1, '2022-09-20 19:47:05', NULL),
	(6, 'string', 'site', 'maintainerCompany', 'Perusahaan Saya', 1, '2022-09-20 19:47:33', NULL);
SQL;
        $this->db->createCommand($sql)->execute();

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = <<<SQL
DELETE FROM `settings`;
SQL;
        $this->db->createCommand($sql)->execute();
    }

}