<?php


use Phinx\Migration\AbstractMigration;

class CreateStore extends AbstractMigration
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

    // zjh 创建店铺表
    public function up()
    {
        $this->table('inv_store', array('id'=>'store_id','collation' => 'utf8mb4_unicode_ci','comment'=>'店铺表'))
        
            ->addColumn('store_name', 'string', array('limit' => 60,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'档口名称'))
            ->addColumn('owner_name', 'string', array('limit' => 60,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'档主姓名'))
            ->addColumn('store_logo', 'string', array('default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'档口logo'))
            ->addColumn('description', 'text', array('default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'档口描述'))
            ->addColumn('region', 'string', array('limit' => 100,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'档口所在区域'))
            ->addColumn('address', 'string', array('default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'档口具体地址'))
            ->addColumn('zipcode', 'string', array('limit' => 20,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'邮编'))
            ->addColumn('tel', 'string', array('limit' => 60,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'电话'))
            ->addColumn('phone', 'string', array('limit' => 60,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'移动电话'))
            ->addColumn('im_ww', 'string', array('limit' => 60,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'旺旺号'))
            ->addColumn('im_wx', 'string', array('limit' => 60,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'微信号'))
            ->addColumn('add_time', 'integer', array('limit' => 10,'default'=>NULL,'null'=>true,'signed'=>false,'comment'=>'开店时间戳')) 
            ->addColumn('end_time', 'integer', array('limit' => 10,'default'=>NULL,'null'=>true,'signed'=>false,'comment'=>'闭店时间戳')) 

            ->save();
    }

    // zjh 只作测试用，提交前屏蔽掉
    // public function down()
    // {
    //     // 删除表
    //     $this->dropTable('inv_store');
    // }
}
