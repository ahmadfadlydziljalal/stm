<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%item}}`.
 */
class m220920_060821_DropItemTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->dropForeignKey('fk_detail', '{{item_detail}}');
        $this->dropForeignKey('fk_detail_detail', '{{item_detail_detail}}');
        
        $this->dropIndex('idx_detail', '{{item_detail}}');
        $this->dropIndex('idx_detail_detail', '{{item_detail_detail}}');

        $this->dropTable('{{%item_detail_detail}}');
        $this->dropTable('{{%item_detail}}');
        $this->dropTable('{{%item}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%item}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);

        $this->createTable('{{%item_detail}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'dropdown_item' => $this->string(),
        ]);

        $this->createTable('{{%item_detail_detail}}', [
            'id' => $this->primaryKey(),
            'item_detail_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'dropdown_item' => $this->string(),
        ]);


        $this->createIndex('idx_detail', '{{item_detail}}', 'item_id');
        $this->createIndex('idx_detail_detail', '{{item_detail_detail}}', 'item_detail_id');

        $this->addForeignKey('fk_detail', '{{item_detail}}', 'item_id', '{{item}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_detail_detail', '{{item_detail_detail}}', 'item_detail_id', '{{item_detail}}', 'ID', 'CASCADE', 'CASCADE');
    }
}