<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-18 19:59:03
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-26 21:14:46
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
                } else {
                    return '未知的请求动作';
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
        $request = Yii::$app->request;
        $id = Yii::$app->user->id;
        $isGuest = Yii::$app->user->isGuest;
        if ($isGuest) {
            return '请先登录';
        }
        $service = new OrderService();
        if ($request->isAjax) {
            // 用于测试显示界面(这里需要修改)
            if ($request->isGet) {
                $data = $service->getOrderRank();
                return $data = $this->renderAjax('order-rank', $data['data']);
            } elseif ($request->isPost) {
                $action = $request->post('action');
                if ($action === 'search_rank') {
                    $staff_name = $request->post('staff_name');
                    $staff_id = $request->post('staff_id');
                    // 这里需要根据传入的条件进行数据库查询和筛选 (待修改)
                    // 最后返回的结果如下所示
                    $data = $service->getRankInfo(['staff_id' => $staff_id, 'staff_name' => $staff_name]);
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return $data;
                } else {
                    return '未知的请求动作';
                }
            } else {
                return '未知的请求类型';
            }
        } else {
            $options = [];
            return $this->render('welcome');
        }
    }
}
