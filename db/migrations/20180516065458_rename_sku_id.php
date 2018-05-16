<?php


use Phinx\Migration\AbstractMigration;

class RenameSkuId extends AbstractMigration
{
    public function change()
    {
        $this->table('inv_stock_sku')
                ->renameColumn('id', 'sku_id')
                ->update();
    }
}
