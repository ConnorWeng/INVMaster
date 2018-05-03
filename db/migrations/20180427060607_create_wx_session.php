<?php


use Phinx\Migration\AbstractMigration;

class CreateWxSession extends AbstractMigration
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
    // zjh 创建微信会话记录表
    public function up()
    {
        $this->table('wx_session_info', array('comment'=>'微信会话记录表','id'=>false,'primary_key'=>array('open_id')))

            ->addColumn('open_id', 'string', array('limit' => 100,'default'=>'','comment'=>'微信用户id'))
            ->addColumn('uuid', 'string', array('limit' => 100,'default'=>'','comment'=>'uuid'))
            ->addColumn('skey', 'string', array('limit' => 100,'default'=>'','comment'=>'会话id'))
            ->addColumn('create_time', 'timestamp', array('default'=>'CURRENT_TIMESTAMP','comment'=>'创建时间'))
            ->addColumn('last_visit_time', 'timestamp', array('default'=>'CURRENT_TIMESTAMP','comment'=>'最近更新时间'))
            ->addColumn('session_key', 'string', array('limit' => 100,'default'=>'','comment'=>'会话密钥，用于解密微信的敏感数据'))
            ->addColumn('user_info', 'string', array('limit' => 2048,'default'=>'','comment'=>'用户数据'))

            ->save();
    }

    // zjh 只作测试用，提交前屏蔽掉
    // public function down()
    // {
    //     // 删除表
    //     $this->dropTable('wx_session_info');
    // }
}
