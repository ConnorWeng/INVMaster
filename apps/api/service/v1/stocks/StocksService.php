<?php
namespace apps\api\service\v\stocks;

/**
 * 库存信息
 *
 * @author  zjh
 * @version 1.0 2018-04-09
 */

use apps\api\service\v\InnerService;
use apps\common\model\InvStock;
use apps\common\model\InvStockSku;

class StocksService extends InnerService
{
    private $stockModel;
    private $stockSkuModel;

    public function __construct() {
        parent::__construct();
        $this->stockModel = new InvStock;
        $this->stockSkuModel = new InvStockSku;
    }

    /**
     * 允许的请求方式
     * 可以为：get、post、put、delete、patch
     */
    public $allowRequestMethod = [
        'post' => 'POST - 入库',
    ];

    /**
     * 传参 如:
     * "title" => ['标题' , '默认值' ]
     * "title" => ['标题' , '默认值' ,"是否必要或类型约束"]
     * "status" => ['状态' , 1 , ["0" => '禁用' , 1 => '启用'] ]     // 固定数值约束，该变量只有 0 和 1 两个值
     */
    public $defaultParams = [
        'post' => [
            'product_code' => ['款号', 0, 1],
            "color" => ['颜色', '', 1],
            "size" => ['尺码', '', 1],
            "stock_amount" => ['数量', 0, 1]
        ],
    ];

    /**
     * 返回结果示例 如:
     *
     * 'user_id'     => '用户ID',
     * "gender"      => [ "性别", "formatGender" ] ,    // formatGender 为一个格式化函数，代表需要将该值进行一定的格式化
     * 既适用于单个数组，也适用于数组列表中的每一个数组元素
     */
    public $defaultResponse = [
        'get' => [

            'stock_id' =>'库存id',
            'product_id' => '商品id',
            'store_id' => '店铺id',
            'thumbnail' => '商品缩略图',
            'product_code' => '货号',
            'sku_content' => '商品的sku相关信息',
            'stock_amount' => '库存数量',
            'add_time' => ['添加时间',"formatTime"],
            'last_update' => ['最近更新时间',"formatTime"],
            "uri"        => ["当前uri", "formatUri"],
        ],
    ];

    private static $instance;

    public static function instance($params = [])
    {
        if (self::$instance == null) {
            self::$instance         = new StocksService();
            self::$instance->params = $params;
            self::$instance->bCodes = require_once __DIR__."/ErrorCode.php";
            self::$instance->debug  = true;    // 开启调试模式，包括日志的输出
        }

        return self::$instance;
    }

    /**
     * 接口响应方法
     */
    public function response()
    {
        //业务日志记录开始
        $this->log("--------------------- begin","begin -----------------");

        //记录接口调用信息
        $this->logStat( $this->params );

        return parent::response();
    }



/*-----------------------------------------------------------------------------------------------------------*/
//                                         业务处理模块
/*-----------------------------------------------------------------------------------------------------------*/
//      业务处理入口函数分别可以有： get() , post() , put() , delete() , patch()
/*-----------------------------------------------------------------------------------------------------------*/
//      信息返回函数： $this->bError($bcode) 《返回错误信息》 , $this->success($data [,$msg] ) 《返回正确信息》
//      错误码 $bcode 的设置请移步到同目录下的 ErrorCode.php 文件内设置
/*-----------------------------------------------------------------------------------------------------------*/
//      函数 $this->success($data [,$msg]) 会自行根据 $this->defaultResponse 的设置在输出前格式化数据
//      属性 $this->defaultResponse 为空时，直接输出数据，不进行格式化
/*-----------------------------------------------------------------------------------------------------------*/
//      上面的属性 $this->allowRequestMethod 用于控制允许的请求方法
//      上面的属性 $this->defaultParams 用于控制接口入参的类型和必要性
/*-----------------------------------------------------------------------------------------------------------*/
//      记录日志：log($key,$value [,$filename]);   $value可以为数组；
//      $filename 一般不需要，默认文件名为当前类名(需要做一些处理)  如：UsersIdService (类名) ==> users_id (文件名)
/*-----------------------------------------------------------------------------------------------------------*/


    /**
     * [get 业务处理入口]
     * @return  Array  处理结果
     */
    public function get()
    {
        $limit = 10;
        $list = InvStock::all(function ($query) use($limit){
            $query->order('stock_id desc')
                  ->limit($limit);
        });
        if($list) {
            return $this->success($list);
        }else{
            return $this->bError(1000);
        }

    }


    /**
     * [post 业务处理入口]
     * @return  Array  处理结果
     */
    public function post()
    {
        // FIXME: use transaction
        $stock = $this->stockModel->get(['product_code' => $this->params['product_code']]);
        if (!$stock) {
            $this->stockModel->data([
                'store_id' => $this->storeId,
                'product_code' => $this->params['product_code'],
                'sku_content' => '颜色：'.$this->params['color'].'，尺码：'.$this->params['size'],
                'stock_amount' => $this->params['stock_amount']])->save();
        } else {
            $stock->stock_amount = $stock->stock_amount + intval($this->params['stock_amount']);
            $stock->save();
        }
        // TODO: increase amount if sku exists, otherwise insert a new sku. After that update stock amount
        $stockSku = $this->stockSkuModel->getSku($this->params['product_code'], $this->params['color'], $this->params['size']);
        if ($stockSku) {
            $stockSku->stock_amount = $stockSku->stock_amount + intval($this->params['stock_amount']);
            $stockSku->save();
        } else {
            $this->stockSkuModel->data([
                'stock_id' => $this->stockModel->stock_id,
                'color' => $this->params['color'],
                'size' => $this->params['size'],
                'stock_amount' => $this->params['stock_amount']])->save();
        }
        return $this->success('ok');
    }





/*---------------------------------------------------------------------------------------------------------*/

    /**
     * 格式化资源路径
     * @param   [type]  $value  [description]
     * @param   array   $row    [description]
     * @return  [type]          [description]
     */
    public function formatUri($value, $row = [])
    {
        $v = $this->params['apiVersion'];
        return base_uri() . 'api/' . $v . '/stock/stocks/' . $row['stock_id'];
    }

}