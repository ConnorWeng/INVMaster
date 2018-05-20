<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $wx_session_info = $this->table('wx_session_info');
        $wx_session_info->truncate();
        $wx_session_info->insert([
            'open_id' => 'oRBw65KX7KN23HeMx7mCyJ-u6dbw',
            'uuid' => '297b6b794c762bcb5135ed03718ab03f',
            'skey' => 'e2dc4720465f1ad26990b77ebe6976c0e2c4ce54',
            'create_time' => '2018-05-07 00:39:06',
            'last_visit_time' => '2018-05-14 22:13:07',
            'session_key' => 'zBM9ifrfCGT5/XxdopyUVg==',
            'user_info' => '{"openId":"oRBw65KX7KN23HeMx7mCyJ-u6dbw","nickName":"Connor.W","gender":1,"language":"zh_CN","city":"Pudong New District","province":"Shanghai","country":"China","avatarUrl":"https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eq5G5iaJNoq4zDSjTYcjV2ZAyydzwEOXBo87Z6nJ0yqA7pvxhkVmJicquHZKAop7tgjDufaics9iawpRA/132","watermark":{"timestamp":1526058180,"appid":"wxf055c7a111fd4d2b"}}'])
                ->save();

        $inv_user = $this->table('inv_user');
        $inv_user->truncate();
        $inv_user->insert([
            'user_id' => 1,
            'open_id' => 'oRBw65KX7KN23HeMx7mCyJ-u6dbw',
            'wx_nick_name' => 'Connor.W',
            'wx_avatar_url' => 'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eq5G5iaJNoq4zDSjTYcjV2ZAyydzwEOXBo87Z6nJ0yqA7pvxhkVmJicquHZKAop7tgjDufaics9iawpRA/132',
            'gender' => 1,
            'phone' => '13808766355',
            'city' => 'Pudong New District',
            'province' => 'Shanghai',
            'country' => 'China'])
                ->save();
    }
}
