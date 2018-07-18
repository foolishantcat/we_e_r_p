<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-18 20:15:49
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-18 20:18:22
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

class ReperController extends Controller
{
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
}
