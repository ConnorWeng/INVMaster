<?php

namespace apps\common\model;


use think\Model;

class InvStockSku extends Model {

    public function stock() {
        return $this->hasOne('InvStock', 'stock_id', 'stock_id');
    }

    public function getSku($stockId, $color, $size) {
        return $this->hasWhere('stock', [
            'stock_id' => $stockId,
            'InvStockSku.color' => $color,
            'InvStockSku.size' => $size])->find();
    }

}
