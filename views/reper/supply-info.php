<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-08-28 21:20:41
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-08-28 22:36:45
 */
?>

<div id="contentSupplys" class="container" style="width: 100%;">
    <h2>库存信息<span class="glyphicon glyphicon-fire" aria-hidden="true"></span></h2>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#searchSupplys" style="float:left;">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                查询库存
            </button>
            <p class="text-success" style="float:left;margin-left: 10px;">实时显示搜索结果</p>
        </div>

        <div id="searchSupplys" class="col-md-4 collapse" >
            <!-- 查询交易组框 -->
            <form id="formSearch" class="form-horizontal" role="form">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">选择仓库</span>
                    <select id="searchReper" class="selectpicker">
                        <?php
                            foreach ($reper_info as $key => $value) {
                                echo "<option>$value</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">商品分类</span>
                    <select id="searchKind" class="selectpicker">
                        <?php
                            foreach ($kind as $key => $value) {
                                echo "<option>$value</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">商品名称</span>
                    <input id="goddsName" type="text" class="form-control" placeholder="填写商品名称">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">商品编号</span>
                    <input id="goodsId" type="text" class="form-control">
                </div>
                <div>
                    <button id="btSearchPurchs" class="btn btn-success" type="button" onclick="search_purchs(formSearch.searchReper, formSearch.searchKind, formSearch.goddsName,formSearch.goodsId)">
                        搜一下
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 展示信息用的表格 -->
    <table id="repersTable" class="table table-bordered table-striped" style="width: 100%;">
        <thead>
        <tr>
            <th>仓库编号</th>
            <th>仓库名</th>
            <th>负责人</th>
            <th>电话</th>
            <th>工作时间</th>
            <th>状态</th>
            <th>地址</th>
            <th>值班人</th>
            <th>电话</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody id="tableContents">
            <?php
                foreach ($purch_info as $row) {
                    $purch_id = $row['purch_id'];
                    echo "<tr id='mtr$purch_id'>";
                    echo "<td>" . $row['reper_id'] . "</td>";
                    echo "<td>" . $row['reper_name'] . "</td>";
                    echo "<td>" . $row['manager'] . "</td>";
                    echo "<td>" . $row['mgr_phone'] . "</td>";
                    echo "<td>" . $row['work_time'] . "</td>";
                    echo "<td>" . $row['reper_status'] . "</td>";
                    echo "<td>" . $row['address'] ."</td>";
                    echo "<td>" . $row['watcher'] . "</td>";
                    echo "<td>" . $row['watcher_phone'] . "</td>";
                    echo "<td>";
                    echo "<form class='form-horizontal'>";
                    echo "<div class='contorl-group' style='white-space:nowrap'>";
                    echo "<span id='modifybt$reper_id' class='spanbt glyphicon glyphicon-edit' data-toggle='tooltip' aria-hidden='true' style='margin:5px;}' onclick='modify_process(this)' title='修改'></span>";
                    echo "<span id='deletebt$reper_id' class='spanbt glyphicon glyphicon-remove' data-toggle='tooltip' aria-hidden='true' style='margin:5px;' onclick='delete_reper(this)' title='删除'></span>";
                    echo "<span id='detailbt$reper_id' class='spanbt glyphicon glyphicon-send' data-toggle='tooltip' aria-hidden='true' style='margin:5px;' onclick='show_detail(this)' title='详情'></span>";
                    echo "</div>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <div class="modal fade" id="newReper">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h4 class="modal-title">新建仓库</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- 模态框主体 -->
                <div class="modal-body">
                    <div class="alert alert-primary" role="alert">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="reperName" class="col-sm-2 control-label">仓库名*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="reperName">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reperMgr" class="col-sm-2 control-label">负责人*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="reperMgr">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="workTime" class="col-sm-2 control-label">工作时间*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="workTime">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">状态*</label>
                                <div class="col-sm-10">
                                    <select id='statusSelect' class='selectpicker'>
                                    <?php
                                        foreach ($status_info as $key => $value) {
                                            echo "<option>$value</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-sm-2 control-label">地址*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="watcher" class="col-sm-2 control-label">值班人</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="watcher">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="watcherPhone" class="col-sm-2 control-label">电话</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="watcherPhone">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- 模态框底部 -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="new_reper()">提交</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="alertReper">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h4 class="modal-title">修改仓库</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- 模态框主体 -->
                <div class="modal-body">
                    <div class="alert alert-primary" role="alert">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="reperName" class="col-sm-2 control-label">仓库名*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="reperName" disabled="disabled">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="wOutOrder" class="col-sm-2 control-label">本周出库单数</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="reperMgr" disabled="disabled">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="wOutOrder" class="col-sm-2 control-label">本周出库单数</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="reperMgr" disabled="disabled">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mgrPhone" class="col-sm-2 control-label">负责人电话*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mgrPhone" disabled="disabled">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="workTime" class="col-sm-2 control-label">工作时间</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="workTime">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="watcher" class="col-sm-2 control-label">值班人</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="watcher">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="watcherPhone" class="col-sm-2 control-label">值班人电话</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="watcherPhone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">仓库状态*</label>
                                <div class="col-sm-10">
                                    <select id='statusSelect' class='selectpicker'>
                                    <?php
                                        foreach ($status_info as $key => $value) {
                                            echo "<option>$value</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-sm-2 control-label">地址*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="address" disabled="disabled">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- 模态框底部 -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick=" alert_reper()">提交</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reperDetail">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h4 class="modal-title">仓库详情</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- 模态框主体 -->
                <div class="modal-body">
                    <div class="container">
                        <div class="row clearfix">
                            <div class="col-md-6 column">
                                <div class="form-group">
                                    <label for="dOutOrders" class="col-sm-2 control-label">今日出库单数</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="dOutOrders" disabled="disabled">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="wOutOrders" class="col-sm-2 control-label">本周出库单数</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="wOutOrders" disabled="disabled">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mOutOrders" class="col-sm-2 control-label">当月出库单数</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="mOutOrders" disabled="disabled">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 column">
                                <div class="form-group">
                                    <label for="dInOrders" class="col-sm-2 control-label">今日入库单数</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="dInOrders" disabled="disabled">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="wInOrders" class="col-sm-2 control-label">本周入库单数</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="wInOrders" disabled="disabled">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mInOrders" class="col-sm-2 control-label">当月入库单数</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="mInOrders" disabled="disabled">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 模态框底部 -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
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

// 鼠标划过显示详情
$(function () {
    $("[data-toggle='tooltip']").tooltip();
});

// 点击“飞机”自动填充数值
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

// 点击“编辑”自动填充数值
function modify_process(obj) {
    var purch_id = $(obj).attr("id").split("modifybt")[1];
    var tr_id = 'mtr' + purch_id;
    console.log(tr_id);
    var tr_obj = document.getElementById(tr_id);
    var title = tr_obj.children[2].innerHTML;
    var purch_id = tr_obj.children[1].innerHTML;
    var goods_id = tr_obj.children[3].innerHTML;
    var goods_name = tr_obj.children[4].innerHTML;
    var goods_count = tr_obj.children[6].innerHTML;
    var amount_of_money = tr_obj.children[8].innerHTML;
    $("#modifyProcess").modal("show");
    var inputs = document.getElementById("modifyProcess").getElementsByTagName("input");
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
    var m_purch_id = document.getElementById("modifyProcess").getElementsByTagName("input")[1].value;
    var tr_id = 'mtr' + m_purch_id;
    console.log(tr_id);
    //var tr_obj = document.getElementById(tr_id);
    //var m_purch_id = tr_obj.children[1].innerHTML;
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            action: 'modify_purch',
            purch_id: m_purch_id,
        },
        success: function (data) {
            // 解析json，然后替换前端
            var jsonObj = JSON.parse(data);
            var tableData = jsonObj.data;
            var retCode = jsonObj.code;
            if (retCode != 0) {
                alert('修改失败');
            } else {
                alert('修改成功');
            }
            var table = $('#purchsTable').DataTable();
            var select_tr = '#' + tr_id;
            var idx = table.row($(select_tr)).index();
            var ret_row = tableData[0];
            table.cell(idx, 0).data(ret_row.purch_type);
            table.cell(idx, 1).data(ret_row.purch_id);
            table.cell(idx, 2).data(ret_row.title);
            table.cell(idx, 3).data(ret_row.goods_id);
            table.cell(idx, 4).data(ret_row.goods_name);
            table.cell(idx, 5).data(ret_row.kind);
            table.cell(idx, 6).data(ret_row.count);
            table.cell(idx, 7).data(ret_row.unit_price);
            table.cell(idx, 8).data(ret_row.amountofmoney);
            table.cell(idx, 9).data(ret_row.use);
            table.cell(idx, 10).data(ret_row.process);
            table.cell(idx, 11).data(ret_row.repertory);
            table.cell(idx, 12).data(ret_row.proposer);
            table.cell(idx, 13).data(ret_row.approver);
            table.cell(idx, 14).data(ret_row.financer);
            table.cell(idx, 15).data(ret_row.purchaser);
            table.cell(idx, 16).data(ret_row.start_time);
            table.cell(idx, 17).data(ret_row.update_time);
            table.draw(true);
        },
        error: function(data) {
            var jsonObj = JSON.parse(data);
            var msg = jsonObj.msg;
            alert('[失败]修改失败: ' + msg);
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
            // 解析json，然后替换前端
            var jsonObj = JSON.parse(data);
            var retCode = jsonObj.code;
            if (retCode != 0) {
                alert('删除失败');
            } else {
                alert('删除成功');
            }
            var table = $('#purchsTable').DataTable();
            var select_tr = '#' + tr_id;
            table.row($(select_tr)).remove().draw(false);
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
