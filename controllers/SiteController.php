<?php

namespace app\controllers;

use app\service\nav\NavService;
use app\service\trade\TradeService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\EntryForm;

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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // 从数据库读取导航栏数据
        $pageData = (new NavService())->getNavInfo();
        // 这里最好处理一下导航栏数据，再传入渲染，这样子速度更快
        return $this->render(
            'index',
            $pageData
        );
    }



    /**
     * 查询交易信息.
     *
     * @return string
     */
    public function actionTradeQuery()
    {
        $request = Yii::$app->request;
        $accessID = Yii::$app->user->id;
        $isGuest = Yii::$app->user->isGuest;
        if ($isGuest) {
            return '请先登录';
        }
        $service = new TradeService();
        // Ajax请求
        if ($request->isAjax) {
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
                $tradeData = $service->getTrade($input);
                $data = $this->renderAjax('trade-query', [
                    'trade_info' => $tradeData,
                    'page' => $page,
                    'rows' => $rows
                ]);
                return $data;
            } elseif ($request->isPost) {
                // 这里添加插入数据库的操作
                $title = $this->R('title');
                $customer_id = $this->R('customer_id');
                $project_id = $this->R('project_id');
                $order_id = $this->R('order_id');
                $detail = $this->R('detail');

                $start_time = date('Y-m-d h:i:s', time());

                $dealer = $accessID;
                $handler = $accessID;
                $data = $service->addTrade([
                    'title' => $title,
                    'customer_id' => $customer_id,
                    'project_id' => $project_id,
                    'order_id' => $order_id,
                    'dealer' => $dealer,
                    'handler' => $handler,
                    'detail' => $detail,
                    'start_time' => $start_time,
                    'update_time' => $start_time,
                ]);
                $data = $this->renderAjax('trade-query', [
                    'data' => $data,
                ]);
                return $data;
            } else {
                return '未知的请求类型';
            }
        } else {
            $options = [];
            return $this->render('welcome');
        }
    }
}
