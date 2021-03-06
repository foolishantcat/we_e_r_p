<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-09 21:37:09
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-31 21:16:44
 */
?>

<div id="contentOrder" class="container" style="width: 100%;">
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
                                    <label for="orderTitle" class="col-sm-2 control-label">标题*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="orderTitle"
                                           placeholder="请输入客户ID">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="customerName" class="col-sm-2 control-label">客户姓名*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="customerName"
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
                                    <label for="logisInfo" class="col-sm-2 control-label">物流信息</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="logisInfo"
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
            <form id="formSearch" class="bs-example bs-example-form" role="form">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">订单编号</span>
                    <input id="orderId" type="text" class="form-control" placeholder="填写订单编号">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">交易员</span>
                    <input id="handler" type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">客户姓名</span>
                    <input id="customerName" type="text" class="form-control" placeholder="twitterhandle">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">商品ID</span>
                    <input id="goodsId" type="text" class="form-control">
                </div>
                <div>
                    <button id="btSearchOrder" class="btn btn-success" type="button" onclick="search_order(formSearch.orderId, formSearch.handler, formSearch.customerName,formSearch.goodsId)">
                        搜一下
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 展示信息用的表格 -->
    <table id="orderTable" class="table table-bordered table-striped" style="width: 100%;">
        <thead>
        <tr>
            <th>编号</th>
            <th>类型</th>
            <th>标题</th>
            <th>客户ID</th>
            <th>商品ID</th>
            <th>商品名称</th>
            <th>商品数量</th>
            <th>金额</th>
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
        <tbody id="tableContents">
            <?php
                foreach ($order_info as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['order_id'] . "</td>";
                    echo "<td>" . $row['kind'] . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['customer_id'] . "</td>";
                    echo "<td>" . $row['goods_id'] . "</td>";
                    echo "<td>" . $row['goods_name'] . "</td>";
                    echo "<td>" . $row['goods_count'] . "</td>";
                    echo "<td>" . $row['amountofmoney'] ."</td>";
                    echo "<td>" . $row['logis_id'] . "</td>";
                    echo "<td>" . $row['handler'] . "</td>";
                    echo "<td>" . $row['start_time'] . "</td>";
                    echo "<td>" . $row['update_time'] . "</td>";
                    echo "<td>" . $row['end_time'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>";
                    $select_id = "item".$row['order_id'];
                    echo "<select id='$select_id' class='selectpicker'>";
                    echo "<option>成交订单</option>";
                    echo "<option>订单发货</option>";
                    echo "<option>修改</option>";
                    echo "<option>删除</option>";
                    echo "</select>";
                    echo "</td>";
                    echo "<td>";
                    echo "<button type='button' class='btn btn-success' onclick='commit_handle($select_id)'>提交</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<script>
// 初始化界面
$(document).ready(function(){
    $('#orderTable').dataTable({
        "paging": true,
        "pageLength": 10,
        "pagingType": "full_numbers",
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "processing": true,
        "searching": true,
        "stateSave": true,
        "ordering": true,
    });
});

function commit_new_order() {
    //目前只支持index.php
    var r_url = "index.php?r=" + "order/order-info";
    console.log(r_url);
    var title = document.getElementById('orderTitle').value;
    var customer_name = document.getElementById('customerName').value;
    var goods_id = document.getElementById('goodsId').value;
    var goods_name = document.getElementById('goodsName').value;
    var goods_count = document.getElementById('goodsCount').value;
    var logis_info = document.getElementById('logisInfo').value;
    console.log(title+"|"+customer_name+"|"+goods_id+"|"+goods_name+"|"+goods_count+"|"+logis_info);
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            action: 'new_order',
            title: title,
            customer_name: customer_name,
            goods_id: goods_id,
            goods_name: goods_name,
            goods_count: goods_count,
            logis_info: logis_info,
        },
        success: function (data) {
            var jsonObj = JSON.parse(data);
            var tableData = jsonObj.data;
            alert('[成功]新增订单: ' + jsonObj.code);
            var row = tableData[0];
            console.log(data);
            // 根据order_id 获取 select_id
            var select_id = "item" + row.order_id;
            html = "<tr>" +
            "<td>" + row.order_id + "</td>" +
            "<td>" + row.type + "</td>" +
            "<td>" + row.title + "</td>" +
            "<td>" + row.customer_id + "</td>" +
            "<td>" + row.goods_id + "</td>" +
            "<td>" + row.goods_name + "</td>" +
            "<td>" + row.goods_count + "</td>" +
            "<td>" + row.amountofmoney + "</td>" +
            "<td>" + row.logis_id + "</td>" +
            "<td>" + row.handler + "</td>" +
            "<td>" + row.start_time + "</td>" +
            "<td>" + row.update_time + "</td>" +
            "<td>" + row.end_time + "</td>" +
            "<td>" + row.status + "</td>" +
            "<td>" +
                "<select id='" + select_id + "' class='selectpicker'>" +
                    "<option>采购申请</option>" +
                    "<option>上架</option>" +
                    "<option>下架</option>" +
                    "<option>修改</option>" +
                    "<option>删除</option>" +
                "</select>" +
            "</td>" +
            "<td>" +
                "<button type='button' class='btn btn-success' onclick='commit_handle(" + select_id + ")'>提交</button>" +
            "</td>" +
            "</tr>";
            $(html).prependTo("#tableContents:first");//将新数据填充到table
        },
        error: function(data) {
            console.log('Error: ' + data);
            alert('[失败]新增交易');
        }
    });
}

