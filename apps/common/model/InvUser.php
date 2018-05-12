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

class InvUser extends Model {
    /**
     * 获取一个数据
     * @param   [type]  $id  [description]
     * @return  [type]       [description]
     */
    public function user($id)
    {

    }

    public static function wxStoreUserInfo ($userinfo,$withUserinfo) {

        $open_id = $userinfo['openId'];

        $res = self::where('open_id', $open_id)->find();

        if($withUserinfo === 'no'){
            if(!$res){   // 不存在时，只创建open_id信息
                self::create([
                    'open_id'           => $open_id,
                ]);
            }
            return;
        }

        $wx_nick_name = $userinfo['nickName'];
        $wx_avatar_url = $userinfo['avatarUrl'];

        $gender = $userinfo['gender'];
        $city = $userinfo['city'];
        $province = $userinfo['province'];
        $country = $userinfo['country'];



        if (!$res) {

            self::create([
                'open_id'           => $open_id,
                'wx_nick_name'      => $wx_nick_name,
                'wx_avatar_url'     => $wx_avatar_url,
                'gender'            => $gender,
                'city'              => $city,
                'province'          => $province,
                'country'           => $country,
            ]);

        } else {

            self::update([
                'wx_nick_name'      => $wx_nick_name,
                'wx_avatar_url'     => $wx_avatar_url,
                'gender'            => $gender,
                'city'              => $city,
                'province'          => $province,
                'country'           => $country,

            ], ['open_id' => $open_id]);

        }
    }

    public function stores() {
        return $this->belongsToMany('InvStore', 'InvUserStoreRelate', 'store_id', 'user_id');
    }

}
