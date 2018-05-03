<?php


use Phinx\Migration\AbstractMigration;

use Phinx\Db\Adapter\MysqlAdapter;  //zjh

class CreateUser extends AbstractMigration
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
    // zjh 删掉 change函数，用up函数代替
    // public function change()
    // {

    // }

    // zjh 创建用户表
    public function up()
    {
        $this->table('inv_user', array('id'=>'user_id','comment'=>'用户表'))

            ->addColumn('open_id', 'integer', array('limit' => 10,'default'=>0,'signed'=>false,'comment'=>'微信用户id'))
            ->addColumn('nick_name', 'string', array('limit' => 60,'default'=>'','comment'=>'昵称'))
            ->addColumn('avatar_url', 'string', array('default'=>'','comment'=>'用户头像'))
            ->addColumn('gender', 'integer', array('limit' => MysqlAdapter::INT_TINY,'default'=>0,'signed'=>false,'comment'=>'性别（0为未知，1为男，2为女）'))
            ->addColumn('phone', 'string', array('limit' => 60,'default'=>'','comment'=>'电话'))
            ->addColumn('city', 'string', array('default'=>'','comment'=>'所在城市'))
            ->addColumn('province', 'string', array('default'=>'','comment'=>'省'))
            ->addColumn('country', 'string', array('default'=>'','comment'=>'国家'))

            ->save();
    }

    // zjh 只作测试用，提交前屏蔽掉
    // public function down()
    // {
    //     // 删除表
    //     $this->dropTable('inv_user');
    // }
}
