<?php


use Phinx\Seed\AbstractSeed;

class StoreSeeder extends AbstractSeed
{
    public function run()
    {
        $store_id = $this->query("select store_id from inv_store where store_name = 'seed店铺'")->fetch()[0];
        if ($store_id) {
            $this->execute("delete from inv_stock_sku where stock_id in (select stock_id from inv_store where store_id = {$store_id})");
            $this->execute("delete from inv_store where store_id = ".$store_id);
            $this->execute("delete from inv_user_store_relate where store_id = ".$store_id);
            $this->execute("delete from inv_stock where store_id = ".$store_id);
        }

        $inv_store = $this->table('inv_store');
        $inv_store->insert([
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

        $store_id = $this->query("select max(store_id) from inv_store")->fetch()[0];
        $user_id = $this->query("select user_id from inv_user where open_id = 'oRBw65KX7KN23HeMx7mCyJ-u6dbw'")->fetch()[0];

        $this->table('inv_user_store_relate')->insert(['user_id' => $user_id, 'store_id' => $store_id])->save();
        $this->table('inv_stock')->insert([
            'store_id' => $store_id,
            'thumbnail' => '',
            'product_code' => '6887',
            'sku_content' => '颜色：红色，尺码：XL',
            'stock_amount' => 150])->save();

        $stock_id = $this->query('select max(stock_id) from inv_stock')->fetch()[0];

        $this->table('inv_stock_sku')->insert([
            ['stock_id' => $stock_id, 'color' => '红色', 'size' => 'XL', 'stock_amount' => 50],
            ['stock_id' => $stock_id, 'color' => '黄色', 'size' => 'L', 'stock_amount' => 50],
            ['stock_id' => $stock_id, 'color' => '蓝色', 'size' => 'M', 'stock_amount' => 50]])->save();
    }
}
