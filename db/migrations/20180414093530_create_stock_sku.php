<?php


use Phinx\Migration\AbstractMigration;

class CreateStockSku extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    // zjh 创建商品sku库存表
    public function up()
    {
        $this->table('inv_stock_sku', array('collation' => 'utf8mb4_unicode_ci','comment'=>'商品sku库存表'))
        
            ->addColumn('stock_id', 'integer', array('limit' => 10,'default'=>0,'signed'=>false,'comment'=>'所属商品的库存id'))
            ->addColumn('color', 'string', array('limit' => 60,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'颜色'))
            ->addColumn('size', 'string', array('limit' => 60,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'尺码'))
            ->addColumn('stock_amount', 'integer', array('limit' => 10,'default'=>0,'signed'=>false,'comment'=>'库存数量')) 
            ->addColumn('add_time', 'integer', array('limit' => 10,'default'=>NULL,'null'=>true,'signed'=>false,'comment'=>'添加时间')) 
            ->addColumn('last_update', 'integer', array('limit' => 10,'default'=>NULL,'null'=>true,'signed'=>false,'comment'=>'最近更新时间')) 
            ->save();
    }
}
