<?php


use Phinx\Migration\AbstractMigration;

class ChangeColumnsStockLog extends AbstractMigration
{
    public function change()
    {
        $this->table('inv_stock_log')
                ->changeColumn('id', 'biginteger', ['identity' => true, 'limit' => 20, 'signed' => false, 'comment' => '商品id'])
                ->addColumn('store_id', 'integer', ['limit' => 10, 'signed' => false, 'comment' => '店铺id', 'after' => 'stock_id'])
                ->update();
    }
}
