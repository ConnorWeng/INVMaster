<?php


use Phinx\Migration\AbstractMigration;

class AddIndex extends AbstractMigration
{
    public function change()
    {
        $this->table('wx_session_info')
                ->addIndex('skey')
                ->update();

        $this->table('inv_user')
                ->addIndex('open_id')
                ->update();

        $this->table('inv_user_store_relate')
                ->addIndex('user_id')
                ->addIndex('store_id')
                ->update();

        $this->table('inv_stock')
                ->addIndex('store_id')
                ->update();
    }
}
