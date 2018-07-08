<?php

/* @var $this yii\web\View */

use yii\bootstrap\SideNavWidget;
use yii\bootstrap\DatePicker;

$this->title = '财务管理系统';
?>

<div id="contents">

    <?= SideNavWidget::widget([
        'id'=>'fim-nav',
        'options' => [
            'navs' => [
                'bars' => $bars,
                'items' => $items,
            ]
        ],
    ]) ?>

</div>
