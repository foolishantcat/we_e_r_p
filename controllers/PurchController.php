<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-18 20:10:54
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-08-21 20:44:32
 */

namespace app\controllers;

use app\service\goods\GoodsService;
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
        $isGuest = Yii::$app->user->isGuest;
        if ($isGuest) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $ret = [
                'code' => -1,
                'msg' => '未登录，请先登录',
            ];
            return $ret;
        }
        $service = new GoodsService();
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
                $data = $service->getGoodsInfo($input);
                return $this->renderAjax('purch-goods',
                    [
                        'goods_info' => $data
                    ]
                );
            } elseif ($request->isPost) {
                // 订单详情界面上传的数据
                $action = $request->post('action');
                if ($action === 'new_goods') {  // 新建订单动作
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $input = $this->R();
                    $ret = $service->addGoods($input);
                    return $ret;
                } elseif ($action === 'search_goods') { // 搜索订单提交
                    //========需要后期替换数据==============
                    $input = $this->R();
                    $page = $this->R('page');
                    $rows = $this->R('rows');
                    if (!$page) {
                        $input['page'] = 1;
                    }
                    if (!$rows) {
                        $input['rows'] = 50;
                    }
                    $data = $service->getGoodsInfo($input);
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    $data = [
                        'code' => 0,
                        'data' => $data,
                        'page' => $page,
                        'rows' => $rows
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
                        'data' => [$search_test,],
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

    public function actionPurchList()
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
                    "purch_info" => [
                        [
                            'purch_type' => '商品物料',
                            'purch_id' => 'P123',
                            'title' => '国庆节采购苹果计划',
                            'goods_id' => 'B123',
                            'goods_name' => '苹果',
                            'kind' => '水果',
                            'counts' => 100,
                            'unit_price' => 8,
                            'amountofmoney' => 85,
                            'use' => '国庆节公司发放福利',
                            'process' => '财务审批中',
                            'repertory' => '',
                            'proposer' => '义成',
                            'approver' => '凯波',
                            'financer' => '张飞',
                            'purchaser' => 'dd',
                            'start_time' => '2018-07-27 00:00:00',
                            'update_time' => '2018-07-27 00:00:00',
                            'status' => '正常',
                        ],
                        [
                            'purch_type' => '办公设备',
                            'purch_id' => 'P456',
                            'title' => '苹果电脑采购',
                            'goods_id' => 'D123',
                            'goods_name' => 'Mac笔记本',
                            'kind' => '电子设备',
                            'counts' => 1,
                            'unit_price' => 10000,
                            'amountofmoney' => 10000,
                            'use' => '总经理办公室使用',
                            'process' => '审批不通过',
                            'repertory' => '',
                            'proposer' => '义成',
                            'approver' => '凯波',
                            'financer' => '张飞',
                            'purchaser' => 'dd',
                            'start_time' => '2018-07-27 00:00:00',
                            'update_time' => '2018-07-27 00:00:00',
                            'status' => '正常',
                        ],
                    ],
                    // 新增仓库选择(一般来说只需要返回一次即可)
                    "reper_info" => [
                        "1" => "无锡仓库",
                        "2" => "北京仓库",
                        "3" => "广州仓库",
                    ],
                ];
                return $this->renderAjax('purch-list', $data);
            } elseif ($request->isPost) {
                $action = $request->post('action');
                if ($action === 'search_purch') {  // 搜索采购单
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
                } elseif ($action === 'modify_purch') { // 修改采购单
                    //========需要后期替换数据==============
                    $purch_id = $request->post('purch_id');
                    // 用于测试“修改过后的数据”
                    $search_test = [
                            'purch_type' => '办公设备',
                            'purch_id' => $purch_id,    // purch_id一定要原样返回
                            'title' => '修改过后的数据',
                            'goods_id' => 'D123',
                            'goods_name' => 'Mac笔记本',
                            'kind' => '电子设备',
                            'counts' => 1,
                            'unit_price' => 10000,
                            'amountofmoney' => 10000,
                            'use' => '总经理办公室使用',
                            'process' => '审批不通过',
                            'repertory' => '',
                            'proposer' => '义成',
                            'approver' => '凯波',
                            'financer' => '张飞',
                            'purchaser' => 'dd',
                            'start_time' => '2018-07-27 00:00:00',
                            'update_time' => '2018-07-27 00:00:00',
                            'status' => '正常',
                    ];
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    // 这里需要返回修改后的数据给前端
                    $data = [
                        'code' => 0,
                        'data' => [$search_test,],
                    ];
                    return $data;
                } elseif ($action === 'delete_purch') {     // 删除采购订单
                    $purch_id = $request->post('purch_id');
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    // 此处返回删除的状态即可
                    $ret = [
                        'code' => 0,
                        'data' => "",
                    ];
                    return $ret;
                } elseif ($action === 'ask_put_in') {   // 请求入库操作
                    $purch_id = $request->post('purch_id');
                    $repertory = $request->post('repertory');
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    // 请求入库失败，需要返回msg
                    $ret = [
                        'code' => 0,
                        'data' => "",
                    ];
                    return $ret;
                }
                else {
                    return '未知的请求动作';
                }
            } else {
                return '未知的请求类型';
            }
        } else {
            return $this->render('welcome');
        }
    }
}
