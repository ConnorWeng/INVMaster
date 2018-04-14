<?php


use Phinx\Migration\AbstractMigration;

class UpdateStockLog extends AbstractMigration
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
    // zjh 更新出入库操作记录表，增加颜色和尺码字段
    public function up()
    {
        $this->table('inv_stock_log')


            ->addColumn('color', 'string', array('limit' => 60,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'颜色','after' => 'product_code'))
            ->addColumn('size', 'string', array('limit' => 60,'default'=>'','collation'=>'utf8mb4_unicode_ci','comment'=>'尺码','after' => 'color'))

            ->save();
    }
}
