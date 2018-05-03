<?php


use Phinx\Migration\AbstractMigration;

class FixUserOpenId extends AbstractMigration
{
    // 修正用户表中的 open_id 字段的类型和长度
    public function change()
    {
        $this->table('inv_user')
                ->changeColumn('open_id', 'string', ['limit' => 100, 'default' => '', 'comment' => '微信用户id'])
                ->update();
    }
}
