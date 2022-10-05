<?php

use yii\db\Migration;

/**
 * Class m220927_090110_CreateDatabaseTest
 */
class m010101_090110_CreateDatabaseTest extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if (YII_ENV_DEV) {
            $this->execute("CREATE DATABASE IF NOT EXISTS `" . getenv('MONGO_INITDB_DATABASE_TEST') . "`");
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        if (YII_ENV_DEV) {
            $this->execute("DROP DATABASE IF EXISTS `tms_starter_test`");
        }
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220927_090110_CreateDatabaseTest cannot be reverted.\n";

        return false;
    }
    */
}