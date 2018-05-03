<?php


use Phinx\Migration\AbstractMigration;

class UpdateStock extends AbstractMigration
{
    public function change()
    {
        $this->table('inv_stock')
                ->removeColumn('color')
                ->removeColumn('size')
                ->addColumn('sku_content', 'text', ['comment' => '商品的sku相关信息', 'after' => 'product_code'])
                ->update();
    }
}
