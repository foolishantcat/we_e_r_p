<?php

namespace app\service\goods;


use app\models\GoodsDao;

class GoodsService
{
    /**
     * @param array $input
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getGoodsInfo($input = [])
    {
        $goodsDao = new GoodsDao();
        $condition = [];
        $condition['del'] = 0;
        if ($input['goods_id']) {
            $condition['goods_id'] = $input['goods_id'];
        }
        if ($input['goods_name']) {
            $condition['goods_name'] = $input['goods_name'];
        }
        if ($input['type']) {
            $condition['type'] = $input['type'];
        }
        if ($input['kind']) {
            $condition['kind'] = $input['kind'];
        }
        if ($input['handler']) {
            $condition['handler'] = $input['handler'];
        }
        $offset = ($input['page'] - 1) * $input['rows'];
        $out = $goodsDao->find()->where($condition)->orderBy(['update_time' => SORT_DESC])->limit($input['rows'])->offset($offset)->asArray()->all();
        return $out;
    }

    /**
     * 新建商品
     * @param $input
     * @return array
     */
    public function addGoods($input)
    {
        $goodsDao = new GoodsDao();
        //生成随机id
        $input['status'] = "正常";
        $goodsDao->setAttributes($input, false);
        $res = $goodsDao->save(false);
        $orderID = $goodsDao->getAttribute('goods_id');
        $newData = $this->getGoodsInfo(['goods_id' => $orderID])[0];
        if ($res) {
            return ['code' => 0, 'data' => $newData];
        } else {
            \Yii::info('add goods error.', __FUNCTION__);
            return ['code' => 0, 'data' => 'add goods error'];
        }
    }
}