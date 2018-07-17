<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-06 20:09:47
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-09 21:31:57
 */
?>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-4 column">
            <span class="label label-success">New</span>
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>排名</th>
                        <th>姓名</th>
                        <th>成交量</th>
                        <th>最新成交时间</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rank = 1;
                    foreach ($n_rank_info as $info) {
                        echo "<tr>";
                        echo "<td>";
                        echo $rank;
                        echo "</td>";
                        foreach ($info as $k=>$v) {
                            echo "<td>";
                            echo $v."<br/>";
                            echo "</td>";
                        }
                        echo "</tr>";
                        $rank = $rank + 1;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-4 column">
            <span class="label label-info">周</span>
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>排名</th>
                        <th>姓名</th>
                        <th>成交量</th>
                        <th>最新成交时间</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rank = 1;
                    foreach ($w_rank_info as $info) {
                        echo "<tr>";
                        echo "<td>";
                        echo $rank;
                        echo "</td>";
                        foreach ($info as $k=>$v) {
                            echo "<td>";
                            echo $v."<br/>";
                            echo "</td>";
                        }
                        echo "</tr>";
                        $rank = $rank + 1;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-4 column">
            <span class="label label-warning">月</span>
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>排名</th>
                        <th>姓名</th>
                        <th>成交量</th>
                        <th>最新成交时间</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rank = 1;
                    foreach ($m_rank_info as $info) {
                        echo "<tr>";
                        echo "<td>";
                        echo $rank;
                        echo "</td>";
                        foreach ($info as $k=>$v) {
                            echo "<td>";
                            echo $v."<br/>";
                            echo "</td>";
                        }
                        echo "</tr>";
                        $rank = $rank + 1;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <!-- 查询成交量组框 -->
            <form class="bs-example bs-example-form" role="form">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">员工姓名</span>
                    <input type="text" class="form-control" placeholder="twitterhandle">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">员工编号</span>
                    <input type="text" class="form-control" placeholder="twitterhandle">
                </div>
                <div>
                    <button id="bt-search" class="btn btn-success" type="button" onclick="search_trade_info()">
                        搜索排名
                    </button>
                    <label for="bt-search">填一个或者两个</label>
                </div>
            </form>
        </div>
    </div>
    <!-- 展示信息用的表格 -->
    <table id="orders-info" class="table table-striped">
        <thead>
        <tr>
            <th>员工姓名</th>
            <th>总交易量</th>
            <th>总成交量</th>
            <th>最近交易时间</th>
            <th>最近成交时间</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($order_info as $info) {
            echo "<tr>";
            $num = count($info);
            foreach ($info as $k=>$v) {
                echo "<td>";
                echo $v."<br/>";
                echo "</td>";
            }
            echo "</tr>";
        }
        ?>
        </tbody>
</div>

<script>
var req = new XMLHttpRequest();
function search_trade_info() {
    alert("点击了搜索交易");
}

function refresh_rank() {
    alert("点击了刷新榜单");
}
</script>
