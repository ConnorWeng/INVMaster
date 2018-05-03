<?php


use Phinx\Migration\AbstractMigration;

class UpdateStockLog extends AbstractMigration
{
    public function change()
    {
        $this->table('inv_stock_log')
                ->addColumn('color', 'string', ['limit' => 60, 'default' => '', 'comment' => '颜色', 'after' => 'product_code'])
                ->addColumn('size', 'string', ['limit' => 60, 'default' => '', 'comment' => '尺码', 'after' => 'color'])
                ->update();
    }
}
