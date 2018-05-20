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

class InvStockLog extends Model {


    /**
     * 获取一个数据
     * @param   [type]  $id  [description]
     * @return  [type]       [description]
     */
    public function stockLog($id)
    {

    }

    public function log($user, $sku, $type, $amount) {
        $this->data([
            'user_id' => $user->user_id,
            'nick_name' => $user->wx_nick_name,
            'stock_id' => $sku->stock_id,
            'product_code' => $sku->stock->product_code,
            'color' => $sku->color,
            'size' => $sku->size,
            'type' => $type,
            'number' => $amount,
            'log' => '',
            'amount_left' => $sku->stock_amount,
        ])->save();
    }

    public function stockSummary($stockId) {
        return [
            'in' => $this->where(['stock_id' => $stockId, 'type' => 1])->sum('number'),
            'out' => $this->where(['stock_id' => $stockId, 'type' => 2])->sum('number')];
    }

    public function stocksSummary($storeId, $start, $limit) {
        return $this->field(['stock_id,product_code,type,sum(number) as number'])->where('store_id', $storeId)->group('stock_id,type')->limit($start, $limit)->select();
    }

}
