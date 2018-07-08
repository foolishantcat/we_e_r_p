<?php
/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-02 21:24:04
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-02 21:37:00
 */
use yii\helpers\Html;
use yii\bootstrap\SideNavWidget;

$this->title = '公司管理';
?>

<div id="contents">

    <?= SideNavWidget::widget([
        'id'=>'cmgr-nav',
        'options' => [
            'navs' => [
                'bars' => $bars,
                'items' => $items,
            ]
        ],
    ]) ?>

    <div id="cmgr-contents" class="p_contents">
        <li>
            "heheda"
        </li>
    </div>

</div>
