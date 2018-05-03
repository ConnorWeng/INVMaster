<?php


use Phinx\Migration\AbstractMigration;

use Phinx\Db\Adapter\MysqlAdapter;

class CreateStockLog extends AbstractMigration
{
    public function change()
    {
        $this->table('inv_stock_log', ['comment' => '出入库操作记录表'])
                ->addColumn('user_id', 'integer', ['limit' => 10, 'default' => 0, 'signed' => false, 'comment' => '用户id'])
                ->addColumn('nick_name', 'string', ['limit' => 60, 'default' => '', 'comment' => '用户昵称'])
                ->addColumn('stock_id', 'integer', ['limit' => 10, 'default' => 0, 'signed' => false, 'comment' => '商品库存id'])
                ->addColumn('product_code', 'string', ['limit' => 60, 'default' => '', 'comment' => '货号'])
                ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 0, 'signed' => false, 'comment' => '操作类型：1 入库操作，2 出库操作'])
                ->addColumn('number', 'integer', ['limit' => 10, 'default' => 0, 'signed' => false, 'comment' => '出入库的数量'])
                ->addColumn('add_time', 'integer', ['limit' => 10, 'default' => NULL, 'null' => true, 'signed' => false, 'comment' => '记录添加时间（操作时间）'])
                ->addColumn('log', 'text', ['comment' => '额外的说明记录'])
                ->addColumn('amount_left', 'integer', ['limit' => 10, 'default' => 0, 'signed' => false, 'comment' => '商品的库存剩余量'])
                ->create();
    }
}
