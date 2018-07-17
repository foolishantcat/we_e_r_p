<?php

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

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionEntry()
    {
        $model = new EntryForm;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // ...
            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            //...
            return $this->render('entry', ['model' => $model]);
        }
    }

    /*
     * Add By caoyicheng
     */
    public function actionSay($message = 'Hellow')
    {
        return $this->render('say', ['message' => $message]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // 从数据库读取导航栏数据
        $bars = Yii::$app->db->createCommand("SELECT * from nav where catalog_id = '进销存系统' and level = 'bar' order by seq_num")->queryAll();
        $items = Yii::$app->db->createCommand("SELECT * from nav where catalog_id = '进销存系统' and level = 'item'")->queryAll();
        // 这里最好处理一下导航栏数据，再传入渲染，这样子速度更快
        return $this->render(
            'index',
            [
                'bars' => $bars,
                'items' => $items
            ]
        );
    }

    //----------测试用-----------------------
    public function actionOrderInfo()
    {
        return $data = $this->renderAjax('order-info');
    }

    public function actionOrderRank()
    {
        return $data = $this->renderAjax('order-rank');
    }
    // ------------------测试用-----------------


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function genUniqueTimeId()
    {
        $str_id = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        return $str_id;
    }

    public function genUniqueSha1Id()
    {
        $data = $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']
        .time() . rand();
        return sha1($data);
    }

    /**
     * 查询交易信息.
     *
     * @return string
     */
    public function actionTradeQuery()
    {
        $request = Yii::$app->request;
        $id = Yii::$app->user->id;
        $isGuest = Yii::$app->user->isGuest;
        if ($isGuest) {
            return '请先登录';
        }
        // Ajax请求
        if ($request->isAjax) {
            if ($request->isGet) {
                $query = Yii::$app->db->createCommand("SELECT * from trade order by update_time desc limit 50")->queryAll();
                $data = $this->renderAjax('trade-query', [
                    'trade_info' => $query,
                ]);
                return $data;
            } elseif ($request->isPost) {
                // 这里添加插入数据库的操作
                $title = $request->post('title');
                $customer_id = $request->post('customer_id');
                $project_id = $request->post('project_id');
                $order_id = $request->post('order_id');
                $detail = $request->post('detail');
                //生成随机id
                $trade_id = $this->genUniqueTimeId();
                $start_time = date('Y-m-d h:i:s', time());
                $status = "订单被创建";
                $dealer = $id;
                $handler = $id;
                Yii::$app->db->createCommand()->insert('trade', [
                    'trade_id' => $trade_id,
                    'title' => $title,
                    'customer_id' => $customer_id,
                    'project_id' => $project_id,
                    'order_id' => $order_id,
                    'dealer' => $dealer,
                    'handler' => $handler,
                    'detail' => $detail,
                    'start_time' => $start_time,
                    'update_time' => $start_time,
                    'status' => $status,
                ])->execute();
            } else {
                return '未知的请求类型';
            }
        } else {
            $options = [];
            return $this->render('welcome');
        }
    }

    /**
     * 查询订单信息.
     *
     * @return string
     */
    function actionOrderQuery()
    {
        $request = Yii::$app->request;
        $id = Yii::$app->user->id;
        $isGuest = Yii::$app->user->isGuest;
        if ($isGuest) {
            return '请先登录';
        }
        // Ajax请求
        if ($request->isAjax) {
            if ($request->isGet) {
                $query = Yii::$app->db->createCommand("SELECT * from orders order by update_time desc limit 50")->queryAll();
                $data = $this->renderAjax('order-query', [
                    'order_info' => $query,
                ]);
                return $data;
            } elseif ($request->isPost) {
                // 这里添加插入数据库的操作
                $title = $request->post('title');
                $customer_id = $request->post('customer_id');
                $project_id = $request->post('project_id');
                $order_id = $request->post('order_id');
                $detail = $request->post('detail');
                //生成随机id
                $trade_id = $this->genUniqueTimeId();
                $start_time = date('Y-m-d h:i:s', time());
                $status = "订单被创建";
                $dealer = $id;
                $handler = $id;
                Yii::$app->db->createCommand()->insert('trade', [
                    'trade_id' => $trade_id,
                    'title' => $title,
                    'customer_id' => $customer_id,
                    'project_id' => $project_id,
                    'order_id' => $order_id,
                    'dealer' => $dealer,
                    'handler' => $handler,
                    'detail' => $detail,
                    'start_time' => $start_time,
                    'update_time' => $start_time,
                    'status' => $status,
                ])->execute();
            } else {
                return '未知的请求类型';
            }
        } else {
            $options = [];
            return $this->render('welcome');
        }
    }

    /**
     * 新增、查询采购订单.
     *
     * @return string
     */
    function actionPurchGoods()
    {
        $request = Yii::$app->request;
        $id = Yii::$app->user->id;
        $isGuest = Yii::$app->user->isGuest;
        if ($isGuest) {
            return '请先登录';
        }
        // Ajax请求
        if ($request->isAjax) {
            if ($request->isGet) {
                $query = Yii::$app->db->createCommand("SELECT * from purchase order by update_time desc limit 50")->queryAll();
                $data = $this->renderAjax('order-query', [
                    'order_info' => $query,
                ]);
                return $data;
            } elseif ($request->isPost) {
                // 这里添加插入数据库的操作
                $title = $request->post('title');
                $customer_id = $request->post('customer_id');
                $project_id = $request->post('project_id');
                $order_id = $request->post('order_id');
                $detail = $request->post('detail');
                //生成随机id
                $trade_id = $this->genUniqueTimeId();
                $start_time = date('Y-m-d h:i:s', time());
                $status = "订单被创建";
                $dealer = $id;
                $handler = $id;
                Yii::$app->db->createCommand()->insert('trade', [
                    'trade_id' => $trade_id,
                    'title' => $title,
                    'customer_id' => $customer_id,
                    'project_id' => $project_id,
                    'order_id' => $order_id,
                    'dealer' => $dealer,
                    'handler' => $handler,
                    'detail' => $detail,
                    'start_time' => $start_time,
                    'update_time' => $start_time,
                    'status' => $status,
                ])->execute();
            } else {
                return '未知的请求类型';
            }
        } else {
            $options = [];
            return $this->render('welcome');
        }
    }

    /**
     * 取得给定日期所在周的开始日期和结束日期
     * @param string $gdate 日期，默认为当天，格式：YYYY-MM-DD
     * @param int $weekStart 一周以星期一还是星期天开始，0为星期天，1为星期一
     * @return array 数组array( "开始日期 ",  "结束日期");
     */
    function getAWeekTimeSlot($gdate = '', $weekStart = 1) {
        if (! $gdate){
            $gdate = date("Y-m-d");
        }
        $w = date("w", strtotime($gdate)); //取得一周的第几天,星期天开始0-6
        $dn = $w ? $w - $weekStart : 6; //要减去的天数
        $st = date("Y-m-d", strtotime("$gdate  - " . $dn . "  days "));
        $en = date("Y-m-d", strtotime("$st  +6  days "));
        return array($st, $en); //返回开始和结束日期
    }

    /**
     * 取得给定日期所在周的开始日期和结束日期
     * @param string $gdate 日期，默认为当天，格式：YYYY-MM-DD
     * @param int $weekStart 一周以星期一还是星期天开始，0为星期天，1为星期一
     * @return array 数组array( "开始日期 ",  "结束日期");
     */
    function getTimeSlot($q)
    {
        $now = time();
        if ($q === 1) {// 今天
            $beginTime = date('Y-m-d 00:00:00', $now);
            $endTime = date('Y-m-d 23:59:59', $now);
        } elseif ($q === 2) {// 昨天
            $time = strtotime('-1 day', $now);
            $beginTime = date('Y-m-d 00:00:00', $time);
            $endTime = date('Y-m-d 23:59:59', $now);
        } elseif ($q === 3) {// 三天内
            $time = strtotime('-2 day', $now);
            $beginTime = date('Y-m-d 00:00:00', $time);
            $endTime = date('Y-m-d 23:59:59', $now);
        } elseif ($q === 4) {// 本周
            $time = '1' == date('w') ? strtotime('Monday', $now) : strtotime('last Monday', $now);
            $beginTime = date('Y-m-d 00:00:00', $time);
            $endTime = date('Y-m-d 23:59:59', strtotime('Sunday', $now));
        } elseif ($q === 5) {// 上周
            // 本周一
            $thisMonday = '1' == date('w') ? strtotime('Monday', $now) : strtotime('last Monday', $now);
            // 上周一
            $lastMonday = strtotime('-7 days', $thisMonday);
            $beginTime = date('Y-m-d 00:00:00', $lastMonday);
            $endTime = date('Y-m-d 23:59:59', strtotime('last sunday', $now));
        } elseif ($q === 6) {// 本月
            $beginTime = date('Y-m-d 00:00:00', mktime(0, 0, 0, date('m', $now), '1', date('Y', $now)));
            $endTime = date('Y-m-d 23:39:59', mktime(0, 0, 0, date('m', $now), date('t', $now), date('Y', $now)));
        } elseif ($q === 7) {// 三月内
            $time = strtotime('-2 month', $now);
            $beginTime = date('Y-m-d 00:00:00', mktime(0, 0,0, date('m', $time), 1, date('Y', $time)));
            $endTime = date('Y-m-d 23:39:59', mktime(0, 0, 0, date('m', $now), date('t', $now), date('Y', $now)));
        } elseif ($q === 8) {// 半年内
            $time = strtotime('-5 month', $now);
            $beginTime = date('Y-m-d 00:00:00', mktime(0, 0,0, date('m', $time), 1, date('Y', $time)));
            $endTime = date('Y-m-d 23:39:59', mktime(0, 0, 0, date('m', $now), date('t', $now), date('Y', $now)));
        }  elseif ($q === 9) {// 一年内
            $beginTime = date('Y-m-d 00:00:00', mktime(0, 0,0, 1, 1, date('Y', $now)));
            $endTime = date('Y-m-d 23:39:59', mktime(0, 0, 0, 12, 31, date('Y', $now)));
        } elseif ($q === 10) {// 三年内
            $time = strtotime('-2 year', $now);
            $beginTime = date('Y-m-d 00:00:00', mktime(0, 0, 0, 1, 1, date('Y', $time)));
            $endTime = date('Y-m-d 23:39:59', mktime(0, 0, 0, 12, 31, date('Y')));
        }

        return $arraySlot = array('beginTime' => $beginTime, 'endTime' => $endTime,);
    }

    /**
     * 查询交易榜单
     *
     * @return string
     */
    public function actionTradeRank()
    {
        $request = Yii::$app->request;
        $id = Yii::$app->user->id;
        $isGuest = Yii::$app->user->isGuest;
        if ($isGuest) {
            return '请先登录';
        }
        if ($request->isAjax) {
            if ($request->isGet) {
                $se_today = $this->getTimeSlot(1);
                $se_week = $this->getTimeSlot(4);
                $se_month = $this->getTimeSlot(6);
                $params = [
                    ':status' => "已成交",
                    ':begin' => $se_today['beginTime'],
                    ':end' => $se_today['endTime'],
                ];
                $sql = "SELECT handler, count(1) cnt, max(update_time) from orders where status = '已成交' and update_time >='" . $se_today['beginTime'] . "' and update_time <= '" . $se_today['endTime'] . "' group by handler order by cnt desc limit 10";
                $new_query = Yii::$app->db->createCommand($sql)->queryAll();
                $params = [
                    ':status' => "已成交",
                    ':begin' => $se_week['beginTime'],
                    ':end' => $se_week['endTime'],
                ];
                $sql = "SELECT handler, count(1) cnt, max(update_time) from orders where status = '已成交' and update_time >='" . $se_week['beginTime'] . "' and update_time <= '" . $se_week['endTime'] . "' group by handler order by cnt desc limit 10";
                $week_query = Yii::$app->db->createCommand($sql)->queryAll();
                $params = [
                    ':status' => "已成交",
                    ':begin' => $se_month['beginTime'],
                    ':end' => $se_month['endTime'],
                ];
                $sql = "SELECT handler, count(1) cnt, max(update_time) from orders where status = '已成交' and update_time >='" . $se_month['beginTime'] . "' and update_time <= '" . $se_month['endTime'] . "' group by handler order by cnt desc limit 10";
                $month_query = Yii::$app->db->createCommand($sql)->queryAll();
                $data = $this->renderAjax('trade-rank', [
                    'n_rank_info' => $new_query,
                    'w_rank_info' => $week_query,
                    'm_rank_info' => $month_query,
                    'order_info' => array(),
                ]);
                return $data;
            } elseif ($request->isPost) {
                # code...
                return '请凯波实现';
            } else {
                return '未知请求类型';
            }
        } else {
            return $this->render('welcome');
        }
    }

    /**
     * 分析交易信息.
     *
     * @return string
     */
    public function actionTradeAnalysis()
    {
        // 从数据库读取交易信息数据
        $query = Yii::$app->db->createCommand("SELECT * from trade")->queryAll();
        $request = Yii::$app->request;
        // Ajax请求
        if ($request->isAjax) {
            $data = $this->renderAjax('trade-analysis', [
                'trade_info' => $query,
            ]);
            return $data;
        } else {
            $options = [];
            return $this->render('welcome');
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionCrm()
    {
        $bars = Yii::$app->db->createCommand("SELECT * from nav where catalog_id = '客户管理系统' and level = 'bar' order by seq_num")->queryAll();
        $items = Yii::$app->db->createCommand("SELECT * from nav where catalog_id = '客户管理系统' and level = 'item'")->queryAll();
        $options = [
            'bars' => $bars,
            'items' => $items
        ];
        // 这里最好处理一下导航栏数据，再传入渲染，这样子速度更快
        return $this->render('crm', $options);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionFim()
    {
        $bars = Yii::$app->db->createCommand("SELECT * from nav where catalog_id = '财务管理系统' and level = 'bar' order by seq_num")->queryAll();
        $items = Yii::$app->db->createCommand("SELECT * from nav where catalog_id = '财务管理系统' and level = 'item'")->queryAll();
        $options = [
            'bars' => $bars,
            'items' => $items
        ];
        // 这里最好处理一下导航栏数据，再传入渲染，这样子速度更快
        return $this->render('fim', $options);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionErp()
    {
        $bars = Yii::$app->db->createCommand("SELECT * from nav where catalog_id = 'ERP' and level = 'bar' order by seq_num")->queryAll();
        $items = Yii::$app->db->createCommand("SELECT * from nav where catalog_id = 'ERP' and level = 'item'")->queryAll();
        $options = [
            'bars' => $bars,
            'items' => $items
        ];
        // 这里最好处理一下导航栏数据，再传入渲染，这样子速度更快
        return $this->render('erp', $options);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionCompanyMgr()
    {
        $bars = Yii::$app->db->createCommand("SELECT * from nav where catalog_id = '公司管理' and level = 'bar' order by seq_num")->queryAll();
        $items = Yii::$app->db->createCommand("SELECT * from nav where catalog_id = '公司管理' and level = 'item'")->queryAll();
        $options = [
            'bars' => $bars,
            'items' => $items
        ];
        // 这里最好处理一下导航栏数据，再传入渲染，这样子速度更快
        return $this->render('company-mgr', $options);
    }

    public function actionTest2()
    {
        $request = Yii::$app->request;
        // Ajax请求
        if ($request->isAjax) {
            $data = $this->renderAjax('test2');
            return $data;
        } else {
            $options = [];
            return $this->render('test2', $options);
        }
    }

    public function actionProject()
    {
        //从数据库查找数据
        $bars = Yii::$app->db->createCommand("SELECT * from nav where catalog_id = 'ERP' and level = 'bar' order by seq_num")->queryAll();
        $request = Yii::$app->request;
        // Ajax请求
        if ($request->isAjax) {
            $data = $this->renderAjax('project');
            return $data;
        } else {
            $options = [];
            return $this->render('project', $options);
        }
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {

    }
}
