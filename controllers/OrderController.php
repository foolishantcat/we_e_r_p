<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-18 19:59:03
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-18 21:06:18
 */

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\CrmForm;
use app\models\EntryForm;
use yii\data\Pagination;
use yii\db\Query;

class OrderController extends Controller
{
    //----------测试用-----------------------
    public function actionOrderInfo()
    {
        $order_info = [
            [
                "order_id" => "1",
                "type" => "销售订单",
                "title" => "巨凯波的苹果订单",
                "customer_id" => "B123",
                "good_id" => "PG124",
                "good_count" => 100,
                "logid_info" => "广东省广州市天河区",
                "handler" => "义成",
                "start_time" => "2018-07-12 10:20:00",
                "update_time" => "2018-07-12 10:20:00",
                "end_time" => "2018-07-12 10:20:00",
                "status" => "已成交",
            ],
            [
                "order_id" => "2",
                "type" => "销售订单",
                "title" => "曹义成的香蕉订单",
                "customer_id" => "B456",
                "good_id" => "XJ234",
                "good_count" => 1000,
                "logid_info" => "广东省广州市增城区",
                "handler" => "凯波",
                "start_time" => "2018-07-12 10:20:00",
                "update_time" => "2018-07-12 10:20:00",
                "end_time" => "2018-07-12 10:20:00",
                "status" => "退货中",
            ],
        ];
        return $data = $this->renderAjax('order-info',
            [
                "order_info" => $order_info,
            ]);
    }

    public function actionOrderRank()
    {
        // 最新排名（当日排名）
        $d_order_rank = [
            [
                "rank" => "1",
                "handler" => "义成",
                "deal_count" => 1000,
                "nearest_deal_time" => "2018-07-12 10:20:00",
            ],
            [
                "rank" => "2",
                "handler" => "凯波",
                "deal_count" => 900,
                "nearest_deal_time" => "2018-07-12 10:20:00",
            ]
        ];
        // 本周排名（计算本周、本月日期起止时间的函数，我已经写过了，你可以抄）
        $w_order_rank = [
            [
                "rank" => "1",
                "handler" => "玉州",
                "deal_count" => 10000,
                "nearest_deal_time" => "2018-07-12 10:20:00",
            ],
            [
                "rank" => "2",
                "handler" => "凯波",
                "deal_count" => 9000,
                "nearest_deal_time" => "2018-07-12 10:20:00",
            ]
        ];
        // 本月排名
        $m_order_rank = [
            [
                "rank" => "1",
                "handler" => "玉州",
                "deal_count" => 10000,
                "nearest_deal_time" => "2018-07-12 10:20:00",
            ],
            [
                "rank" => "2",
                "handler" => "凯波",
                "deal_count" => 9000,
                "nearest_deal_time" => "2018-07-12 10:20:00",
            ],
            [
                "rank" => "3",
                "handler" => "胖大星",
                "deal_count" => 5000,
                "nearest_deal_time" => "2018-07-12 10:20:00",
            ]
        ];
        return $data = $this->renderAjax('order-rank', [
            "d_order_rank" => $d_order_rank,
            "w_order_rank" => $w_order_rank,
            "m_order_rank" => $m_order_rank,
        ]);
    }
    // ------------------测试用-----------------
}
