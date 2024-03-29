<?php


/**
 * api  返回数据
 *
 * @param number 	$code
 * @param string 	$msg
 * @param array 	$data
 * @param array 	$issue 
 *
 * @return array
 *
 * @author zjh 
 *
 * @date 2018-04-10
 *
 * -----------------------------------------------------------------------------------------------------
 *
 *	该函数有 3 种输入方式：
 * 
 * 1、( code , msg )								// 系统或接口层错误码 
 * 2、( code , msg , [], issue)					// 业务层错误码 (第三个参数必须为空)
 * 3、( code , msg , data )						// 正确码
 *
 *  该函数有 3 种返回格式：
 * 
 * 1、系统层或接口层的错误返回
 * 		
 *		{	  
 *		   "code" : 404, 
 *		   "message" : "operator not found" 
 *		}
 *
 * 2、业务层的错误返回
 * 			
 *		{
 *		   "code" : 999, 
 *		   "message" : "business level issue", 
 *		   "issue" : [
 *		        "subcode" : "user.users.1001",
 *		        "msg" : "can not find any user "		    
 *		   ]
 *		}
 *
 * 3、正确的返回
 * 		{
 *		   "code" : 0,
 *		   "message" : "success",
 *		   "data" : {
 *	
 *		   }
 *		}
 * 
 * -----------------------------------------------------------------------------------------------------
 */
function api_result( $code, $msg = '', $data = [], $issue = [] ) {
	
	$result = [
		'code' => (int)$code,
		'message'=>(string)$msg
	];

	if(empty($issue)){  // 非业务层问题

		if ( ! empty( $data ) ) {
			$result['data'] = $data;
		}

	}else{   //业务层问题

		$result['issue'] = $issue;
	}
	
	return $result;
}


/**
 * 获得当前格林威治时间的时间戳
 *
 * @return  integer
 */
function gmtime()
{
    return (time() - date('Z'));
}


 /**
 * 创建目录（如果该目录的上级目录不存在，会先创建上级目录）
 * 依赖于 ROOT_PATH 常量，且只能创建 ROOT_PATH 目录下的目录
 * 目录分隔符必须是 / 不能是 \
 *
 * @param   string  $absolute_path  绝对路径
 * @param   int     $mode           目录权限
 * @return  bool
 */
function api_mkdir($absolute_path, $mode = 0777)
{
    if (is_dir($absolute_path)) {
        return true;
    }

    $root_path     = ROOT_PATH;
    $relative_path = str_replace($root_path, '', $absolute_path);
    $each_path     = explode('/', $relative_path);
    $cur_path      = $root_path; // 当前循环处理的路径
    foreach ($each_path as $path) {
        if ($path) {
            $cur_path = $cur_path . '/' . $path;
            if (!is_dir($cur_path)) {
                if (@mkdir($cur_path, $mode)) {
                    // fclose(fopen($cur_path . '/index.htm', 'w'));
                } else {
                    return false;
                }
            }
        }
    }

    return true;
}

/**
 * 递归删除删除目录,不支持目录中带 ..
 *
 * @param string $dir
 *
 * @return boolen
 */
function api_rmdir($dir)
{
    $dir     = str_replace(array('..', "\n", "\r"), array('', '', ''), $dir);
    $ret_val = false;
    if (is_dir($dir)) {
        $d = @dir($dir);
        if ($d) {
            while (false !== ($entry = $d->read())) {
                if ($entry != '.' && $entry != '..') {
                    $entry = $dir . '/' . $entry;
                    if (is_dir($entry)) {
                        api_rmdir($entry);
                    } else {
                        @unlink($entry);
                    }
                }
            }
            $d->close();
            $ret_val = rmdir($dir);
        }
    } else {
        $ret_val = unlink($dir);
    }

    return $ret_val;
}


/**
 * 动态更改校验选项配置 zjh 2018-04-28 （使用该函数可动态设置接口需校验的选项）
 * 校验选项包括：时间戳、签名、参数、token、请求方式
 * @param  string  $name   校验的选项
 * @param  bool  $value  是否校验
 */
function setValidate($name,$value)
{
    $conf = config('api.validate');

    $result = $conf;

    if(array_key_exists($name, $result)){
        $result[$name] = $value;
    }
    
    config('api.validate',$result);

}


/**
 * 数组按键名升序(递归深入排序)
 * zjh 2018-04-29
 * @param   array  &$array  要排序的数组
 * @return  array           排序后的数组
 */
function deepKsort(&$array)
{
    if(is_array($array)){
        ksort($array);
        foreach($array as $k=>$v){
            if(is_array($v)){
                deepKsort($array[$k]);
            }
        } 
    }
}

/**
 * 递归清除数组键值字符串两边空格
 * zjh 2018-04-29
 * @param   array  &$array  要的数组处理
 * @return  array           处理后的数组
 */
function trimArray(&$array)
{
    if(is_array($array)){
        foreach($array as $k=>$v){
            if(is_array($v)){
                trimArray($array[$k]);
            }else{
                $array[$k] = trim($array[$k]);
            }
        } 
    }else{
        $array = trim($array);
    }
}