function search_order(orderId, handler, customerName, goodsId) {
    //目前只支持index.php
    var r_url = "index.php?r=" + "order/order-info";
    console.log(r_url);
    var m_orderId = orderId.value;
    var m_handler = handler.value;
    var m_customerName = customerName.value;
    var m_goodsId = goodsId.value;
    console.log(m_orderId+"|"+m_handler+"|"+m_customerName+"|"+m_goodsId);
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            action: 'search_order',
            order_id: m_orderId,
            handler: m_handler,
            customer_name: m_customerName,
            goods_id: m_goodsId,
            page: 1,
            rows: 10,
        },
        success: function (data) {
            alert('[成功]搜索成功: ' + data);
            // 解析json，然后替换前端
            var jsonObj = JSON.parse(data);
            var tableData = jsonObj.data;
            $("#orderTable tr:gt(0)").remove();//第一行是table的表格头不需清除
            var html = '';
            for(var i=0; i < tableData.length; i++){
                var row = tableData[i];
                var t_order_id = row.order_id;
                var t_type = row.type;
                var t_title = row.title;
                var t_customer_id = row.customer_id;
                var t_goods_id = row.goods_id;
                var t_goods_name = row.goods_name;
                var t_goods_count = row.goods_count;
                var t_amountofmoney = row.amountofmoney;
                var t_logis_id = row.logis_id;
                var t_handler = row.handler;
                var t_start_time = row.start_time;
                var t_update_time = row.update_time;
                var t_end_time = row.end_time;
                var t_status = row.status;
                // 根据order_id 获取 select_id
                var select_id = "item" + t_order_id;
                html += "<tr>" +
                "<td>" + t_order_id + "</td>" +
                "<td>" + t_type + "</td>" +
                "<td>" + t_title + "</td>" +
                "<td>" + t_customer_id + "</td>" +
                "<td>" + t_goods_id + "</td>" +
                "<td>" + t_goods_name + "</td>" +
                "<td>" + t_goods_count + "</td>" +
                "<td>" + t_amountofmoney + "</td>" +
                "<td>" + t_logis_id + "</td>" +
                "<td>" + t_handler + "</td>" +
                "<td>" + t_start_time + "</td>" +
                "<td>" + t_update_time + "</td>" +
                "<td>" + t_end_time + "</td>" +
                "<td>" + t_status + "</td>" +
                "<td>" +
                    "<select id='" + select_id + "' class='selectpicker'>" +
                        "<option>成交订单</option>" +
                        "<option>订单发货</option>" +
                        "<option>删除订单</option>" +
                    "</select>" +
                "</td>" +
                "<td>" +
                    "<button type='button' class='btn btn-success' onclick='commit_handle(" + select_id + ")'>提交</button>" +
                "</td>" +
                "</tr>";
            }
            $("#orderTable").append(html);//将新数据填充到table
        },
        error: function(data) {
            console.log('Error: ' + data);
            alert('[失败]搜索失败');
        }
    });
}

function commit_handle(obj) {
    //目前只支持index.php
    var r_url = "index.php?r=" + "order/order-info";
    console.log(r_url);
    var m_order_id = obj.id.split('item')[1];
    var m_handle = obj.value;
    console.log(m_order_id+"|"+m_handle);
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            action: 'commit_handle',
            order_id: m_order_id,
            handle: m_handle,
        },
        success: function (data) {
            alert('[成功]搜索成功: ' + data);
        },
        error: function(data) {
            console.log('Error: ' + data);
            alert('[失败]搜索失败');
        }
    });
}
</script>
