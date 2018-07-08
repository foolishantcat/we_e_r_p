<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-06 20:09:47
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-07 20:16:06
 */
?>
<div class="container">
    <button type="button" class="btn btn-default btn-primary">刷新榜单</button>
    <div class="row clearfix">
        <div class="col-md-4 column">
            <span class="label label-success">New</span>
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>编号</th>
                        <th>产品</th>
                        <th>交付时间</th>
                        <th>状态</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($m_rank_info as $info) {
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
            </table>
        </div>
        <div class="col-md-4 column">
             <span class="label label-info">周</span>
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>
                            编号
                        </th>
                        <th>
                            产品
                        </th>
                        <th>
                            交付时间
                        </th>
                        <th>
                            状态
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            01/04/2012
                        </td>
                        <td>
                            Default
                        </td>
                    </tr>
                    <tr class="success">
                        <td>
                            1
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            01/04/2012
                        </td>
                        <td>
                            Approved
                        </td>
                    </tr>
                    <tr class="error">
                        <td>
                            2
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            02/04/2012
                        </td>
                        <td>
                            Declined
                        </td>
                    </tr>
                    <tr class="warning">
                        <td>
                            3
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            03/04/2012
                        </td>
                        <td>
                            Pending
                        </td>
                    </tr>
                    <tr class="info">
                        <td>
                            4
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            04/04/2012
                        </td>
                        <td>
                            Call in to confirm
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4 column">
             <span class="label label-warning">月</span>
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>
                            编号
                        </th>
                        <th>
                            产品
                        </th>
                        <th>
                            交付时间
                        </th>
                        <th>
                            状态
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            01/04/2012
                        </td>
                        <td>
                            Default
                        </td>
                    </tr>
                    <tr class="success">
                        <td>
                            1
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            01/04/2012
                        </td>
                        <td>
                            Approved
                        </td>
                    </tr>
                    <tr class="error">
                        <td>
                            2
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            02/04/2012
                        </td>
                        <td>
                            Declined
                        </td>
                    </tr>
                    <tr class="warning">
                        <td>
                            3
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            03/04/2012
                        </td>
                        <td>
                            Pending
                        </td>
                    </tr>
                    <tr class="info">
                        <td>
                            4
                        </td>
                        <td>
                            TB - Monthly
                        </td>
                        <td>
                            04/04/2012
                        </td>
                        <td>
                            Call in to confirm
                        </td>
                    </tr>
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
                    <button class="btn btn-success" type="button" onclick="search_trade_info()">搜索排名</button>
                </div>
            </form>
        </div>
    </div>
    <!-- 展示信息用的表格 -->
    <table id="orders-info" class="table table-striped">
        <thead>
        <tr>
            <th>员工姓名</th>
            <th>员工编号</th>
            <th>总交易量</th>
            <th>客户ID</th>
            <th>商品ID</th>
            <th>商品名称</th>
            <th>采购</th>
            <th>详细信息</th>
            <th>跟单员</th>
            <th>操作员</th>
            <th>开始时间</th>
            <th>更新时间</th>
            <th>结束时间</th>
            <th>状态</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($rank_info as $info) {
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
</script>
