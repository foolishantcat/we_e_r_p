<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-26 15:14:32
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-30 20:39:26
 */
?>
<div id="contentPurch" class="container" style="width: 100%;">
    <h2>办公设备<span class="glyphicon glyphicon-fire" aria-hidden="true"></span></h2>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newOffice">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                新建办公设备
            </button>
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#searchOffice">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                搜索设备
            </button>
        </div>

        <!-- 新建交易模态框 -->
        <div class="modal fade" id="newOffice">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- 模态框头部 -->
                    <div class="modal-header">
                        <h4 class="modal-title">新建办公设备</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- 模态框主体 -->
                    <div class="modal-body">
                        <div class="alert alert-primary" role="alert">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="newDevName" class="col-sm-2 control-label">设备名称*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="newDevName"
                                           placeholder="请输入设备名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="newDevKind" class="col-sm-2 control-label">类别*</label>
                                    <div class="col-sm-10">
                                        <select id="newDevKind" class="selectpicker">
                                            <option>文娱</option>
                                            <option>装修</option>
                                            <option>耗材</option>
                                            <option>员工使用</option>
                                            <option>其他</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="newDevAttr" class="col-sm-2 control-label">属性*</label>
                                    <div class="col-sm-10">
                                        <select id="newDevAttr" class="selectpicker">
                                            <option>消耗品</option>
                                            <option>固定资产</option>
                                            <option>非固定资产</option>
                                            <option>其他</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="newDevDetail" class="col-sm-2 control-label">详细信息</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="newDevDetail"
                                           placeholder="请输入设备详细描述信息">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- 模态框底部 -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="commit_new_office()">提交</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="searchOffice" class="col-md-4 collapse" >
            <!-- 查询办公设备 -->
            <form id="formSearch" class="bs-example bs-example-form" role="form">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">设备编号</span>
                    <input id="searchDevId" type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">设备名称</span>
                    <input id="searchDevName" type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">类别</span>
                    <!-- 这里需要从后台获取数据,类别 -->
                    <select id='selectDevKind' class='selectpicker'>
                        <option>文娱</option>
                        <option>装修</option>
                        <option>耗材</option>
                        <option>员工使用</option>
                        <option>其他</option>
                    </select>
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">设备属性</span>
                    <!-- 这里需要从后台获取数据,类别 -->
                    <select id='selectDevAttr' class='selectpicker'>
                        <option>消耗品</option>
                        <option>固定资产</option>
                        <option>非固定资产</option>
                        <option>其他</option>
                    </select>
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">操作员</span>
                    <input id="handler" type="text" class="form-control">
                </div>
                <div>
                    <button id="btSearchOffice" class="btn btn-success" type="button" onclick="search_office(formSearch.searchDevId, formSearch.searchDevName, formSearch.selectDevKind,formSearch.selectDevAttr)">
                        搜一下
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 展示信息用的表格 -->
    <table id="officeTable" class="table table-bordered table-striped" style="width: 100%;">
        <thead>
        <tr>
            <th>设备编号</th>
            <th>设备名称</th>
            <th>类别</th>
            <th>属性</th>
            <th>详细信息</th>
            <th>操作员</th>
            <th>开始时间</th>
            <th>更新时间</th>
            <th>状态</th>
            <th>操作</th>
            <th>处理</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php
                foreach ($office_info as $row) {
                    echo "<tr>";
                    foreach($row as $k => $v) {
                        echo "<td>";
                        echo "$v" . "";
                        echo "</td>";
                    }
                    $select_id = "item".$row['office_id'];
                    echo "<td>";
                    echo "<select id='$select_id' class='selectpicker'>";
                    echo "<option>采购申请</option>";
                    echo "<option>修改</option>";
                    echo "<option>报废</option>";
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

function commit_new_office() {
    //目前只支持index.php
    var r_url = "index.php?r=" + "purch/purch-office";
    console.log(r_url);
    var m_office_name = document.getElementById('newDevName').value;
    var m_office_kind = document.getElementById('newDevKind').value;
    var m_office_attr = document.getElementById('newDevAttr').value;
    var m_office_detail = document.getElementById('newDevDetail').value;
    console.log(m_office_name+"|"+m_office_kind+"|"+m_office_attr+"|"+m_office_detail);
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            action: 'new_office',
            office_name: m_office_name,
            kind: m_office_kind,
            attr: m_office_attr,
            detail: m_office_detail,
        },
        success: function (data) {
            var jsonObj = JSON.parse(data);
            var tableData = jsonObj.data;
            alert('[成功]新增设备: ' + tableData);
            var html = '';
            var row = tableData;
            var t_office_id = row.office_id;
            var t_office_name = row.office_name;
            var t_kind = row.kind;
            var t_attr = row.attr;
            var t_detail = row.detail;
            var t_handler = row.handler;
            var t_start_time = row.start_time;
            var t_update_time = row.update_time;
            var t_status = row.status;
            // 根据order_id 获取 select_id
            var select_id = "item" + t_office_id;
            html += "<td>" + t_office_id + "</td>" +
            "<td>" + t_office_name + "</td>" +
            "<td>" + t_kind + "</td>" +
            "<td>" + t_attr + "</td>" +
            "<td>" + t_detail + "</td>" +
            "<td>" + t_handler + "</td>" +
            "<td>" + t_start_time + "</td>" +
            "<td>" + t_update_time + "</td>" +
            "<td>" + t_status + "</td>" +
            "<td>" +
                "<select id='" + select_id + "' class='selectpicker'>" +
                    "<option>采购申请</option>" +
                    "<option>修改</option>" +
                    "<option>报废</option>" +
                    "<option>删除</option>" +
                "</select>" +
            "</td>" +
            "<td>" +
                "<button type='button' class='btn btn-success' onclick='commit_handle(" + select_id + ")'>提交</button>" +
            "</td>";

            $("#officeTable tr:eq(1)").prepend(html);//将新数据填充到table第一条数据
        },
        error: function(data) {
            console.log('Error: ' + data);
            alert('[失败]新增交易');
        }
    });
}

