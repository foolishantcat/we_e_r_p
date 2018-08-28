<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-18 20:15:49
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-08-28 21:54:50
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
    // 仓库信息
    public function actionReperInfo()
    {
        return $data = $this->renderAjax('reper-info');
    }

    // 库存信息
    public function actionSupplyInfo()
    {
        return $data = $this->renderAjax('supply-info');
    }
}
