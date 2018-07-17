<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-06 20:09:47
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-17 21:41:04
 */
?>
<div class="container">
    <div class="row col-md-12">
        <h2>销售榜单<span class="glyphicon glyphicon-fire" aria-hidden="true"></h2>
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
                        <td>1</td>
                        <td>义成</td>
                        <td>100笔</td>
                        <td>2018-07-17 21:00:11</td>
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
                        <td>1</td>
                        <td>凯波</td>
                        <td>1000</td>
                        <td>2018-07-17 21:00:11</td>
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
                        <td>1</td>
                        <td>凯波</td>
                        <td>1000</td>
                        <td>2018-07-17 21:00:11</td>
                        <td>1</td>
                        <td>凯波</td>
                        <td>1000</td>
                        <td>2018-07-17 21:00:11</td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#searchRank">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                搜索排名
            </button>
        </div>
        <div id="searchRank" class="col-md-4 collapse">
            <!-- 查询成交量组框 -->
            <form class="bs-example bs-example-form" role="form">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">员工姓名</span>
                    <input type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">员工编号</span>
                    <input type="text" class="form-control">
                </div>
                <div>
                    <button id="btSearch" class="btn btn-success" type="button" onclick="search_trade_info()">
                        搜索排名
                    </button>
                    <label for="btSearch">填一个或者两个</label>
                </div>
            </form>
        </div>
    </div>
    <!-- 展示信息用的表格 -->
    <table id="rank-info" class="table table-striped">
        <thead>
        <tr>
            <th>排名</th>
            <th>员工姓名</th>
            <th>总成交量</th>
            <th>最后成交时间</th>
        </tr>
        </thead>
        <tbody>
            <td>1</td>
            <td>曹义成</td>
            <td>1000</td>
            <td>2018-07-22 10::55:00</td>
        </tbody>
    </table>
    <ul class="pagination pagination-sm">
        <li>
             <a href="#">Prev</a>
        </li>
        <li>
             <a href="#">1</a>
        </li>
        <li>
             <a href="#">2</a>
        </li>
        <li>
             <a href="#">3</a>
        </li>
        <li>
             <a href="#">4</a>
        </li>
        <li>
             <a href="#">5</a>
        </li>
        <li>
             <a href="#">Next</a>
        </li>
    </ul>
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
