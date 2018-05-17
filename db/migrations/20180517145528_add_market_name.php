<?php


use Phinx\Migration\AbstractMigration;

class AddMarketName extends AbstractMigration
{
    public function change()
    {
        $this->table('inv_store')
                ->addColumn('market_name', 'string', ['limit' => 60, 'default' => '', 'comment' => '市场名称'])
                ->update();
    }
}
