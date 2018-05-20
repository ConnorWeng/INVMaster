<?php


use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateProduct extends AbstractMigration
{
    public function change()
    {
        $this->table('inv_product', ['id' => false, 'primary_key' => ['product_id'], 'comment' => '商品表'])
                ->addColumn('product_id', 'biginteger', ['identity' => true, 'limit' => 20, 'signed' => false, 'comment' => '商品id'])
                ->addColumn('store_id', 'integer', ['limit' => 10, 'signed' => false, 'comment' => '店铺id'])
                ->addColumn('product_code', 'string', ['limit' => 60, 'comment' => '货号'])
                ->addColumn('product_name', 'string', ['limit' => 255, 'default' => '', 'comment' => '商品名称'])
                ->addColumn('thumbnail', 'string', ['default' => '', 'comment' => '商品缩略图url'])
                ->addColumn('price', 'decimal', ['null' => true, 'precision' => 10, 'scale' => 2])
                ->addColumn('vendor', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 0, 'signed' => false, 'comment' => '商品信息来源：0 默认添加，1 淘宝同步'])
                ->addColumn('add_time', 'integer', ['limit' => 10, 'default' => NULL, 'signed' => false, 'comment' => '添加时间'])
                ->addColumn('last_update', 'integer', ['limit' => 10, 'default' => NULL, 'signed' => false, 'comment' => '最近更新时间'])
                ->addIndex('store_id')
                ->addIndex('product_code')
                ->addIndex('vendor')
                ->create();

        $this->table('inv_stock')
                ->removeColumn('product_code')
                ->removeColumn('thumbnail')
                ->removeColumn('sku_content')
                ->update();
    }
}
