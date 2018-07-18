<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-18 19:59:03
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-18 20:42:39
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
        return $data = $this->renderAjax('order-rank');
    }
    // ------------------测试用-----------------
}
