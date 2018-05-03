<?php


use Phinx\Migration\AbstractMigration;

class CreateWxSession extends AbstractMigration
{
    public function change()
    {
        $this->table('wx_session_info', ['comment' => '微信会话记录表', 'id' => false, 'primary_key' => ['open_id']])
                ->addColumn('open_id', 'string', ['limit' => 100, 'default' => '', 'comment' => '微信用户id'])
                ->addColumn('uuid', 'string', ['limit' => 100, 'default' => '', 'comment' => 'uuid'])
                ->addColumn('skey', 'string', ['limit' => 100, 'default' => '', 'comment' => '会话id'])
                ->addColumn('create_time', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '创建时间'])
                ->addColumn('last_visit_time', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '最近更新时间'])
                ->addColumn('session_key', 'string', ['limit' => 100, 'default' => '', 'comment' => '会话密钥，用于解密微信的敏感数据'])
                ->addColumn('user_info', 'string', ['limit' => 2048, 'default' => '', 'comment' => '用户数据'])
                ->create();
    }
}
