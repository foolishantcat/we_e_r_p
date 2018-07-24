<?php

/* @var $this yii\web\View */

use yii\bootstrap\SideNavWidget;
use yii\helpers\Html;

$this->title = '进销存系统';
?>

<div id="contents" class="container" style="width: 100%; height: 100%;">
    <div id= "p_row" class="row">
        <div id="p_navs" class="col-md-2 column">
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
        <div id="p_contents" class="col-md-10 column">
            空页面
        </div>
    </div>
</div>
