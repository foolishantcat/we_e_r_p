<?php

/* @var $this yii\web\View */

use yii\bootstrap\SideNavWidget;
use yii\helpers\Html;

$this->title = '进销存系统';
?>

<div id="contents" class="container" style="width: 100%; height: 100%;">
    <div class="row" style="width: 100%; height: 100%;">
        <div class="p_navs col-md-1 column">
            <?= SideNavWidget::widget([
                'id'=>'index-nav',
                'options' => [
                    'navs' => [
                        'bars' => $bars,
                        'items' => $items,
                    ]
                ],
            ]) ?>
        </div>
        <div id="index-contents" class="p_contents col-md-11 column pre-scrollable">
            空页面
        </div>
    </div>
</div>
