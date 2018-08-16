<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-06 20:09:47
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-08-16 19:03:33
 */
?>
<div class="container" style="width: 100%;">
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
                        <?php
                            foreach ($d_order_rank as $row) {
                                echo "<tr>";
                                foreach ($row as $k => $v) {
                                    echo "<td>$v</td>";
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
                            <th>排名</th>
                            <th>姓名</th>
                            <th>成交量</th>
                            <th>最新成交时间</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($w_order_rank as $row) {
                                echo "<tr>";
                                foreach ($row as $k => $v) {
                                    echo "<td>$v</td>";
                                }
                                echo "</tr>";
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
                            foreach ($m_order_rank as $row) {
                                echo "<tr>";
                                foreach ($row as $k => $v) {
                                    echo "<td>$v</td>";
                                }
                                echo "</tr>";
                            }
                        ?>
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
            <form id="formSearch" class="bs-example bs-example-form" role="form">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">搜索范围</span>
                    <select id="searchOption" class="selectpicker">
                        <option>日</option>
                        <option>周</option>
                        <option>月</option>
                    </select>
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">员工姓名</span>
                    <input id="staffName" type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">员工编号</span>
                    <input id="staffId" type="text" class="form-control">
                </div>
                <div>
                    <button id="btSearch" class="btn btn-success" type="button" onclick="search_rank(formSearch.searchOption, formSearch.staffName, formSearch.staffId)">
                        搜索排名
                    </button>
                    <label for="btSearch">填一个或者两个</label>
                </div>
            </form>
        </div>
    </div>
    <!-- 展示信息用的表格 -->
    <table id="rankTable" class="table table-striped">
        <thead>
        <tr>
            <th>排名范围</th>
            <th>排名</th>
            <th>员工姓名</th>
            <th>总成交量</th>
            <th>总成交额</th>
            <th>最后成交时间</th>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach ($rank_info as $row) {
                    echo "<tr>";
                    foreach ($row as $k => $v) {
                        echo "<td>$v</td>";
                    }
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<script>
// 初始化界面
$(document).ready(function(){
    $('#rankTable').dataTable({
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

function search_rank(searchOption, staffName, staffId) {
    //目前只支持index.php
    var r_url = "index.php?r=" + "order/order-rank";
    console.log(r_url);
    var m_area = searchOption.value;
    var m_staff_name = staffName.value;
    var m_staff_id = staffId.value;
    console.log(m_area+"|"+m_staff_name+"|"+m_staff_id);
    $.ajax({
        type: 'POST',
        url: r_url,
        dataType: 'HTML',
        data: {
            action: 'search_rank',
            area: m_area,
            staff_name: m_staff_name,
            staff_id: m_staff_id,
        },
        success: function (data) {
            alert('[成功]搜索成功: ' + data);
            // 解析json，然后替换前端
            var jsonObj = JSON.parse(data);
            var tableData = jsonObj.data;
            $("#rankTable tr:gt(0)").remove();//第一行是table的表格头不需清除
            var html = '';
            for(var i=0; i < tableData.length; i++){
                var row = tableData[i];
                var t_area = row.area;
                console.log(t_area);
                var t_rank = row.rank;
                var t_staff_name = row.staff_name;
                var t_deal_count = row.deal_count;
                var t_deal_money = row.deal_money;
                var t_last_deal_time = row.last_deal_time;
                html += "<tr>" +
                "<td>" + t_area + "</td>" +
                "<td>" + t_rank + "</td>" +
                "<td>" + t_staff_name + "</td>" +
                "<td>" + t_deal_count + "</td>" +
                "<td>" + t_deal_money + "</td>" +
                "<td>" + t_last_deal_time + "</td>" +
                "</tr>";
            }
            $("#rankTable").append(html);//将新数据填充到table
        },
        error: function(data) {
            console.log('Error: ' + data);
            alert('[失败]搜索失败');
        }
    });
}
</script>
