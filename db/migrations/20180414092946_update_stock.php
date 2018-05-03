<?php


use Phinx\Migration\AbstractMigration;

class UpdateStock extends AbstractMigration
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
    // zjh 更新库存表，删除color和size字段，增加sku_content
    public function up()
    {
        $this->table('inv_stock')

            ->removeColumn('color')
            ->removeColumn('size')
            ->addColumn('sku_content', 'text', array('comment'=>'商品的sku相关信息','after' => 'product_code'))

            ->update();
    }
}
