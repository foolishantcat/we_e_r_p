<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-01 21:00:59
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-10 21:05:13
 */
use yii\widgets\LinkPager;
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newTradeModal">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                新建交易
            </button>
        </div>
        <div class="col-md-4">
            <!-- 查询交易组框 -->
            <form class="bs-example bs-example-form" role="form">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">交易编号</span>
                    <input type="text" class="form-control" placeholder="twitterhandle">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">交易名称</span>
                    <input type="text" class="form-control" placeholder="twitterhandle">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">客户ID</span>
                    <input type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">项目ID</span>
                    <input type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">订单ID</span>
                    <input type="text" class="form-control">
                </div>
                <div>
                    <button id="searchTrade" class="btn btn-success" type="button" onclick="search_trade_info()">
                        搜索交易
                    </button>
                    <label for="searchTrade" class="control-label">填写任意项进行搜索</label>
                </div>
            </form>
        </div>
    </div>

    <!-- 新建交易模态框 -->
    <div class="modal fade" id="newTradeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h4 class="modal-title">新建交易</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- 模态框主体 -->
                <div class="modal-body">
                    <div class="alert alert-primary" role="alert">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="tradeTitle" class="col-sm-2 control-label">交易名称*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="tradeTitle"
                                       placeholder="请输入交易名称">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customerId" class="col-sm-2 control-label">客户ID*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="customerId"
                                       placeholder="请输入客户ID">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="projectId" class="col-sm-2 control-label">项目ID*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="projectId"
                                       placeholder="请输入项目ID">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="orderId" class="col-sm-2 control-label">订单ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="orderId"
                                       placeholder="请输入项目ID">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tradeDetail" class="col-sm-2 control-label">详细信息</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tradeDetail"
                                       placeholder="请输入项目ID">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFile" class="col-sm-2 control-label">附件</label>
                                <div class="col-sm-10">
                                    <input type="file" id="inputFile">
                                </div>
                            </div>
                            <p class="help-block">这里是块级帮助文本的实例。</p>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> 请打勾
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- 模态框底部 -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="commit_new_trade()">提交</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 展示信息用的表格 -->
    <table class="table table-striped">
        <thead>
        <tr>
            <th>编号</th>
            <th>名称</th>
            <th>客户ID</th>
            <th>项目ID</th>
            <th>订单ID</th>
            <th>详细信息</th>
            <th>跟单员</th>
            <th>操作员</th>
            <th>开始时间</th>
            <th>更新时间</th>
            <th>结束时间</th>
            <th>状态</th>
            <th>删</th>
            <th>操作</th>
            <th>处理</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($trade_info as $info) {
            echo "<tr>";
            $num = count($info);
            foreach ($info as $k=>$v) {
                echo "<td>";
                echo $v."<br/>";
                echo "</td>";
            }
            // 插入下拉框
            echo "<td>";
            echo '
            <select>
                <option>确认交易</option>
                <option>添加订单</option>
                <option>完成交易</option>
                <option>交易失败</option>
                <option>删除交易</option>
                <option>交易流程</option>
            </select>
            ';
            echo "</td>";
            // 插入提交按键
            echo "<td>";
            echo '
            <button type="button" class="btn btn-success" onclick="commit_handle()">提交</button>
            ';
            echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script>
var req = new XMLHttpRequest();
function search_trade_info() {
    alert("点击了搜索交易");
}

function commit_new_trade() {
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

