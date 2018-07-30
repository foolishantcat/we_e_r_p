<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-24 16:07:43
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-30 21:44:49
 */
?>
<div id="contentGoods" class="container" style="width: 100%;">
    <h2>商品物料<span class="glyphicon glyphicon-fire" aria-hidden="true"></span></h2>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newGoods">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                新建商品
            </button>
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#searchGoods">
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
                                    <label for="newGoodsName" class="col-sm-2 control-label">商品名称*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="newGoodsName"
                                           placeholder="请输入商品名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="newGoodsKind" class="col-sm-2 control-label">类别*</label>
                                    <div class="col-sm-10">
                                        <select id="newGoodsKind" class="selectpicker">
                                            <option>食品</option>
                                            <option>电脑耗材</option>
                                            <option>文具</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="newGoodsDetail" class="col-sm-2 control-label">详细信息</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="newGoodsDetail"
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
                    <select id="searchKind" class="selectpicker">
                        <option>食品</option>
                        <option>电脑耗材</option>
                        <option>文具</option>
                    </select>
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">类型</span>
                    <select id="searchType" class="selectpicker">
                        <option>新建</option>
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
                    <button id="btSearchOrder" class="btn btn-success" type="button" onclick="search_goods(formSearch.goodsId, formSearch.goodsName, formSearch.searchKind, formSearch.searchType,formSearch.handler)">
                        搜一下
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 展示信息用的表格 -->
    <table id="goodsTable" class="table table-bordered table-striped" style="width: 100%;">
        <thead>
        <tr>
            <th>商品编号</th>
            <th>商品名称</th>
            <th>类别</th>
            <th>详细信息</th>
            <th>类型</th>
            <th>操作员</th>
            <th>开始时间</th>
            <th>更新时间</th>
            <th>状态</th>
            <th>操作</th>
            <th>处理</th>
        </tr>
        </thead>
        <tbody id="tableContents">
        <tr>
            <?php
                foreach ($goods_info as $row) {
                    echo "<tr>";
                    foreach($row as $k => $v) {
                        echo "<td>";
                        echo "$v" . "";
                        echo "</td>";
                    }
                    $select_id = "item".$row["goods_id"];
                    echo "<td>";
                    echo "<select id='$select_id' class='selectpicker'>";
                    echo "<option>采购申请</option>";
                    echo "<option>上架</option>";
                    echo "<option>下架</option>";
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
    var r_url = "index.php?r=" + "purch/purch-goods";
    console.log(r_url);
    var goods_name = document.getElementById('newGoodsName').value;
    var goods_kind = document.getElementById('newGoodsKind').value;
    var goods_detail = document.getElementById('newGoodsDetail').value;
    var goods_type = '新建';
    var goods_status = '正常';
    console.log(goods_name+"|"+goods_type+"|"+goods_status+"|"+goods_detail);
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            action: 'new_goods',
            goods_name: goods_name,
            kind: goods_kind,
            type: goods_type,
            status: goods_status,
            detail: goods_detail,
        },
        success: function (data) {
            // 成功则插入一条数据到当前页面
            var jsonObj = JSON.parse(data);
            var tableData = jsonObj.data;
            alert('[成功]新增商品: ' + tableData);
            var html = '';
            var row = tableData;
            var t_goods_id = row.goods_id;
            var t_goods_name = row.goods_name;
            var t_type = row.type;
            var t_kind = row.kind;
            var t_detail = row.detail;
            var t_handler = row.handler;
            var t_start_time = row.start_time;
            var t_update_time = row.update_time;
            var t_status = row.status;
            // 根据order_id 获取 select_id
            var select_id = "item" + t_goods_id;
            html += "<tr>" +
            "<td>" + t_goods_id + "</td>" +
            "<td>" + t_goods_name + "</td>" +
            "<td>" + t_kind + "</td>" +
            "<td>" + t_detail + "</td>" +
            "<td>" + t_type + "</td>" +
            "<td>" + t_handler + "</td>" +
            "<td>" + t_start_time + "</td>" +
            "<td>" + t_update_time + "</td>" +
            "<td>" + t_status + "</td>" +
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
            $(html).appendTo("#tableContents:first");//将新数据填充到table
        },
        error: function(data) {
            var jsonObj = JSON.parse(data);
            var msg = jsonObj.msg;
            alert('[失败]新增商品: ' + msg);
        }
    });
}

function search_goods(goodsId, goodsName, searchKind, searchType, handler) {
    //目前只支持index.php
    var r_url = "index.php?r=" + "purch/purch-goods";
    console.log(r_url);
    var m_goods_id = goodsId.value;
    var m_goods_name = goodsName.value;
    var m_kind = searchKind.value;
    var m_type = searchType.value;
    var m_handler = handler.value;
    console.log(m_goods_id+"|"+m_goods_name+"|"+m_type+"|"+m_kind+"|"+m_handler);
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            action: 'search_goods',
            goods_id: m_goods_id,
            goods_name: m_goods_name,
            type: m_type,
            kind: m_kind,
            handler: m_handler,
        },
        success: function (data) {
            alert('[成功]搜索成功: ' + data);
            // 解析json，然后替换前端
            var jsonObj = JSON.parse(data);
            var tableData = jsonObj.data;
            $("#goodsTable tr:gt(0)").remove();//第一行是table的表格头不需清除
            var html = '';
            for(var i=0; i < tableData.length; i++){
                var row = tableData[i];
                var t_goods_id = row.goods_id;
                var t_goods_name = row.goods_name;
                var t_type = row.type;
                var t_kind = row.kind;
                var t_detail = row.detail;
                var t_status = row.status;
                var t_handler = row.handler;
                var t_start_time = row.start_time;
                var t_update_time = row.update_time;
                // 根据order_id 获取 select_id
                var select_id = "item" + t_goods_id;
                html += "<tr>" +
                "<td>" + t_goods_id + "</td>" +
                "<td>" + t_goods_name + "</td>" +
                "<td>" + t_kind + "</td>" +
                "<td>" + t_detail + "</td>" +
                "<td>" + t_type + "</td>" +
                "<td>" + t_handler + "</td>" +
                "<td>" + t_start_time + "</td>" +
                "<td>" + t_update_time + "</td>" +
                "<td>" + t_status + "</td>" +
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
            }
            $(html).appendTo("#tableContents:first");//将新数据填充到table
        },
        error: function(data) {
            var jsonObj = JSON.parse(data);
            var msg = jsonObj.msg;
            alert('[失败]搜索失败: ' + msg);
        }
    });
}

function commit_handle(obj) {
    //目前只支持index.php
    var r_url = "index.php?r=" + "purch/purch-goods";
    console.log(r_url);
    var m_goods_id = obj.id.split('item')[1];
    var m_handle = obj.value;
    console.log(m_goods_id+"|"+m_handle);
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            action: 'commit_handle',
            goods_id: m_goods_id,
            handle: m_handle,
        },
        success: function (data) {
            var jsonObj = JSON.parse(data);
            var data = jsonObj.data;
            alert('[成功]搜索成功: ' + data);
        },
        error: function(data) {
            console.log('Error: ' + data);
            alert('[失败]搜索失败');
        }
    });
}
</script>
