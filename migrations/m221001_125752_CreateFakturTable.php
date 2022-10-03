<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%faktur}}`.
 */
class m221001_125752_CreateFakturTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{jenis_transaksi}}', [
            'id' => $this->primaryKey(),
            'nama' => $this->string()
        ]);

        $this->batchInsert('{{jenis_transaksi}}', ['nama'], [
            ['Cash'],
            ['Tempo'],
        ]);

        $this->createTable('{{%faktur}}', [
            'id' => $this->primaryKey(),
            'tanggal_faktur' => $this->date(),
            'nomor_faktur' => $this->string(),
            'nomor_purchase_order' => $this->string(),
            'jenis_transaksi_id' => $this->integer()->notNull()
        ]);

        $this->createIndex('idx_jenis_transaksi_id', 'faktur', 'jenis_transaksi_id');
        $this->addForeignKey('fk_jenis_transaksi_id', 'faktur', 'jenis_transaksi_id',
            'jenis_transaksi',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->createTable('{{faktur_detail}}', [
            'id' => $this->primaryKey(),

            'faktur_id' => $this->integer(),
            'barang_id' => $this->integer()->notNull(),
            'quantity' => $this->decimal(5, 2),
            'satuan_id' => $this->integer(),
            'harga_barang' => $this->decimal(10, 2),
        ]);

        $this->createIndex('idx_faktur_detail_id', 'faktur_detail', 'faktur_id');
        $this->addForeignKey('fk_faktur_detail_id', 'faktur_detail', 'faktur_id',
            'faktur',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex('idx_barang_faktur_detail_id', 'faktur_detail', 'barang_id');
        $this->addForeignKey('fk_barang_faktur_detail_id', 'faktur_detail', 'barang_id',
            'barang',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('{{faktur_detail}}');
        $this->dropTable('{{%faktur}}');
        $this->dropTable('{{jenis_transaksi}}');
    }
}