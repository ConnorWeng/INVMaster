<?php


use Phinx\Migration\AbstractMigration;

class CreateStockSku extends AbstractMigration
{
    public function change()
    {
        $this->table('inv_stock_sku', ['comment' => '商品sku库存表'])
                ->addColumn('stock_id', 'integer', ['limit' => 10, 'default' => 0, 'signed' => false, 'comment' => '所属商品的库存id'])
                ->addColumn('color', 'string', ['limit' => 60, 'default' => '', 'comment' => '颜色'])
                ->addColumn('size', 'string', ['limit' => 60, 'default' => '', 'comment' => '尺码'])
                ->addColumn('stock_amount', 'integer', ['limit' => 10, 'default' => 0, 'signed' => false, 'comment' => '库存数量'])
                ->addColumn('add_time', 'integer', ['limit' => 10, 'default' => NULL, 'null' => true, 'signed' => false, 'comment' => '添加时间'])
                ->addColumn('last_update', 'integer', ['limit' => 10, 'default' => NULL, 'null' => true, 'signed' => false, 'comment' => '最近更新时间'])
                ->create();
    }
}
