<?php


use Phinx\Seed\AbstractSeed;

class StoreSeeder extends AbstractSeed
{
    public function run()
    {
        $inv_store = $this->table('inv_store');
        $inv_store->truncate();
        $inv_store->insert([
            'store_id' => 1,
            'store_name' => 'seed店铺',
            'owner_name' => 'Connor Weng',
            'store_logo' => '',
            'description' => '用于演示 API',
            'region' => '上海',
            'address' => '市中心',
            'zipcode' => '200000',
            'tel' => '57826548',
            'phone' => '13803974799',
            'im_ww' => 'wangwang',
            'im_wx' => 'wxwx',
            'add_time' => '1526484718',
            'end_time' => '1626484718',
            'market_name' => '大西豪'])
                ->save();

        $inv_user_store_relate = $this->table('inv_user_store_relate');
        $inv_user_store_relate->truncate();
        $inv_user_store_relate->insert(['user_id' => 1, 'store_id' => 1])->save();

        $inv_stock = $this->table('inv_stock');
        $inv_stock->truncate();
        $inv_stock->insert([
            'stock_id' => 1,
            'product_id' => 1,
            'store_id' => 1,
            'stock_amount' => 150,
            'add_time' => 1526822490,
            'last_update' => 1526822490])->save();

        $inv_product = $this->table('inv_product');
        $inv_product->truncate();
        $inv_product->insert([
            'product_id' => 1,
            'store_id' => 1,
            'product_code' => '6888',
            'product_name' => '测试商品1',
            'vendor' => 1,
            'add_time' => 1526822490,
            'last_update' => 1526822490])->save();

        $inv_stock_sku = $this->table('inv_stock_sku');
        $inv_stock_sku->truncate();
        $inv_stock_sku->insert([
            ['stock_id' => 1, 'color' => '红色', 'size' => 'XL', 'stock_amount' => 50],
            ['stock_id' => 1, 'color' => '黄色', 'size' => 'L', 'stock_amount' => 50],
            ['stock_id' => 1, 'color' => '蓝色', 'size' => 'M', 'stock_amount' => 50]])->save();

        $inv_stock_log = $this->table('inv_stock_log');
        $inv_stock_log->truncate();
        $inv_stock_log->insert([
            'user_id' => 1,
            'nick_name' => 'Connor.W',
            'stock_id' => 1,
            'store_id' => 1,
            'product_code' => '6888',
            'color' => '红色',
            'size' => 'XL',
            'type' => 1,
            'number' => 100,
            'log' => '',
            'add_time' => 1526822490,
            'amount_left' => 100])->save();
        $inv_stock_log->insert([
            'user_id' => 1,
            'nick_name' => 'Connor.W',
            'stock_id' => 1,
            'store_id' => 1,
            'product_code' => '6888',
            'color' => '红色',
            'size' => 'XL',
            'type' => 2,
            'number' => 50,
            'log' => '',
            'add_time' => 1526822590,
            'amount_left' => 50])->save();
    }
}
