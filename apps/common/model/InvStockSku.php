<?php

namespace apps\common\model;


use think\Model;

class InvStockSku extends Model {

    public function stock() {
        return $this->hasOne('InvStock', 'stock_id', 'stock_id');
    }

    public function getSku($productCode, $color, $size) {
        return $this->hasWhere('stock', [
            'product_code' => $productCode,
            'InvStockSku.color' => $color,
            'InvStockSku.size' => $size])->find();
    }

}
