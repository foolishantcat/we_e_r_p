<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-09 21:37:09
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-17 21:43:48
 */
?>

<div id="contentOrder" class="container" stype="margin-left:0px; margin-right:0px;">
    <h2>订单详情<span class="glyphicon glyphicon-fire" aria-hidden="true"></span></h2>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newOrder">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                新建订单
            </button>
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#searchOrder">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                搜索订单
            </button>
        </div>

        <!-- 新建交易模态框 -->
        <div class="modal fade" id="newOrder">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- 模态框头部 -->
                    <div class="modal-header">
                        <h4 class="modal-title">新建订单</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- 模态框主体 -->
                    <div class="modal-body">
                        <div class="alert alert-primary" role="alert">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="orderName" class="col-sm-2 control-label">标题*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="orderName"
                                           placeholder="请输入客户ID">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="orderName" class="col-sm-2 control-label">客户姓名*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="orderName"
                                           placeholder="请输入客户姓名">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="goodsId" class="col-sm-2 control-label">商品ID*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="goodsId"
                                           placeholder="请输入商品ID">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="goodsName" class="col-sm-2 control-label">商品名称*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="goodsName"
                                           placeholder="请输入商品名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="goodsCount" class="col-sm-2 control-label">商品数量</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="goodsCount"
                                           placeholder="请输入项目ID">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="goodsCount" class="col-sm-2 control-label">物流信息</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="goodsCount"
                                           placeholder="请输入物流地址信息">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- 模态框底部 -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="commit_new_order()">提交订单</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="searchOrder" class="col-md-4 collapse" >
            <!-- 查询交易组框 -->
            <form class="bs-example bs-example-form" role="form">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">订单编号</span>
                    <input type="text" class="form-control" placeholder="twitterhandle">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">交易员</span>
                    <input type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">客户姓名</span>
                    <input type="text" class="form-control" placeholder="twitterhandle">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">商品ID</span>
                    <input type="text" class="form-control">
                </div>
                <div>
                    <button id="btSearchOrder" class="btn btn-success" type="button" onclick="search_order()">
                        搜一下
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 展示信息用的表格 -->
    <table class="table table-striped">
        <thead>
        <tr>
            <th>编号</th>
            <th>类型</th>
            <th>名称</th>
            <th>客户ID</th>
            <th>商品ID</th>
            <th>商品名称</th>
            <th>商品数量</th>
            <th>物流信息</th>
            <th>跟单员</th>
            <th>开始时间</th>
            <th>更新时间</th>
            <th>结束时间</th>
            <th>状态</th>
            <th>操作</th>
            <th>处理</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>销售订单</td>
            <td>巨凯波的订单</td>
            <td>B123</td>
            <td>S345</td>
            <td>苹果</td>
            <td>100</td>
            <td>广东省广州市</td>
            <td>义成</td>
            <td>2018-07-12 10:20:00</td>
            <td>2018-07-12 10:20:00</td>
            <td>2018-07-12 10:20:00</td>
            <td>状态</td>
            <td>操作</td>
            <td>
                <select>
                    <option>成交订单</option>
                    <option>订单发货</option>
                    <option>删除订单</option>
                </select>
            </td>
            <td>
                <button type="button" class="btn btn-success" onclick="commit_handle()">提交</button>
            </td>
        </tr>
        </tbody>
    </table>
    <ul class="pagination pagination-sm" style="padding-bottom: 0px;">
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
function search_order_info() {
    alert("点击了搜索交易");
}

function commit_new_order() {
    //目前只支持index.php
    var r_url = "index.php?r=" + "site/trade-query";
    console.log(r_url);
    var title = document.getElementById('tradeTitle').value;
    var customer_id = document.getElementById('customerId').value;
    var project_id = document.getElementById('projectId').value;
    var order_id = document.getElementById('orderId').value;
    var detail = document.getElementById('tradeDetail').value;
    console.log(title+"|"+customer_id+"|"+project_id+"|"+order_id+"|"+detail);
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            title: title,
            customer_id: customer_id,
            project_id: project_id,
            order_id: order_id,
            detail: detail,
        },
        success: function (data) {
            alert('[成功]新增交易');
        },
        error: function(data) {
            console.log('Error: ' + data);
            alert('[失败]新增交易');
        }
    });
}
</script>
