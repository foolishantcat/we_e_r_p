<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-08-13 21:10:10
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-08-19 17:05:53
 */
?>

<div id="contentPurchs" class="container" style="width: 100%;">
    <h2>采购列表<span class="glyphicon glyphicon-fire" aria-hidden="true"></span></h2>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#searchPurchs">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                搜索采购单
            </button>
        </div>

        <div id="searchPurchs" class="col-md-4 collapse" >
            <!-- 查询交易组框 -->
            <form id="formSearch" class="form-horizontal" role="form">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">采购类型</span>
                    <select id="searchKind" class="selectpicker">
                        <option>商品物料</option>
                        <option>办公设备</option>
                    </select>
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">采购单号</span>
                    <input id="purchId" type="text" class="form-control" placeholder="填写采购单号">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">商品编号</span>
                    <input id="goodsId" type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">商品名称</span>
                    <input id="goodsName" type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">商品类型</span>
                    <input id="goodsKind" type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">操作员</span>
                    <input id="handler" type="text" class="form-control" placeholder="填写中文名">
                </div>
                <div>
                    <button id="btSearchPurchs" class="btn btn-success" type="button" onclick="search_purchs(formSearch.searchKind, formSearch.purchId, formSearch.goodsId,formSearch.goodsName, formSearch.goodsKind, formSearch.handler)">
                        搜一下
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 展示信息用的表格 -->
    <table id="purchsTable" class="table table-bordered table-striped" style="width: 100%;">
        <thead>
        <tr>
            <th>采购类型</th>
            <th>采购单号</th>
            <th>标题</th>
            <th>商品编号</th>
            <th>商品名称</th>
            <th>商品类型</th>
            <th>数量</th>
            <th>单价</th>
            <th>金额</th>
            <th>用途</th>
            <th>采购状态</th>
            <th>所在仓库</th>
            <th>申请人</th>
            <th>审批人</th>
            <th>财务</th>
            <th>采购员</th>
            <th>开始时间</th>
            <th>更新时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody id="tableContents">
            <?php
                foreach ($purch_info as $row) {
                    $purch_id = $row['purch_id'];
                    echo "<tr id='mtr$purch_id'>";
                    echo "<td>" . $row['purch_type'] . "</td>";
                    echo "<td>" . $row['purch_id'] . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['goods_id'] . "</td>";
                    echo "<td>" . $row['goods_name'] . "</td>";
                    echo "<td>" . $row['kind'] . "</td>";
                    echo "<td>" . $row['counts'] ."</td>";
                    echo "<td>" . $row['unit_price'] . "</td>";
                    echo "<td>" . $row['amountofmoney'] . "</td>";
                    echo "<td>" . $row['use'] . "</td>";
                    echo "<td>" . $row['process'] . "</td>";
                    echo "<td>" . $row['repertory'] . "</td>";
                    echo "<td>" . $row['proposer'] . "</td>";
                    echo "<td>" . $row['approver'] . "</td>";
                    echo "<td>" . $row['financer'] . "</td>";
                    echo "<td>" . $row['purchaser'] . "</td>";
                    echo "<td>" . $row['start_time'] . "</td>";
                    echo "<td>" . $row['update_time'] . "</td>";
                    echo "<td>";
                    echo "<form class='form-horizontal'>";
                    echo "<div class='contorl-group' style='white-space:nowrap'>";
                    echo "<span id='modifybt$purch_id' class='spanbt glyphicon glyphicon-edit' aria-hidden='true' style='margin:5px;}' onclick='modify_purch(this)'></span>";
                    echo "<span id='deletebt$purch_id' class='spanbt glyphicon glyphicon-remove' aria-hidden='true' style='margin:5px;' onclick='delete_purch(this)'></span>";
                    echo "<span id='nextbt$purch_id' class='spanbt glyphicon glyphicon-send' aria-hidden='true' style='margin:5px;' onclick='next_process(this)'></span>";
                    echo "</div>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <div class="modal fade" id="nextProcess">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- 模态框头部 -->
                    <div class="modal-header">
                        <h4 class="modal-title">采购单流转</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- 模态框主体 -->
                    <div class="modal-body">
                        <div class="alert alert-primary" role="alert">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label">标题*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" disabled="disabled">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="purchId" class="col-sm-2 control-label">采购单ID*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="purchId" disabled="disabled">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="goodsId" class="col-sm-2 control-label">商品ID*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="goodsId" disabled="disabled">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="goodsName" class="col-sm-2 control-label">商品名称*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="goodsName" disabled="disabled">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="goodsCount" class="col-sm-2 control-label">商品数量*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="goodsCount" disabled="disabled">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="amountOfMoney" class="col-sm-2 control-label">商品总价</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="amountOfMoney" disabled="disabled">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="putInTime" class="col-sm-2 control-label">仓库选择</label>
                                    <div class="col-sm-10">
                                        <select id='reperSelect' class='selectpicker'>
                                        <?php
                                            foreach ($reper_info as $key => $value) {
                                                echo "<option>$value</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="putInTime" class="col-sm-2 control-label">入库时间</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="putInTime">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- 模态框底部 -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="ask_put_in()">申请入库</button>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>
// 初始化界面
$(document).ready(function(){
    $('#purchsTable').dataTable({
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

// 鼠标划过变色
$(".spanbt").mouseover(function(){
  $(this).css({
      "border-color":"red",
      "color": "#87CEFF"
  });
}).mouseout(function(){
  $(this).css({
      "border-color":"",
      "color": ""
  });
});

// 自动填充数值
function next_process(obj) {
    var purch_id = $(obj).attr("id").split("nextbt")[1];
    var tr_id = 'mtr' + purch_id;
    console.log(tr_id);
    var tr_obj = document.getElementById(tr_id);
    var title = tr_obj.children[2].innerHTML;
    var purch_id = tr_obj.children[1].innerHTML;
    var goods_id = tr_obj.children[3].innerHTML;
    var goods_name = tr_obj.children[4].innerHTML;
    var goods_count = tr_obj.children[6].innerHTML;
    var amount_of_money = tr_obj.children[8].innerHTML;
    $("#nextProcess").modal("show");
    var inputs = document.getElementById("nextProcess").getElementsByTagName("input");
    inputs[0].value = title;
    inputs[1].value = purch_id;
    inputs[2].value = goods_id;
    inputs[3].value = goods_name;
    inputs[4].value = goods_count;
    inputs[5].value = amount_of_money;
}

function ask_put_in() {
    //目前只支持index.php
    var r_url = "index.php?r=" + "purch/purch-list";
    console.log(r_url);
    var m_purch_id = document.getElementById("nextProcess").getElementsByTagName("input")[1].value;
    console.log("purch_id: " + m_purch_id);
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            action: 'ask_put_in',
            purch_id: m_purch_id,
        },
        success: function (data) {
            var jsonObj = JSON.parse(data);
            var data = jsonObj.data;
            alert('[成功]入库成功: ' + data);
        },
        error: function(data) {
            console.log('Error: ' + data);
            alert('[失败]入库失败');
        }
    });
}

function modify_purch(obj) {
    var r_url = "index.php?r=" + "purch/purch-list";
    console.log(r_url);
    var purch_id = $(obj).attr("id").split("modifybt")[1];
    var tr_id = 'mtr' + purch_id;
    console.log(tr_id);
    var tr_obj = document.getElementById(tr_id);
    var m_purch_id = tr_obj.children[1].innerHTML;
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            action: 'modify_purch',
            purch_id: m_purch_id,
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

// 删除当前记录
function delete_purch(obj) {
    var r_url = "index.php?r=" + "purch/purch-list";
    console.log(r_url);
    var purch_id = $(obj).attr("id").split("deletebt")[1];
    var tr_id = 'mtr' + purch_id;
    console.log(tr_id);
    var tr_obj = document.getElementById(tr_id);
    var title = tr_obj.children[2].innerHTML;
    var m_purch_id = tr_obj.children[1].innerHTML;
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            action: 'delete_purch',
            purch_id: m_purch_id,
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

function search_purchs(searchKind, purchId, goodsId, goodsName, goodsKind, handler) {
    //目前只支持index.php
    var r_url = "index.php?r=" + "purch/purch-list";
    console.log(r_url);
    var m_purch_kind = searchKind.value;
    var m_purch_id = purchId.value;
    var m_goods_id = goodsId.value;
    var m_goods_name = goodsName.value;
    var m_goods_kind = goodsKind.value;
    var m_handler = handler.value;
    console.log(m_purch_kind+"|"+m_purch_id+"|"+m_goods_id+"|"+m_goods_name+"|"+m_goods_kind+"|"+m_handler);
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            action: 'search_purchs',
            purch_kind: m_purch_kind,
            purch_id: m_purch_id,
            goods_id: m_goods_id,
            goods_name: m_goods_name,
            goods_kind: m_goods_kind,
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

</script>
