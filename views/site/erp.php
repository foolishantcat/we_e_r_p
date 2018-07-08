<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\SideNavWidget;

$this->title = 'ERP';
?>

<div id="contents">

    <?= SideNavWidget::widget([
        'id'=>'erp-nav',
        'options' => [
            'navs' => [
                'bars' => $bars,
                'items' => $items,
            ]
        ],
    ]) ?>

</div>
