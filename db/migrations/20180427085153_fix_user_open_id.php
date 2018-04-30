<?php


use Phinx\Migration\AbstractMigration;

class FixUserOpenId extends AbstractMigration
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
     // zjh 修正用户表中的 open_id 字段的类型和长度
    public function up()
    {
        $this->table('inv_user')
        
            ->changeColumn('open_id', 'string', array('limit' => 100,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'微信用户id'))

            ->update();
    }
}
