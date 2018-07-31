<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-18 20:10:54
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-31 10:15:05
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

class PurchController extends Controller
{
    //----------测试用-----------------------
    public function actionPurchGoods()
    {
        $request = Yii::$app->request;
        $id = Yii::$app->user->id;
        $isGuest = Yii::$app->user->isGuest;
        if ($isGuest) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $ret = [
                'code' => -1,
                'msg' => '未登录，请先登录',
            ];
            return $ret;
        }
        if ($request->isAjax) {
            // 用于测试显示界面(这里需要修改)
            if ($request->isGet) {
                // ==============这里需要替换数据=======================
                $data = [
                    "goods_info" => [
                        [
                            'goods_id' => 'B123',
                            'goods_name' => '苹果',
                            'kind' => '食品',
                            'detail' => '山东水晶红富士',
                            'type' => '未上架',
                            'handler' => '义成',
                            'start_time' => '2018-07-27 00:00:00',
                            'update_time' => '2018-07-27 00:00:00',
                            'status' => '正常',
                        ],
                        [
                            'goods_id' => 'B456',
                            'goods_name' => '铅笔',
                            'kind' => '文具',
                            'detail' => '日本进口',
                            'type' => '已上架',
                            'handler' => '义成',
                            'start_time' => '2018-07-27 00:00:00',
                            'update_time' => '2018-07-27 00:00:00',
                            'status' => '正常',
                        ]
                    ],
                ];
                return $this->renderAjax('purch-goods', $data);
            } elseif ($request->isPost) {
                // 订单详情界面上传的数据
                $action = $request->post('action');
                if ($action === 'new_goods') {  // 新建订单动作
                    $goods_name = $request->post('goods_name');
                    $kind = $request->post('kind');
                    $type = $request->post('type');
                    // 插入数据库前，需要后台判断当前用户是谁，获取用户名
                    $handler = '义成';
                    // 插入数据库钱，需要根据后台获取当前时间，新建订单则更新start_time、update_time字段
                    $start_time = '2018-07-27 00:00:00';
                    $status = $request->post('status');
                    $detail = $request->post('detail');
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    //============后端替换数据=========================
                    $ret = [
                        'code' => 0,
                        'data' => [
                            'goods_id' => 999,  // ======这里写死用于测试新插入
                            'goods_name' => $goods_name,
                            'kind' => $kind,
                            'detail' => $detail,
                            'type' => $type,
                            'handler' => $handler,
                            'start_time' => $start_time,
                            'update_date' => $start_time,
                            'status' => $status,
                        ],
                    ];
                    //================================================
                    return $ret;
                } elseif ($action === 'search_goods') { // 搜索订单提交
                    //========需要后期替换数据==============
                    $search_test = [
                        'goods_id' => 'B99999',
                        'goods_name' => '横幅',
                        'kind' => '文具',
                        'detail' => '端午节活动筹备',
                        'type' => '已上架',
                        'handler' => '义成',
                        'start_time' => '2018-07-27 00:00:00',
                        'update_time' => '2018-07-27 00:00:00',
                        'status' => '正常',
                    ];
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $data = [
                        'code' => 0,
                        'data' => [
                            $search_test,
                        ],
                    ];
                    return $data;
                } elseif ($action === 'commit_handle') {
                    $goods_id = $request->post('goods_id');
                    $handle = $request->post('handle');
                    // =============此处按照提交的handle动作，去判定应该执行什么动作
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $ret = [
                        'code' => 0,
                        'data' => "$goods_id" . "$handle",
                    ];
                    return $ret;
                } else {
                    return '未知的请求动作';
                }
            } else {
                return '未知的请求类型';
            }
        } else {
            return $this->render('welcome');
        }
    }

    /*
    * CAUTION: 需要新建一张表offices存储办公设备信息---------<<<<<<<<<
     */
    public function actionPurchOffice()
    {
        $request = Yii::$app->request;
        $id = Yii::$app->user->id;
        $isGuest = Yii::$app->user->isGuest;
        if ($isGuest) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $ret = [
                'code' => -1,
                'msg' => '未登录，请先登录',
            ];
            return $ret;
        }
        if ($request->isAjax) {
            // 用于测试显示界面(这里需要修改)
            if ($request->isGet) {
                // ==============这里需要替换数据=======================
                $data = [
                    "office_info" => [
                        [
                            'office_id' => 'B123',
                            'office_name' => '苹果',
                            'kind' => '食品',
                            'attr' => '消耗品',
                            'detail' => '山东水晶红富士',
                            'handler' => '义成',
                            'start_time' => '2018-07-27 00:00:00',
                            'update_time' => '2018-07-27 00:00:00',
                            'status' => '正常',
                        ],
                        [
                            'office_id' => 'B456',
                            'office_name' => '铅笔',
                            'kind' => '文具',
                            'attr' => '非固定资产',
                            'detail' => '日本进口',
                            'handler' => '义成',
                            'start_time' => '2018-07-27 00:00:00',
                            'update_time' => '2018-07-27 00:00:00',
                            'status' => '正常',
                        ]
                    ],
                ];
                return $this->renderAjax('purch-office', $data);
            } elseif ($request->isPost) {
                // 订单详情界面上传的数据
                $action = $request->post('action');
                if ($action === 'new_office') {  // 新建订单动作
                    $goods_name = $request->post('office_name');
                    $kind = $request->post('kind');
                    $attr = $request->post('attr');
                    // 插入数据库前，需要后台判断当前用户是谁，获取用户名
                    $handler = '义成';
                    // 插入数据库钱，需要根据后台获取当前时间，新建订单则更新start_time、update_time字段
                    $start_time = '2018-07-27 00:00:00';
                    $status = '正常';
                    $detail = $request->post('detail');
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    //============后端替换数据=========================
                    $ret = [
                        'code' => 0,
                        'data' => [
                            'office_id' => 999,  // ======这里写死用于测试新插入
                            'office_name' => $goods_name,
                            'kind' => $kind,
                            'attr' => $attr,
                            'detail' => $detail,
                            'handler' => $handler,
                            'start_time' => $start_time,
                            'update_time' => $start_time,
                            'status' => $status,
                        ],
                    ];
                    //================================================
                    return $ret;
                } elseif ($action === 'search_office') { // 搜索订单提交
                    //========需要后期替换数据==============
                    $search_test = [
                        'office_id' => 'B99999',
                        'office_name' => '桃子',
                        'kind' => '食品',
                        'attr' => '消耗品',
                        'detail' => '生日会准备',
                        'handler' => '义成',
                        'start_time' => '2018-07-27 00:00:00',
                        'update_time' => '2018-07-27 00:00:00',
                        'status' => '正常'
                    ];
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $data = [
                        'code' => 0,
                        'data' => [$search_test, ],
                    ];
                    return $data;
                } elseif ($action === 'commit_handle') {
                    $office_id = $request->post('office_id');
                    $handle = $request->post('handle');
                    // =============此处按照提交的handle动作，去判定应该执行什么动作
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $ret = [
                        'code' => 0,
                        'data' => "$office_id" . "$handle",
                    ];
                    return $ret;
                } else {
                    return '未知的请求动作';
                }
            } else {
                return '未知的请求类型';
            }
        } else {
            return $this->render('welcome');
        }
    }
    // ------------------测试用-----------------
}
