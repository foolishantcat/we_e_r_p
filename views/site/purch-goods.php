<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-07-10 20:58:56
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-07-11 19:58:18
 */
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newTradeModal">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                新建商品采购
            </button>
        </div>
        <div class="col-md-4">
            <!-- 查询采购商品显示 -->
            <form class="bs-example bs-example-form" role="form">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">采购编号</span>
                    <input type="text" class="form-control" placeholder="twitterhandle">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">标题</span>
                    <input type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">订单编号</span>
                    <input type="text" class="form-control" placeholder="twitterhandle">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">采购员ID</span>
                    <input type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">采购员</span>
                    <input type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">商品ID</span>
                    <input type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">商品名称</span>
                    <input type="text" class="form-control">
                </div>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">物流编号</span>
                    <input type="text" class="form-control">
                </div>
                <div>
                    <button id="searchTrade" class="btn btn-success" type="button" onclick="search_purch_info()">
                        搜索采购订单
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
                    <h4 class="modal-title">新建商品采购</h4>
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
                                <label for="goodsId" class="col-sm-2 control-label">商品ID*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="goodsId"
                                       placeholder="请输入项目ID">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="goodsName" class="col-sm-2 control-label">商品名称</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="goodsName"
                                       placeholder="请输入项目ID">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="goodsCount" class="col-sm-2 control-label">商品数量</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="goodsCount"
                                       placeholder="请输入项目ID">
                                </div>
                            </div>
                            <p class="help-block">这里是块级帮助文本的实例。</p>
                        </form>
                    </div>
                </div>
                <!-- 模态框底部 -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="commit_new_purchase()">提交</button>
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
            <th>订单ID</th>
            <th>商品ID</th>
            <th>商品名称</th>
            <th>商品数量</th>
            <th>单价</th>
            <th>总额</th>
            <th>物流信息</th>
            <th>员工ID</th>
            <th>跟单员</th>
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
        foreach ($purch_info as $info) {
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
                <option>同意采购</option>
                <option>创建订单</option>
                <option>绑定物流</option>
                <option>采购结束</option>
                <option>删除采单</option>
                <option>采购流程</option>
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
function search_purch_info() {
    alert("点击了搜索交易");
}

function commit_new_purchase() {
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
