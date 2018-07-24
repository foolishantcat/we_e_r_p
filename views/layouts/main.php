<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\web\User;

// 临时设置中国时区
date_default_timezone_set('PRC');
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    //此处判断是否登录，登录的话判断当前用户是否有权限以决定显示界面不同
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => '进销存系统', 'url' => ['/site/index']],
            ['label' => '客户管理', 'url' => ['/site/crm']],
            ['label' => '财务管理', 'url' => ['/site/fim']],
            ['label' => 'ERP', 'url' => ['/site/erp']],
            ['label' => '公司管理', 'url' => ['/site/company-mgr']],
            Yii::$app->user->isGuest ? (
                ['label' => '登录', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '注销 (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; 烽火戏诸侯 <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>

<?php //必须放在jquery.js后面才能生效 ?>
<script>
var req = new XMLHttpRequest();
function refresh_contents(obj) {
    //alert("hehehe: " + obj.value);
    var r_view = obj.value;
    //目前只支持index.php
    var r_url = "index.php?r=" + r_view;
    console.log(r_url);
    //根据表的信息，获取对应数据填充(使用ajax？).
    $.ajax({
        type: 'GET',
        url: r_url,
        dataType: 'HTML',
        success: function (data) {
            $("#p_contents").html(data);
        },
        error: function(data) {
            console.log('Error: ' + data);
        }
    });
}
</script>
</html>
<?php $this->endPage() ?>
