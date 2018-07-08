<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\SideNavWidget;

$this->title = '客户关系管理';
?>

<div id="contents">

    <?= SideNavWidget::widget([
        'id'=>'crm-nav',
        'options' => [
            'navs' => [
                'bars' => $bars,
                'items' => $items,
            ]
        ],
    ]) ?>

    <div id="crm-contents" class="p_contents">
        <li>
            "heheda"
        </li>
    </div>

</div>

