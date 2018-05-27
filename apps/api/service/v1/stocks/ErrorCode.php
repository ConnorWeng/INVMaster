<?php
// +----------------------------------------------------------------------
// | 业务层错误码
// +----------------------------------------------------------------------
// | 格式：服务模块.资源模块[.id].自定义码值 (如：user.users[.id].1001)
// | 对应的接口： Method: /api/版本/服务模块/资源模块/[资源id] (如：GET: /api/v1/user/users/[id])
// | 其中 [id] 代表id可有可无
// +----------------------------------------------------------------------
// | 自定义码值：1xxx (代表GET) ， 2xxx（代表POST） ， 3xxx（代表PUT）
// |			4xxx（代表PATCH） ， 5xxxx（代表DELETE）
// +----------------------------------------------------------------------
// | 以后若有需要，可考虑扩展为多语言版本
// +----------------------------------------------------------------------
// | Author: zjh
// +----------------------------------------------------------------------
// | Date：2018-04-09
// +----------------------------------------------------------------------


return [

    'stock.stocks.id'=>[
        //GET
        1000 => '没有指定库存商品',
        1001 => 'get_test2',

        //POST
        2000 => 'post_test',


    ],

    'stock.stocks'=>[
        //GET
        1000 => '没有任何库存信息',
        1001 => 'get_test2',

        //POST
        2000 => 'post_test',


    ],

    'stock.stock_logs.id'=>[
        //GET
        1000 => '没有操作记录',
        1001 => 'get_test2',

        //POST
        2000 => 'post_test',


    ],

    'stock.stock_logs'=>[
        //GET
        1000 => '没有任何库存操作记录',
        1001 => 'get_test2',

        //POST
        2000 => 'post_test',


    ],

    'stocks.logs'=>[
        //GET
        1000 => '没有任何库存操作记录',
    ],
];