function search_office(searchDevId, searchDevName, selectDevKind, selectDevAttr) {
    //目前只支持index.php
    var r_url = "index.php?r=" + "purch/purch-office";
    console.log(r_url);
    var m_office_id = searchDevId.value;
    var m_office_name = searchDevName.value;
    var m_kind = selectDevKind.value;
    var m_attr = selectDevAttr.value;
    console.log(m_office_id+"|"+m_office_name+"|"+m_kind+"|"+m_attr);
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            action: 'search_office',
            office_id: m_office_id,
            office_name: m_office_name,
            kind: m_kind,
            attr: m_attr,
        },
        success: function (data) {
            alert('[成功]搜索成功: ' + data);
            // 解析json，然后替换前端
            var jsonObj = JSON.parse(data);
            var tableData = jsonObj.data;
            $("#officeTable tr:gt(0)").remove();//第一行是table的表格头不需清除
            var html = '';
            for(var i=0; i < tableData.length; i++){
                var jsonObj = JSON.parse(data);
                var tableData = jsonObj.data;
                var row = tableData;
                var t_office_id = row.office_id;
                var t_office_name = row.office_name;
                var t_kind = row.kind;
                var t_attr = row.attr;
                var t_detail = row.detail;
                var t_status = row.status;
                var t_handler = row.handler;
                var t_start_time = row.start_time;
                var t_update_time = row.update_time;
                // 根据order_id 获取 select_id
                var select_id = "item" + t_office_id;
                html += "<tr>" + "<td>" + t_office_id + "</td>" +
                "<td>" + t_office_name + "</td>" +
                "<td>" + t_kind + "</td>" +
                "<td>" + t_attr + "</td>" +
                "<td>" + t_detail + "</td>" +
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
            $("#officeTable").append(html);//将新数据填充到table
        },
        error: function(data) {
            console.log('Error: ' + data);
            alert('[失败]搜索失败');
        }
    });
}

function commit_handle(obj) {
    //目前只支持index.php
    var r_url = "index.php?r=" + "purch/purch-office";
    console.log(r_url);
    var m_office_id = obj.id.split('item')[1];
    var m_handle = obj.value;
    console.log(m_office_id+"|"+m_handle);
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            action: 'commit_handle',
            office_id: m_office_id,
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
