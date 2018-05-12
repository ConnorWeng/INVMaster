<?php
// +----------------------------------------------------------------------
// | model层
// +----------------------------------------------------------------------
// | Author: zjh <temp2016good@163.com>
// +----------------------------------------------------------------------
// | Date: 2018-04-11
// +----------------------------------------------------------------------

namespace apps\common\model;

use think\Model;

class WxSessionInfo extends Model
{
    public static function storeUserInfo ($userinfo, $skey, $session_key,$withUserinfo) {
        $uuid = bin2hex(openssl_random_pseudo_bytes(16));
        $create_time = date('Y-m-d H:i:s');
        $last_visit_time = $create_time;

        $open_id = $userinfo['openId'];

        //JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES = 320
        $user_info = json_encode($userinfo,320);

        $res = self::get($open_id);

        if (!$res) {

            $add = [
                'open_id'           => $open_id,
                'uuid'              => $uuid,
                'skey'              => $skey,
                'create_time'       => $create_time,
                'last_visit_time'   => $last_visit_time,
                'session_key'       => $session_key,
            ];

            if($withUserinfo === 'yes'){
                $add['user_info'] = $user_info;
            }

            self::create($add);

            return 'add';

        } else {

            $update = [
                'uuid'              => $uuid,
                'skey'              => $skey,
                'last_visit_time'   => $last_visit_time,
                'session_key'       => $session_key,
            ];

            if($withUserinfo === 'yes'){
                $update['user_info'] = $user_info;
            }

            self::update($update, ['open_id' => $open_id]);

            return 'update';

        }
    }

    public function user() {
        return $this->hasOne('InvUser', 'open_id');
    }

    public function findUserBySKey ($skey) {
        return $this->hasWhere('user', ['WxSessionInfo.skey' => $skey])->find();
    }
}
