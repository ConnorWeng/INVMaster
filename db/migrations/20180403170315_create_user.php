<?php


use Phinx\Migration\AbstractMigration;

use Phinx\Db\Adapter\MysqlAdapter;

class CreateUser extends AbstractMigration
{
    public function change()
    {
        $this->table('inv_user', ['id' => 'user_id', 'comment' => '用户表'])
                ->addColumn('open_id', 'integer', ['limit' => 10, 'default' => 0, 'signed' => false, 'comment' => '微信用户id'])
                ->addColumn('nick_name', 'string', ['limit' => 60, 'default' => '', 'comment' => '昵称'])
                ->addColumn('avatar_url', 'string', ['default' => '', 'comment' => '用户头像'])
                ->addColumn('gender', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 0, 'signed' => false, 'comment' => '性别（0为未知，1为男，2为女）'])
                ->addColumn('phone', 'string', ['limit' => 60, 'default' => '', 'comment' => '电话'])
                ->addColumn('city', 'string', ['default' => '', 'comment' => '所在城市'])
                ->addColumn('province', 'string', ['default' => '', 'comment' => '省'])
                ->addColumn('country', 'string', ['default' => '', 'comment' => '国家'])
                ->create();
    }
}
