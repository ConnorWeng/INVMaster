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
// | 不要删除 {%new_code%} ，其用于命令 csm 自动追加新错误码
// +----------------------------------------------------------------------


return [

	'stores.id'=>[
		//GET
		1000 => 'no resources',

		//POST
		2000 => 'test',

		//PUT
		3000 => 'test',

		//PATCH
		4000 => 'test',

		//DELETE
		5000 => 'test',

	],

/*{%new_code%}*/

];
