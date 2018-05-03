<?php


use Phinx\Migration\AbstractMigration;

class RenameUserColumn extends AbstractMigration
{
    // 重命名用户表的avatar_url、nick_name字段，使其专门指微信的头像和昵称，为以后兼容支付宝小程序所用
    public function change()
    {
        $this->table('inv_user')
                ->renameColumn('avatar_url', 'wx_avatar_url')
                ->renameColumn('nick_name', 'wx_nick_name')
                ->update();
    }
}
