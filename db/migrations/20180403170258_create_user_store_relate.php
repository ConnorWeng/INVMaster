<?php


use Phinx\Migration\AbstractMigration;

class CreateUserStoreRelate extends AbstractMigration
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

    // zjh 创建用户档口关联表
    public function up()
    {
        $this->table('inv_user_store_relate', array('collation' => 'utf8mb4_unicode_ci','comment'=>'用户档口关联表'))
        
            ->addColumn('user_id', 'integer', array('limit' => 10,'default'=>0,'signed'=>false,'comment'=>'用户id'))
            ->addColumn('store_id', 'integer', array('limit' => 10,'default'=>0,'signed'=>false,'comment'=>'店铺id')) 

            ->save();
    }

    // zjh 只作测试用，提交前屏蔽掉
    // public function down()
    // {
    //     // 删除表
    //     $this->dropTable('inv_user_store_relate');
    // }
}
