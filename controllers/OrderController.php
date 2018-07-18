<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-18 19:59:03
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-18 21:46:14
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
        $request = Yii::$app->request;
        $id = Yii::$app->user->id;
        $isGuest = Yii::$app->user->isGuest;
        if ($isGuest) {
            return '请先登录';
        }
        if ($request->isAjax) {
            // 用于测试显示界面(这里需要修改)
            if ($request->isGet) {
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
            } elseif ($request->isPost) {
                // 新建订单上传的数据
                $title = $request->post('title');
                $customer_name = $request->post('customer_name');
                $goods_id = $request->post('goods_id');
                $goods_name = $request->post('goods_name');
                $goods_count = $request->post('goods_count');
                $logid_info = $request->post('logid_info');
                $ret = "$title"."$customer_name"."$goods_id"."$goods_name"."$goods_name"."$goods_count"."$logid_info";
                //此处返回一个字符串给前端（测试用,后期可删）
                return $ret;
            } else {
                return '未知的请求类型';
            }
        } else {
            $options = [];
            return $this->render('welcome');
        }

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
