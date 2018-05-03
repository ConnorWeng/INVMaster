<?php


use Phinx\Migration\AbstractMigration;

class CreateUserStoreRelate extends AbstractMigration
{
    public function change()
    {
        $this->table('inv_user_store_relate', ['comment' => '用户档口关联表'])
                ->addColumn('user_id', 'integer', ['limit' => 10, 'default' => 0, 'signed' => false, 'comment' => '用户id'])
                ->addColumn('store_id', 'integer', ['limit' => 10, 'default' => 0, 'signed' => false, 'comment' => '店铺id'])
                ->create();
    }
}
