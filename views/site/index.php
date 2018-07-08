<?php

/* @var $this yii\web\View */

use yii\bootstrap\SideNavWidget;
use yii\helpers\Html;

$this->title = '进销存系统';
?>

<div id="contents">
    <?= SideNavWidget::widget([
        'id'=>'index-nav',
        'options' => [
            'navs' => [
                'bars' => $bars,
                'items' => $items,
            ]
        ],
    ]) ?>

    <div id="index-contents" class="p_contents">
        <?php
            //echo $this->render('trade-query');
        ?>
    </div>

</div>