<?php


use Phinx\Migration\AbstractMigration;

class RenameUserColumn extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    // zjh 重命名用户表的avatar_url、nick_name字段，使其专门指微信的头像和昵称，为以后兼容支付宝小程序所用
    public function up()
    {
        $this->table('inv_user')
        
            ->renameColumn('avatar_url', 'wx_avatar_url')
            ->renameColumn('nick_name', 'wx_nick_name');
    }

    // public function down()
    // {
    //     $this->table('inv_user')
        
    //         ->renameColumn('wx_avatar_url', 'avatar_url');
    // }
}
