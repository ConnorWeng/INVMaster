<?php
// +----------------------------------------------------------------------
// | qcloud sdk (重构并精简官方的sdk)
// +----------------------------------------------------------------------
// | Author: zjh <temp2016good@163.com>
// +----------------------------------------------------------------------
// | Date: 2018-04-27
// +----------------------------------------------------------------------
 
namespace apps\common\qcloud\auth;
// namespace QCloud_WeApp_SDK\Auth;

use think\Exception as Exception;
use apps\common\qcloud\Constants as Constants;
use apps\common\qcloud\helper\Request as Request;
use apps\common\model\WxSessionInfo as WxSessionInfo;
use apps\common\model\InvUser as InvUser;

class AuthAPI {
    /**
     * 用户登录接口
     * @param {string} $code        wx.login 颁发的 code
     * @param {string} $encryptData 加密过的用户信息
     * @param {string} $iv          解密用户信息的向量
     * @return {array} { loginState, userinfo }
     */
    public static function login($code, $encryptData, $iv, $withUserinfo) {
        // 1. 获取 session key
        list($sessionKey , $openId)= self::getSessionKey($code);

        // 2. 生成 3rd key (skey)
        $skey = sha1($sessionKey . mt_rand());
        
        /**
         * 3. 解密数据
         * 由于官方的解密方法不兼容 PHP 7.1+ 的版本
         * 这里弃用微信官方的解密方法
         * 采用推荐的 openssl_decrypt 方法（支持 >= 5.3.0 的 PHP）
         * @see http://php.net/manual/zh/function.openssl-decrypt.php
         */
        if($withUserinfo === 'yes'){
            $decryptData = \openssl_decrypt(
                base64_decode($encryptData),
                'AES-128-CBC',
                base64_decode($sessionKey),
                OPENSSL_RAW_DATA,
                base64_decode($iv)
            );
            $userinfo = json_decode($decryptData,true);
            $data = $decryptData;

        }else{
            $userinfo['openId'] = $openId;
            // $userinfo = array_to_object($userinfo);

            $sessionInfo = WxSessionInfo::get($openId);
            $data = $sessionInfo['user_info'];
        }

        // 4. 储存到数据库中
        $operate = WxSessionInfo::storeUserInfo($userinfo, $skey, $sessionKey,$withUserinfo);
        InvUser::wxStoreUserInfo($userinfo,$withUserinfo);

        $userinfo = json_decode($data,true);  //zjh 转换为数组
        
        return [
            'loginState' => Constants::S_AUTH,
            'userinfo' => compact('userinfo', 'skey','operate')
        ];
    }


    /**
     * 通过 code 换取 session key
     * @param {string} $code
     */
    public static function getSessionKey ($code) {

        /**
         * 使用小程序的 AppID 和 AppSecret 获取 session key
         */
        
        $appId = config('api.appId');
        $appSecret = config('api.appSecret');
        list($session_key, $openid) = array_values(self::getSessionKeyDirectly($appId, $appSecret, $code));
        return [$session_key,$openid];

    }

    /**
     * 直接请求微信获取 session key
     * @param {string} $appId  小程序的 appId
     * @param {string} $appSecret 小程序的 appSecret
     * @param {string} $code
     * @return {array} { $session_key, $openid }
     */
    private static function getSessionKeyDirectly ($appId, $appSecret, $code) {
        $requestParams = [
            'appid' => $appId,
            'secret' => $appSecret,
            'js_code' => $code,
            'grant_type' => 'authorization_code'
        ];

        list($status, $body) = array_values(Request::get([
            'url' => 'https://api.weixin.qq.com/sns/jscode2session?' . http_build_query($requestParams),
            'timeout' => config('api.networkTimeout') 
        ]));

        if ($status !== 200 || !$body || isset($body['errcode'])) {
            throw new Exception(Constants::E_LOGIN_FAILED . ': ' . json_encode($body));
        }

        return $body;
    }


}
