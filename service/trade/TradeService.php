<?php

namespace app\service\trade;

use app\models\TradeDao;
use app\publicutil;

class TradeService
{
    /**
     * 获取交易信息
     * @param $input
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getTrade($input)
    {
        $tradeDao = new TradeDao();
        $offset = ($input['page'] - 1) * $input['rows'];
        $tradeData = $tradeDao->find()->where([])->select(['*'])->orderBy(['update_time' => SORT_DESC])->limit($input['rows'])->offset($offset)->all();
        return $tradeData;
    }

    /**
     * 创建交易单
     * @param $input
     * @return array
     */
    public function addTrade($input)
    {
        $tradeDao = new TradeDao();
        //生成随机id
        $tradeID = (new publicutil\Util())->genUniqueTimeId();
        $input['trade_id'] = $tradeID;
        $input['status'] = "订单被创建";
        $tradeDao->setAttributes($input, false);
        $res = $tradeDao->save(false);
        if ($res) {
            return ['code' => 0, 'msg' => 'ok'];
        } else {
            \Yii::info('add trade error.', __FUNCTION__);
            return ['code' => -1, 'msg' => 'add trade error.'];
        }

    }
}