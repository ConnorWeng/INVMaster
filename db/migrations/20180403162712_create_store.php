<?php


use Phinx\Migration\AbstractMigration;

class CreateStore extends AbstractMigration
{
    public function change()
    {
        $this->table('inv_store', ['id' => 'store_id', 'comment' => '店铺表'])
                ->addColumn('store_name', 'string', ['limit' => 60, 'default' => '', 'comment' => '档口名称'])
                ->addColumn('owner_name', 'string', ['limit' => 60, 'default' => '', 'comment' => '档主姓名'])
                ->addColumn('store_logo', 'string', ['default' => '', 'comment' => '档口logo'])
                ->addColumn('description', 'text', ['comment' => '档口描述'])
                ->addColumn('region', 'string', ['limit' => 100, 'default' => '', 'comment' => '档口所在区域'])
                ->addColumn('address', 'string', ['default' => '', 'comment' => '档口具体地址'])
                ->addColumn('zipcode', 'string', ['limit' => 20, 'default' => '', 'comment' => '邮编'])
                ->addColumn('tel', 'string', ['limit' => 60, 'default' => '', 'comment' => '电话'])
                ->addColumn('phone', 'string', ['limit' => 60, 'default' => '', 'comment' => '移动电话'])
                ->addColumn('im_ww', 'string', ['limit' => 60, 'default' => '', 'comment' => '旺旺号'])
                ->addColumn('im_wx', 'string', ['limit' => 60, 'default' => '', 'comment' => '微信号'])
                ->addColumn('add_time', 'integer', ['limit' => 10, 'default' => NULL, 'null' => true, 'signed' => false, 'comment' => '开店时间戳'])
                ->addColumn('end_time', 'integer', ['limit' => 10, 'default' => NULL, 'null' => true, 'signed' => false, 'comment' => '闭店时间戳'])
                ->create();
    }
}
