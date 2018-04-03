<?php


use Phinx\Migration\AbstractMigration;

use Phinx\Db\Adapter\MysqlAdapter;  //zjh

class CreateStockLog extends AbstractMigration
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

    // zjh 创建出入库操作记录表
    public function up()
    {
        $this->table('inv_stock_log', array('collation' => 'utf8mb4_unicode_ci','comment'=>'出入库操作记录表'))

            ->addColumn('user_id', 'integer', array('limit' => 10,'default'=>0,'signed'=>false,'comment'=>'用户id'))

            ->addColumn('nick_name', 'string', array('limit' => 60,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'用户昵称'))

            ->addColumn('stock_id', 'integer', array('limit' => 10,'default'=>0,'signed'=>false,'comment'=>'商品库存id')) 

            ->addColumn('product_code', 'string', array('limit' => 60,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'货号'))

            ->addColumn('type', 'integer', array('limit' => MysqlAdapter::INT_TINY,'default'=>0,'signed'=>false,'comment'=>'操作类型：1 入库操作，2 出库操作')) 

            ->addColumn('number', 'integer', array('limit' => 10,'default'=>0,'signed'=>false,'comment'=>'出入库的数量')) 

            ->addColumn('add_time', 'integer', array('limit' => 10,'default'=>NULL,'null'=>true,'signed'=>false,'comment'=>'记录添加时间（操作时间）')) 

            ->addColumn('log', 'text', array('default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'额外的说明记录'))

            ->addColumn('amount_left', 'integer', array('limit' => 10,'default'=>0,'signed'=>false,'comment'=>'商品的库存剩余量')) 

            ->save();
    }

    // zjh 只作测试用，提交前屏蔽掉
    // public function down()
    // {
    //     // 删除表
    //     $this->dropTable('inv_stock_log');
    // }
}
