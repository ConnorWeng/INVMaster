<?php

namespace apps\common\model;


use think\Model;

class InvProduct extends Model {

    public function getLatestProduct($storeId) {
        return $this->where(['store_id' => $storeId, 'vendor' => 1])->order('add_time', 'desc')->select();
    }

}
