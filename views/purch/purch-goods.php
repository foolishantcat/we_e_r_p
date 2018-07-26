<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-24 16:07:43
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-26 22:07:46
 */
?>
<div id="contentOrder" class="container" style="width: 100%;">
    <h2>商品物料<span class="glyphicon glyphicon-fire" aria-hidden="true"></span></h2>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newOrder">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                新建商品
            </button>
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#searchOrder">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                搜索商品
            </button>
        </div>

        <!-- 新建交易模态框 -->
        <div class="modal fade" id="newGoods">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- 模态框头部 -->
                    <div class="modal-header">
                        <h4 class="modal-title">新建商品</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- 模态框主体 -->
                    <div class="modal-body">
                        <div class="alert alert-primary" role="alert">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="goodsName" class="col-sm-2 control-label">商品名称*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="goodsName"
                                           placeholder="请输入商品名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="typeOption" class="col-sm-2 control-label">类别*</label>
                                    <div class="col-sm-10">
                                        <select id="typeOption" class="selectpicker">
                                            <option>食品</option>
                                            <option>电脑耗材</option>
                                            <option>文具</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="statusOption" class="col-sm-2 control-label">状态*</label>
                                    <div class="col-sm-10">
                                        <select id="statusOption" class="selectpicker">
                                            <option>售卖中</option>
                                            <option>已下架</option>
                                            <option>未上架</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="goodsDetail" class="col-sm-2 control-label">详细信息</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="goodsDetail"
                                           placeholder="可以省略">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- 模态框底部 -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="commit_new_goods()">提交商品</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="searchGoods" class="col-md-4 collapse" >
            <!-- 查询交易组框 -->
            <form id="formSearch" class="bs-example bs-example-form" role="form">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">商品编号</span>
                    <input id="goodsId" type="text" class="form-control" placeholder="填写商品编号">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">商品名称</span>
                    <input id="goodsName" type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">类别</span>
                    <select id="searchType" class="selectpicker">
                        <option>食品</option>
                        <option>电脑耗材</option>
                        <option>文具</option>
                    </select>
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">状态</span>
                    <select id="searchStatus" class="selectpicker">
                        <option>售卖中</option>
                        <option>已下架</option>
                        <option>未上架</option>
                    </select>
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">操作员</span>
                    <input id="handler" type="text" class="form-control" placeholder="填写中文名">
                </div>
                <div>
                    <button id="btSearchOrder" class="btn btn-success" type="button" onclick="search_order(formSearch.goodsId, formSearch.goodsName, formSearch.searchType, formSearch.searchStatus,formSearch.handler)">
                        搜一下
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 展示信息用的表格 -->
    <table class="table table-bordered table-striped" style="width: 100%;">
        <thead>
        <tr>
            <th>商品编号</th>
            <th>商品名称</th>
            <th>类型</th>
            <th>详细信息</th>
            <th>状态</th>
            <th>操作员</th>
            <th>开始时间</th>
            <th>更新时间</th>
            <th>操作</th>
            <th>处理</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php
                foreach ($goods_info as $row) {
                    echo "<tr>";
                    foreach($row as $k => $v) {
                        echo "<td>";
                        echo "$v" . "";
                        echo "</td>";
                    }
                    $select_id = "item".$row['order_id'];
                    echo "<td>";
                    echo "<select id='$select_id' class='selectpicker'>";
                    echo "<option>成交订单</option>";
                    echo "<option>订单发货</option>";
                    echo "<option>删除订单</option>";
                    echo "</select>";
                    echo "</td>";
                    echo "<td>";
                    echo "<button type='button' class='btn btn-success' onclick='commit_handle($select_id)'>提交</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
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

function commit_new_goods() {
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
            alert('[成功]新增交易: ' + data);
        },
        error: function(data) {
            console.log('Error: ' + data);
            alert('[失败]新增交易');
        }
    });
}

function search_goods(goodsId, goodsName, searchType, searchStatus, handler) {
    //目前只支持index.php
    var r_url = "index.php?r=" + "order/purch-goods";
    console.log(r_url);
    var m_goods_id = goodsId.value;
    var m_goods_name = goodsName.value;
    var m_type = searchType.value;
    var m_status = searchStatus.value;
    var m_handler = handler.value;
    console.log(m_goods_id+"|"+m_goods_name+"|"+m_type+"|"+m_status+"|"+m_handler);
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            action: 'search_goods',
            goods_id: m_goods_id,
            goods_name: m_goods_name,
            type: m_type,
            status: m_status,
            handler: m_handler,
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
