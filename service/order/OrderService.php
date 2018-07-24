<?php

namespace app\service\order;


use app\models\OrdersDao;

class OrderService
{
    /**
     * 订单详情
     * @param $input
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getOrdersInfo($input)
    {
        $orderDao = new OrdersDao();
        $offset = ($input['page'] - 1) * $input['rows'];
        $condition = [];
        if ($input['order_id']) {
            $condition['order_id'] = $input['order_id'];
        }
        if ($input['handler']) {
            $condition['handler'] = $input['handler'];
        }
        if ($input['customer_name']) {
            $condition['customer_name'] = $input['customer_name'];
        }
        if ($input['goods_id']) {
            $condition['goods_id'] = $input['goods_id'];
        }
        $out = $orderDao->find()->where($condition)->orderBy(['update_time' => SORT_DESC])->limit($input['rows'])->offset($offset)->all();
        return ['code' => 0, 'data' => $out];
    }

    /**
     * 添加订单
     * @param $input
     * @return array
     */
    public function addOrders($input)
    {
        $tradeDao = new OrdersDao();
        //生成随机id
        $input['status'] = "订单被创建";
        $tradeDao->setAttributes($input, false);
        $res = $tradeDao->save(false);
        $orderID = $tradeDao->getAttribute('order_id');
        $newData = $this->getOrdersInfo(['order_id' => $orderID]);
        if ($res) {
            return ['code' => 0, 'msg' => 'ok', 'data' => $newData];
        } else {
            \Yii::info('add orders error.', __FUNCTION__);
            return ['code' => -1, 'msg' => 'add orders error.'];
        }
    }
}