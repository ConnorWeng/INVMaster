<?php


use Phinx\Migration\AbstractMigration;

class CreateStock extends AbstractMigration
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

    // zjh 删掉 change函数，用up函数代替
    // public function change()
    // {

    // }

    // zjh 创建商品库存表
    public function up()
    {
        $this->table('inv_stock', array('id'=>'stock_id','comment'=>'商品库存表'))

            ->addColumn('product_id', 'integer', array('limit' => 10,'default'=>0,'signed'=>false,'comment'=>'商品id'))
            ->addColumn('store_id', 'integer', array('limit' => 10,'default'=>0,'signed'=>false,'comment'=>'店铺id'))
            ->addColumn('thumbnail', 'string', array('default'=>'','comment'=>'商品缩略图'))
            ->addColumn('product_code', 'string', array('limit' => 60,'default'=>'','comment'=>'货号'))
            ->addColumn('color', 'string', array('limit' => 60,'default'=>'','comment'=>'颜色'))
            ->addColumn('size', 'string', array('limit' => 60,'default'=>'','comment'=>'尺码'))
            ->addColumn('stock_amount', 'integer', array('limit' => 10,'default'=>0,'signed'=>false,'comment'=>'库存数量'))
            ->addColumn('add_time', 'integer', array('limit' => 10,'default'=>NULL,'null'=>true,'signed'=>false,'comment'=>'添加时间'))
            ->addColumn('last_update', 'integer', array('limit' => 10,'default'=>NULL,'null'=>true,'signed'=>false,'comment'=>'最近更新时间'))
            ->save();
    }

    // zjh 只作测试用，提交前屏蔽掉
    // public function down()
    // {
    //     // 删除表
    //     $this->dropTable('inv_stock');
    // }
}
