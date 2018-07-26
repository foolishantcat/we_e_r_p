<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-18 19:59:03
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-18 22:57:38
 */

namespace app\controllers;

use app\service\order\OrderService;
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
        $orderService = new OrderService();
        if ($request->isAjax) {
            // 用于测试显示界面(这里需要修改)
            if ($request->isGet) {
                $page = $this->R('page');
                $rows = $this->R('rows');
                if (!$page) {
                    $page = 1;
                }
                if (!$rows) {
                    $rows = 50;
                }
                $input = [
                    'page' => $page,
                    'rows' => $rows
                ];
                $order_info = $orderService->getOrdersInfo($input);
                return $data = $this->renderAjax('order-info',
                    [
                        "order_info" => $order_info['data'],
                    ]);
            } elseif ($request->isPost) {
                // 订单详情界面上传的数据
                $action = $request->post('action');
                if ($action === 'new_order') {  // 新建订单动作
                    $input = $this->R();
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $res = $orderService->addOrders($input);
                    //此处返回一个字符串给前端（测试用,后期可删）
                    return $res;
                } elseif ($action === 'search_order') { // 搜索订单提交

                    //测试，提供返回数据给前端处理（例如更新界面）
                    $input = $this->R();
                    if (!$this->R('page')) {
                        $input['page'] = 1;
                    }
                    if (!$this->R('rows')) {
                        $input['rows'] = 50;
                    }
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $order_info = $orderService->getOrdersInfo($input);
                    return $order_info;
                } elseif ($action === 'commit_handle') {
                    $order_id = $request->post('order_id');
                    $handle = $request->post('handle');
                    // 返回值
                    $ret = "$order_id" . "$handle";
                    return $ret;
                }

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
