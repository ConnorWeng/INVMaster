<?php


use Phinx\Migration\AbstractMigration;

class CreateStock extends AbstractMigration
{
    public function change()
    {
        $this->table('inv_stock', ['id' => 'stock_id', 'comment' => '商品库存表'])
                ->addColumn('product_id', 'integer', ['limit' => 10, 'default' => 0, 'signed' => false, 'comment' => '商品id'])
                ->addColumn('store_id', 'integer', ['limit' => 10, 'default' => 0, 'signed' => false, 'comment' => '店铺id'])
                ->addColumn('thumbnail', 'string', ['default' => '', 'comment' => '商品缩略图'])
                ->addColumn('product_code', 'string', ['limit' => 60, 'default' => '', 'comment' => '货号'])
                ->addColumn('color', 'string', ['limit' => 60, 'default' => '', 'comment' => '颜色'])
                ->addColumn('size', 'string', ['limit' => 60, 'default' => '', 'comment' => '尺码'])
                ->addColumn('stock_amount', 'integer', ['limit' => 10, 'default' => 0, 'signed' => false, 'comment' => '库存数量'])
                ->addColumn('add_time', 'integer', ['limit' => 10, 'default' => NULL, 'null' => true, 'signed' => false, 'comment' => '添加时间'])
                ->addColumn('last_update', 'integer', ['limit' => 10, 'default' => NULL, 'null' => true, 'signed' => false, 'comment' => '最近更新时间'])
                ->create();
    }
}
