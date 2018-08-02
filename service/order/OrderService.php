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
        if (isset($input['handler']) && $input['handler']) {
            $condition['handler'] = $input['handler'];
        }
        if (isset($input['customer_name']) && $input['customer_name']) {
            $condition['customer_name'] = $input['customer_name'];
        }
        if (isset($input['goods_id']) && $input['goods_id']) {
            $condition['goods_id'] = $input['goods_id'];
        }
        $condition['del'] = 0;
        $out = $orderDao->find()->where($condition)->orderBy(['update_time' => SORT_DESC])->limit($input['rows'])->offset($offset)->asArray()->all();
        return ['code' => 0, 'data' => $out];
    }

    /**
     * 添加订单
     * @param $input
     * @return array
     */
    public function addOrders($input)
    {
        $ordersDao = new OrdersDao();
        //生成随机id
        $input['status'] = "订单被创建";
        $ordersDao->setAttributes($input, false);
        $res = $ordersDao->save(false);
        if (isset($input['end_time'])) {
            $input['end_date'] = substr($input['end_time'], 0, 10);
        }
        $orderID = $ordersDao->getAttribute('order_id');
        $newData = $this->getOrdersInfo(['order_id' => $orderID]);
        if ($res) {
            return ['code' => 0, 'data' => $newData];
        } else {
            \Yii::info('add orders error.', __FUNCTION__);
            return ['code' => -1, 'msg' => 'add orders error.'];
        }
    }

    /**
     * 获取默认排名
     * @return array
     */
    public function getOrderRank()
    {
        \Yii::$app->db->createCommand('SET @counter = 0;')->query();
        \Yii::$app->db->createCommand('SET @counter = 0;')->query();
        $dayEnd = date('Y-m-d', time()) . ' 23:59:59';
        $today = date('Y-m-d', time());
        $dOrderRank = $this->orderRank($today, $dayEnd, '当天');
        $day = date("w");
        if ($day) {
            $wDay = date('Y-m-d', strtotime('-' . ($day - 1) . ' day'));
        } else {
            $wDay = date('Y-m-d', strtotime('-6 day'));
        }
        $wOrderRank = $this->orderRank($wDay, $dayEnd, '本周');
        $dayMonth = date('Y-m', time()) . '-1';
        $mOrderRank = $this->orderRank($dayMonth, $dayEnd, '本月');
        $selectStaffID = $dOrderRank[0]['staff_id'];
        $rankInfo = $this->getRankInfo(['staff_id' => $selectStaffID]);
        $data = [
            "d_order_rank" => $dOrderRank,
            "w_order_rank" => $wOrderRank,
            "m_order_rank" => $mOrderRank,
            "rank_info" => $rankInfo['data'],
        ];
        return ['code' => 0, 'data' => $data];
    }

    /**
     * 获取单人排名检索
     * @param $input
     * @return array
     */
    public function getRankInfo($input)
    {
        $dayEnd = date('Y-m-d', time()) . ' 23:59:59';
        $today = date('Y-m-d', time());
        $day = date("w");
        if ($day) {
            $wDay = date('Y-m-d', strtotime(($day - 1) . ' day'));
        } else {
            $wDay = date('Y-m-d', strtotime('-6 day'));
        }
        $dayMonth = date('Y-m', time()) . '-1';
        return ['code' => 0, 'data' => [
            $this->selectUserRank($input, $today, $dayEnd, '当天'),
            $this->selectUserRank($input, $wDay, $dayEnd, '本周'),
            $this->selectUserRank($input, $dayMonth, $dayEnd, '本月')
        ]];
    }

    /**
     * 获取排名
     * @param $startDate
     * @param $endDate
     * @param $area
     * @return array|bool|\yii\db\ActiveRecord[]
     */
    public function orderRank($startDate, $endDate, $area)
    {
        if (!$startDate || !$endDate) {
            return false;
        }
        $ordersDao = new OrdersDao();
        \Yii::$app->db->createCommand('SET @counter = 0;')->query();
        \Yii::$app->db->createCommand("SET @area = :area;", [':area' => $area])->query();
        $select = '	@area AS `area`,
                    @counter :=@counter + 1 AS `rank`,
                    `handler_id` AS `staff_id`,
                    `handler` AS `staff_name`,
                    sum(goods_count) deal_count,
                    sum(amountofmoney) deal_money,
                    MAX(end_time) last_deal_time';
        $dDate = $ordersDao->find()
            ->select($select)
            ->andFilterCompare('end_time', $startDate, '>=')
            ->andFilterCompare('end_time', $endDate, '<=')
            ->groupBy('handler_id')
            ->orderBy(['deal_money' => SORT_DESC])
            ->limit(3)
            ->asArray()->all();
        return $dDate ? $dDate : [];
    }

    /**
     * @param $input
     * @param $startDate
     * @param $endDate
     * @param $area
     * @return array|\yii\db\ActiveRecord
     */
    public function selectUserRank($input, $startDate, $endDate, $area)
    {
        $out = [];
        if (!$input['staff_id'] && !$input['staff_name']) {
            return $out;
        }
        \Yii::$app->db->createCommand("SET @area = :area;", [':area' => $area])->query();
        $ordersDao = new OrdersDao();
        $select = '	@area AS `area`,
                    `handler_id` AS `staff_id`,
                    `handler` AS `staff_name`,
                    sum(goods_count) deal_count,
                    sum(amountofmoney) deal_money,
                    MAX(end_time) last_deal_time';
        $activeQuery = $ordersDao->find();
        $activeQuery->select($select)
            ->andFilterCompare('end_time', $startDate, '>=')
            ->andFilterCompare('end_time', $endDate, '<=');
        if ($input['staff_id']) {
            $activeQuery->andWhere(['handler_id' => $input['staff_id']]);
        }
        if ($input['staff_name']) {
            $activeQuery->andWhere(['handler' => $input['staff_name']]);
        }
        $dDate = $activeQuery->groupBy('handler_id')
            ->orderBy(['deal_count' => SORT_DESC])
            ->asArray()->one();
        if (empty($dDate)) {
            return [];
        }

        $rankActiveQuery = $ordersDao->find();
        $rankActiveQuery->select(['handler_id']);
        $rankActiveQuery->andFilterCompare('end_time', $startDate, '>=')
            ->andFilterCompare('end_time', $endDate, '<=');
        if ($input['staff_id']) {
            $rankActiveQuery->andFilterCompare('handler_id', $input['staff_id'], '!=');
        }
        if ($input['staff_name']) {
            $rankActiveQuery->andFilterCompare('handler', $input['staff_name'], '!=');
        }
        $rank = $rankActiveQuery->groupBy('handler_id')
            ->andHaving(['>', 'sum(amountofmoney)', $dDate['deal_count']])
            ->asArray()->all();
        $dDate['rank'] = count($rank) + 1;
        return $dDate;
    }
}