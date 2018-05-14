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

class InvStock extends Model {

    public function skus() {
        return $this->hasMany('InvStockSku', 'stock_id');
    }

    public function getStoreProducts($storeId, $limit, $start) {
        $relateModel = $this->hasManyThrough('InvStock', 'InvUserStoreRelate');
        return $relateModel->where('store_id', $storeId)->limit($start, $limit)->select();
    }

    public function searchByProductCode($storeId, $productCode) {
        return $this->get(['store_id' => $storeId, 'product_code' => $productCode]);
    }

}
