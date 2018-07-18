/*
* @Author: caoyicheng_cd
* @Date:   2018-06-11 22:12:38
* @Last Modified by:   caoyicheng_cd
* @Last Modified time: 2018-07-18 21:17:46
*/

-------------------权限管理-------------------START
create table auth(
    auth_id         varchar(128)    not null primary key,
    -- 当前权限分为5个等级:
    -- 1 : 普通权限，所有员工所有
    -- 2 : 普通管理权限（业务层）
    -- 3 : 财务相关管理权限
    -- 4 ： 高于财务相关权限，低于老板权限
    -- 5 : 老板权限（最高权限）
    -- 1314 : 运维RD权限（上帝权限）
    authcode        int(32)         not null default 1,
    level           varchar(32)     not null default 'item',    -- 限定的项目，catlog，bar，item
    item            varchar(64)     not null default '', -- 项目内容，如交易管理（bar）
    visibility      int             not null default 1, -- 是否可见，1-可见，0-不可见
    status          varchar(64)     default '正常',
    del             int             default 0
);

-- 审批权限管理，主要是管理审批需要到哪一个级别
create table approve_auth(
    approve_auth_id varchar(128)    not null primary key,
    action          varchar(32)     not null default 'leave', -- 需要审批的项目,如：请假
    -- 审批需要到的权限
    -- 1 ： 直属领导
    -- 2 : 财务审批
    -- 3 : 高于财务相关权限，低于老板权限
    -- 4 : 老板审批
    ap_authcode     int(32)         not null default 1,     -- 需要审批到的最高权限等级
);
-------------------权限管理-------------------END

-------------------流程管理-------------------Start
create table flow(
    flow_id         varchar(128)    not null primary key,
    relate_module   varchar(32)     not null default '',    -- 相关的模块，如请假leave
    relate_id       varchar(128)    not null default '',
    flow_status     varchar(256)    not null default '', -- 如：发起,**同意，财务同意-->
    next_handler_id varchar(128)    not null default 'END',
    next_handler    varchar(32)     not null default '义成',
    detail          varchar(500)    not null default '',
    status          varchar(32)     not null default '不同意',
    del             int             default 0
);
-------------------流程管理-------------------End

-- 导航栏设置
create table nav(
    catalog_id      varchar(64)     not null,   -- 导航一分类
    bar_id          varchar(64)     default '',   -- 导航左侧栏一级导航
    item_id         varchar(64)     default '',   -- 导航左侧栏二级导航（目前最多支持到二级导航）
    level           varchar(32)     not null default 'item',    -- 导航栏级别
    authcode        int(32)         not null default 1, -- 1为默认权限
    seq_num         int(32)         not null default 0,   -- 导航位置顺序索引,从0开始计数
    view            varchar(256)    default 'site/welcome',   -- 重定向页面
    status          varchar(64)     default '正常',
    del             int             default 0
);

insert into nav(catalog_id, bar_id, level, seq_num) values ('进销存系统', '订单管理', 'bar', 0);
insert into nav(catalog_id, bar_id, level, seq_num) values ('进销存系统', '采购管理', 'bar', 1);
insert into nav(catalog_id, bar_id, level, seq_num) values ('进销存系统', '仓库管理', 'bar', 2);
insert into nav(catalog_id, bar_id, level, seq_num) values ('进销存系统', '待办事项', 'bar', 3);

insert into nav values ('进销存系统', '订单管理', '订单详情', 'item', 1, 0, 'order/order-info','正常', 0);
insert into nav values ('进销存系统', '订单管理', '销售榜单', 'item', 1, 1, 'order/order-rank','正常', 0);

insert into nav values ('进销存系统', '采购管理', '商品物料', 'item', 1, 0, 'purch/pruch-goods','正常', 0);
insert into nav values ('进销存系统', '采购管理', '办公设备', 'item', 1, 1, 'purch/purch-office', '正常', 0);

insert into nav values ('进销存系统', '仓库管理', '库存信息', 'item', 1, 0, 'reper/reper-stock', '正常', 0);
insert into nav values ('进销存系统', '仓库管理', '仓库信息', 'item', 1, 1, 'reper/reper-info', '正常', 0);
insert into nav values ('进销存系统', '仓库管理', '领用信息', 'item', 1, 2, 'reper/reper-lend', '正常', 0);
insert into nav values ('进销存系统', '仓库管理', '出入库申请', 'item', 1, 3, 'reper/reper-inout', '正常', 0);
insert into nav values ('进销存系统', '仓库管理', '退料管理', 'item', 1, 4, 'reper/reper-return', '正常', 0);
insert into nav values ('进销存系统', '仓库管理', '废料管理', 'item', 1, 5, 'reper/reper-rubbish', '正常', 0);

insert into nav values ('进销存系统', '待办事项', '流程审批', 'item', 1, 0, 'jxcitem/flow-approve', '正常', 0);


-------以下属于进销存系统-------------
-- 交易管理Trade management
create table trade(
    trade_id        varchar(128)    not null primary key,
    title           varchar(64)     default '',     -- 交易名称
    customer_id     varchar(128)    default null,
    project_id      int(64)         default null,     -- 关联项目
    order_id        int(64)         default null,     -- 订单id
    detail          varchar(1000)   default '',     -- 详细交易信息
    dealer          varchar(32)     default '义成',   -- 跟单员
    handler         varchar(32)     default '义成',   -- 操作员
    start_time      datetime        default NULL,
    update_time     datetime        default NULL,
    end_time        datetime        default NULL,
    status          varchar(32)     default '',
    del             int             default 0
);
insert into trade values (
    '1',
    '第1笔交易',
    'caoyicheng',
    1,
    1,
    '买卖田鼠',
    '义成',
    '义成',
    '2018-07-03 21:42:01',
    NULL, NULL, '', 0);

-- 订单管理
create table orders(
    order_id        varchar(128)    not null primary key,
    type            varchar(32)     not null,   -- 订单类型，如采购，销售
    title           varchar(64)     default '',
    customer_id     varchar(128)    not null,
    good_id         varchar(128)    not null,   -- 商品编号
    good_name       varchar(128)    not null,
    good_count      int(32)         not null,
    amountofmoney   DECIMAL(9,2)    not null default 0.00,  -- 订单金额
    logis_id        varchar(128)    default null,   -- 物流信息id
    handler         varchar(32)     default '义成',
    start_time      datetime        default NULL,
    update_time     datetime        default NULL,
    end_time        datetime        default NULL,
    status          varchar(32)     default '',
    del             int             default 0
);
insert into orders values (
    '2',
    '采购订单',
    '王大爷的订单',
    '1',
    'pingguo',
    '铅笔',
    200,
    1024.0,
    '圆通2134234',
    '雪辉',
    '2018-07-09 10:42:01',
    '2018-07-09 23:42:01',
    '2018-07-03 21:42:01',
    '未成交',
    0
);

-- 商品管理(类别)
create table goods(
    goods_id        varchar(128)    not null primary key,
    good_name       varchar(128)    not null,
    kind            varchar(32)     not null,
    detail          varchar(1000)   default '',
    type            varchar(32)     default '库存商品',   -- 其他，例如：需求商品,未上架，已下架
    handler         varchar(32)     default '义成',
    start_time      datetime        default NULL,
    update_date     datetime        default NULL,
    status          varchar(32)     default '',
    del             int             default 0
);

insert into goods values(
    'B456',
    '铅笔',
    '文具',
    '日本进口',
    '已上架',
    '义成',
    '2018-07-11 11:00:01',
    '2018-07-11 11:00:01',
    '正常',
    0
);

-- 采购管理
create table purchase(
    purch_id        varchar(128)    not null primary key,
    title           varchar(64)     default '',
    order_id        varchar(128)    default NULL,   -- 采购订单
    staff_id        varchar(128)    default '',     -- 员工编号
    handler         varchar(32)     default '义成', -- 员工名字
    start_time      datetime        default NULL,
    update_time     datetime        default NULL,
    end_time        datetime        default NULL,
    status          varchar(32)     default '',
    del             int             default 0
);

insert into purchase values (
    'P123',
    '销售部采购计划',
    '2',
    'C123',
    '义成',
    '2018-07-11 12:00:01',
    '2018-07-11 12:00:01',
    '2018-07-11 12:00:01',
    '正常',
    0
);

-- 库存管理Supply management
create table supply(
    supply_id       varchar(128)    not null primary key,
    title           varchar(128)    default '',
    manager         varchar(32)     default '义成',
    good_id         int(64)         not null,
    good_name       varchar(128)    not null,
    kind            varchar(32)     not null,
    index_no        varchar(64)     default '', -- 商品索引号
    repertory_id    int(32)         not null,
    repertory_name  varchar(64)     default '',
    source          varchar(64)     default '', -- 库存来源
    checkup         varchar(32)     default '合格', -- 仓库检验
    start_time      datetime        default NULL,
    update_time     datetime        default NULL,
    status          varchar(32)     default '正常',
    del             int             default 0
);

-- 仓库信息
create table repertory(
    repertory_id    varchar(128)    not null primary key,
    repertory_name  varchar(64)     default '',
    work_week       varchar(32)     default '1,2,3,4,5,6',
    work_time       varchar(64)     default '[08:30:00, 12:00:00][13:30:00, 17:30:00]',
    manager         varchar(64)     default '义成',
    update_time     datetime        default NULL,
    status          varchar(64)     default '',
    del             int             default 0
);

-- 物流公司logistics
create table logi_company(
    company_id      varchar(128)    not null primary key,
    company         varchar(128)    not null,   -- 物流公司名称
    create_time     datetime        default NULL,
    update_time     datetime        default NULL,
    handler         varchar(32)     default '义成',
    status          varchar(32)     default '',
    del             int             0
);

-- 商品物流信息
create table logistics(
    logis_id        varchar(128)    not null primary key,
    title           varchar(128)    not null,
    detail          varchar(1000)   default '',
    type            varchar(32)     default '',     -- 物流信息类型，如商品物流，仓储物流
    company_id      int(64)         default NULL,
    create_time     datetime        default NULL,
    update_time     datetime        default NULL,
    end_time        datetime        default NULL,
    status          varchar(32)     default '',
    del             int             0
);

-----------------进销存系统--------------END
insert into nav(catalog_id, bar_id, level, seq_num) values ('客户管理系统', '客户信息', 'bar', 0);
insert into nav(catalog_id, bar_id, level, seq_num) values ('客户管理系统', '客户关怀', 'bar', 1);
insert into nav(catalog_id, bar_id, level, seq_num) values ('客户管理系统', '需求信息', 'bar', 2);
insert into nav(catalog_id, bar_id, level, seq_num) values ('客户管理系统', '售后服务', 'bar', 3);
insert into nav(catalog_id, bar_id, level, seq_num) values ('客户管理系统', '客户团队', 'bar', 4);
insert into nav(catalog_id, bar_id, level, seq_num) values ('客户管理系统', '客户挖掘', 'bar', 5);
insert into nav(catalog_id, bar_id, level, seq_num) values ('客户管理系统', '代理渠道', 'bar', 6);

insert into nav values ('客户管理系统', '客户信息', '特征画像', 'item', 1, 0, 'site/client_info', '正常', 0);
insert into nav values ('客户管理系统', '客户信息', '客户项目', 'item', 1, 1, 'site/client_project', '正常', 0);
insert into nav values ('客户管理系统', '客户信息', '合同信息', 'item', 1, 2, 'site/client_contract','正常', 0);

insert into nav values ('客户管理系统', '客户关怀', '礼品申请', 'item', 1, 0, 'site/client_gift_ask','正常', 0);
insert into nav values ('客户管理系统', '客户关怀', '往期关怀', 'item', 1, 1, 'site/client_gift_history','正常', 0);

insert into nav values ('客户管理系统', '需求信息', '查询需求', 'item', 1, 0, 'site/client_demand', '正常', 0);
insert into nav values ('客户管理系统', '需求信息', '分析需求', 'item', 1, 1, 'site/client_demand_analysis','正常', 0);

insert into nav values ('客户管理系统', '售后服务', '申请售后', 'item', 1, 0, 'site/client_service','正常', 0);
insert into nav values ('客户管理系统', '售后服务', '服务记录', 'item', 1, 1, 'site/client_service_history','正常', 0);

insert into nav values ('客户管理系统', '客户团队', '大客户信息', 'item', 1, 0, 'site/client_important','正常', 0);
insert into nav values ('客户管理系统', '客户团队', '团队跟踪', 'item', 1, 1, 'site/client_follow','正常', 0);

insert into nav values ('客户管理系统', '代理渠道', '代理管理', 'item', 1, 1, 'site/client_proxy','正常', 0);
insert into nav values ('客户管理系统', '代理渠道', '渠道分析', 'item', 1, 2, 'site/clinet_proxy_analysis','正常', 0);


-----------------客户关系管理-------------START
-- 客户关系管理customer relationship management
-- 客户基本资料管理
create table customer(
    customer_id     varchar(128)    not null primary key,
    group_id        int(64)         default NULL,   -- 客户所属团队
    name_ch         varchar(64)     not null default '',
    age             int(32)         null,
    education       varchar(64)     null,
    profession      varchar(64)     null,
    company         varchar(64)     null,
    country         varchar(64)     null,
    city            varchar(64)     null,
    address         varchar(128)    null,
    birthday        datetime        default NULL,
    phone           varchar(64)     null,
    email           varchar(64)     null,
    level           int             not null default 1,
    proxy           int             default 0,  -- 是否渠道代理
    follow_degree   int             not null default 1, -- 跟进程度
    satisfied       int             not null default 7, -- 满意度
    start_time      datetime        default NULL,
    update_time     datetime        default NULL,
    status          varchar(64)     not null default '',
    del             int             default 0
);

-- 客户礼品
create table gift(
    gift_id         varchar(128)    not null primary key,
    title           varchar(64)     not null,
    detail          varchar(1000)   default '',
    project_id      int(64)         default NULL,
    customer_id     int(64)         not null,
    group_id        int(64)         default NULL,
    amountofmoney   DECIMAL(9,2)    not null default 0.00,  -- 礼品金额
    handler         varchar(32)     not null default '义成', -- 经手人
    update_time     datetime        default NULL,
    status          varchar(32)     default '',
    del             int             default 0
);

-- 项目管理
create table project(
    project_id      varchar(128)    not null primary key,
    title           varchar(128)    not null,
    detail          varchar(100)    default '',
    manager         varchar(32)     not null,
    handler         varchar(32)     not null,
    start_time      datetime        default NULL,
    update_time     datetime        default NULL,
    end_time        datetime        default NULL,
    status          varchar(32)     default '',
    del             int             default 0
);

-- 合同管理
create table contract(
    contract_id     varchar(128)    not null primary key,
    title           varchar(64)     not null default '',
    handler         varchar(32)     not null,
    index_address   varchar(128)    not null default '',
    start_time      datetime        default NULL,
    update_time     datetime        default NULL,
    end_time        datetime        default NULL,
    status          varchar(64)     not null default '',
    del             int             default 0
);

-- 需求管理
create table demand(
    demand_id       varchar(128)    not null primary key,
    title           varchar(128)    not null,
    kind            varchar(32)     not null,
    detail          varchar(1000)   default '',
    goods_id        int(64)         default 0,  -- 需求商品的识别码
    priority        int(32)         default 1,  -- 客户需求优先级
    handler         varchar(32)     default '义成',
    start_time      datetime        default NULL,
    update_date     datetime        default NULL,
    status          varchar(32)     default '',
    del             int             default 0
);

-- 售后服务
create table service(
    service_id      varchar(128)    not null primary key,
    title           varchar(128)    not null,
    type            varchar(128)    not null,   -- 售后服务的类型
    detail          varchar(1000)   default '',
    feedback        varchar(1000)   default '', -- 用户反馈
    manager         varchar(32)     default '', -- 服务负责人
    handler         varchar(32)     default '', -- 处理人
    phone           varchar(32)     default '', -- 处理人联系电话
    start_time      datetime        default NULL,
    update_time     datetime        default NULL,
    end_time        datetime        default NULL,
    status          varchar(32)     default '', -- 售后服务进度,如:已预约
    del             int             0
);

-- 电话反馈和咨询(用于客户挖掘)
create table consult(
    consult_id      varchar(128)    not null primary key,
    title           varchar(128)    not null,
    kind            varchar(32)     default '', -- 业务类型
    name            varchar(32)     not null,
    age             int(32)         default NULL,
    phone           varchar(32)     default NULL,
    detail          varchar(1000)   default '',
    type            varchar(32)     default '咨询', -- 对话类型，其他，例如：投诉，建议,拜访
    start_time      datetime        default NULL,
    end_time        datetime        default NULL,
    status          varchar(32)     default '',
    del             int             0
);

-----------------------客户关系管理---------------END
insert into nav(catalog_id, bar_id, level, seq_num) values ('财务管理系统', '固定资产', 'bar', 0);
insert into nav(catalog_id, bar_id, level, seq_num) values ('财务管理系统', '现金管理', 'bar', 1);
insert into nav(catalog_id, bar_id, level, seq_num) values ('财务管理系统', '应收款项', 'bar', 2);
insert into nav(catalog_id, bar_id, level, seq_num) values ('财务管理系统', '应付款项', 'bar', 3);
insert into nav(catalog_id, bar_id, level, seq_num) values ('财务管理系统', '薪资管理', 'bar', 4);
insert into nav(catalog_id, bar_id, level, seq_num) values ('财务管理系统', '报销管理', 'bar', 5);

insert into nav values ('财务管理系统', '固定资产', '资产信息', 'item', 3, 0, 'site/permanent_info', '正常', 0);
insert into nav values ('财务管理系统', '现金管理', '现金信息', 'item', 5, 0, 'site/cash_info', '正常', 0);
insert into nav values ('财务管理系统', '应收款项', '应收款管理', 'item', 3, 0, 'site/receivable_mgr', '正常', 0);
insert into nav values ('财务管理系统', '应付款项', '应付款管理', 'item', 3, 0, 'site/payable_mgr', '正常', 0);
insert into nav values ('财务管理系统', '薪资管理', '员工薪资管理', 'item', 5, 0, 'site/salary_mgr', '正常', 0);
insert into nav values ('财务管理系统', '薪资管理', '员工薪资信息', 'item', 3, 1, 'site/salary_info', '正常', 0);
insert into nav values ('财务管理系统', '报销管理', '员工报销审批', 'item', 4, 0, 'site/claim_approve', '正常', 0);
---------------------财务管理-------------------START
-- 财务系统Agile financial management system
-- 包含：
--总账、报表、现金管理、固定资产管理、应收款管理、 应付款管理、财务分析、人事/薪资管理、报销管理、出差申请
-- 固定资产管理
create table permanent(
    permanent_id    varchar(128)    not null primary key,
    name            varchar(32)     not null default '',
    manager         varchar(32)     not null default 'ethan',
    start_time      datetime        default NULL,
    end_time        datetime        default NULL,
    status          varchar(64)     default '',
    del             int             default 0
);
-- 现金管理
create table cash(
    cash_id         varchar(128)    not null primary key,
    manager         varchar(32)     not null default 'ethan',
    amountofmoney   DECIMAL(9,2)    not null default 0.00,
    isfrom          varchar(32)     not null default '',
    start_time      datetime        default NULL,
    update_time     datetime        default NULL,
    status          varchar(64)     default '',
    del             int             default 0
);
-- 应收款管理
create table toreceive(
    receive_id      varchar(128)    not null primary key,
    type            varchar(32)     not null default '', -- 订金，尾款，租金，违约金
    title           varchar(64)     not null default '',
    detail          varchar(256)    not null default '',
    proposer        varchar(32)     not null default '义成',  -- 发起人，申请人
    handler         varchar(32)     not null default '义成',
    amountofmoney   DECIMAL(9,2)    not null default 0.00,
    isdelay         int             default 0,
    reason          varchar(1000)   default '',
    deadline        datetime        default NULL,
    status          varchar(32)     default '未收款',
    del             int             default 0
);
-- 应付款管理
create table topay(
    pay_id          varchar(128)    not null primary key,
    type            varchar(32)     not null default '', -- 采购，物流，工资，报销，租金，广告
    title           varchar(64)     not null default '',
    detail          varchar(256)    not null default '',
    proposer        varchar(32)     not null default '义成',  -- 发起人，申请人
    handler         varchar(32)     not null default '义成',
    amountofmoney   DECIMAL(9,2)    not null default 0.00,
    isdelay         int             default 0,
    reason          varchar(1000)   default '',
    deadline        datetime        default NULL,
    status          varchar(32)     default '未付款',
    del             int             default 0
);
-- 薪资管理
create table salary(
    salary_id       varchar(128)    not null primary key,
    type            varchar(32)     not null default '工资', -- 工资，绩效奖金，年终奖金
    staff_id        varchar(128)    not null,
    name_ch         varchar(64)     not null,
    age             int             not null,
    amountofmoney   DECIMAL(9,2)    not null default 0.00,
    salary_day      datetime        default NULL,
    work_time       float           default 0.0,    -- 一个月考勤工作时间
    unit_price      DECIMAL(9,2)    not null default 0.00, -- 时薪
    month_price     DECIMAL(9,2)    not null default 0.00, -- 月薪
    bonus           DECIMAL(9,2)    not null default 0.00, -- 奖金
    status          varchar(32)     default '',
    del             int             default 0
);
-- 绩效管理
create table performance(
    perform_id      varchar(128)    not null primary key,
    staff_id        varchar(128)    not null default '',
);
-- 报销管理
create table claim(
    claim_id        varchar(128)    not null primary key,
    name            varchar(64)     not null,
    kind            varchar(32)     not null, -- 报销类型
    index_id        int(32)         not null, -- 索引id
    claim_detail    varchar(1000)   not null, -- 报销详细说明
    status          varchar(32)     not null,
    del             int             default 0
);

----------------------财务管理----------------------END
insert into nav(catalog_id, bar_id, level, seq_num) values ('ERP', '员工信息', 'bar', 0);
insert into nav(catalog_id, bar_id, level, seq_num) values ('ERP', '差旅管理', 'bar', 1);
insert into nav(catalog_id, bar_id, level, seq_num) values ('ERP', '假期管理', 'bar', 2);
insert into nav(catalog_id, bar_id, level, seq_num) values ('ERP', '工资查询', 'bar', 3);

insert into nav values ('ERP', '员工信息', '我的信息', 'item', 1, 0, 'site/staff_info', '正常', 0);
insert into nav values ('ERP', '员工信息', '员工信息管理', 'item', 4, 1, 'site/staff_mgr', '正常', 0);
insert into nav values ('ERP', '差旅管理', '差旅申请', 'item', 1, 0, 'site/trip_ask', '正常', 0);
insert into nav values ('ERP', '差旅管理', '差旅审批', 'item', 4, 1, 'site/trip_approve', '正常', 0);
insert into nav values ('ERP', '假期管理', '假期信息', 'item', 1, 0, 'site/leave_info', '正常', 0);
insert into nav values ('ERP', '假期管理', '休假批准', 'item', 4, 1, 'site/leave_mgr', '正常', 0);
insert into nav values ('ERP', '工资查询', '我的工资条', 'item', 1, 0, 'site/salary_info', '正常', 0);

----------------------ERP--------------------------START
-- 账户管理
create table staff(
    staff_id        varchar(128)    not null primary key,
    staff_name      varchar(32)     not null,
    group           varchar(32)     not null,   -- 所属组
    age             int             not null,
    education       varchar(64)     not null,
    role            varchar(32)     not null default 'staff',   -- 员工角色
    authcode        int(32)         not null default 1, -- 授权码
    higher_ups_id   varchar(128)    not null default '',    -- 上级ID
    higher_ups      varchar(32)     not null default '',    -- 上级名字
    entry_time      datetime        default NULL,
    update_date     datetime        default NULL,
    status          varchar(32)     not null default '活跃用户',
    del             int             not null default 0
);
-- 出差管理
create table trip(
    trip_id         varchar(128)    not null primary key,
    title           varchar(64)     not null,   -- 标题
    reason          varchar(1000)   not null,   -- 出差原因
    start_address   varchar(32)     not null,
    dest_address    varchar(32)     not null,
    duration        DECIMAL(9,1)    not null default 1.0, -- 出差时长
    budget          DECIMAL(9,2)    not null default 0.00, -- 预算差旅补贴
    budget_detail   varchar(1000)   not null,  -- 详细差旅补贴说明
    status          varchar(32)     not null,
    del             int             default 0
);
-- 请假申请
create table leave(
    leave_id        varchar(128)    not null primary key,
    staff_id        int(32)         not null,
    staff_name      varchar(32)     not null,
    title           varchar(128)    not null,
    detail          varchar(1000)   not null,
    req_time        datetime        default NULL,   -- 申请时间
    update_time     datetime        default NULL,   -- 更新时间
    start_time      datetime        default NULL,   -- 假期开始时间
    end_time        datetime        default NULL,   -- 假期结束时间
    status          varchar(32)     default '',
    del             int             0
);
-- 假期管理
create table vacation(
    leave_id        varchar(128)    not null primary key,
    staff_id        int(32)         not null,
    staff_name      varchar(32)     not null,
    vac_month       int(32)         not null,   -- 当月可修假
    vac_year        int(32)         not null,   -- 当年可修假期
    vac_sum         int(32)         not null,   -- 总计可修假期
    update_time     datetime        default NULL,
    status          varchar(32)     default '',
    del             int             0
);
---------------------ERP---------------------------END

---------------------售后服务------------------------START
-- 售后服务
create table ass(
    item_id         varchar(128)    not null primary key,
    catalog_id      int(32)         not null default 0,
    bar_id          int(32)         not null default 0,
    item_name       varchar(128)    not null default '客户反馈',
    bar_name        varchar(128)    not null default '售后服务',
    catalog_name    varchar(128)    not null default 'ass',
    visible         int             default 0
);
----------------------售后服务-------------------------END

--------------------系统设置------------------------START
-- 系统设置
create table setting(
    set_id          varchar(128)    not null primary key,
    status          varchar(32)     not null,
    del             int             default 0
);
--------------------系统设置------------------------END

--------------------公司管理（老板页面）-------------START
insert into nav(catalog_id, bar_id, level, seq_num) values ('公司管理', '员工管理', 'bar', 0);
insert into nav(catalog_id, bar_id, level, seq_num) values ('公司管理', '审批管理', 'bar', 1);

insert into nav values ('公司管理', '员工管理', '入职/转正审批', 'item', 5, 0, 'site/transform_mgr', '正常', 0);
insert into nav values ('公司管理', '员工管理', '离职审批', 'item', 5, 1, 'site/leave_approve', '正常', 0);
insert into nav values ('公司管理', '员工管理', '权限管理', 'item', 5, 2, 'site/auth_mgr', '正常', 0);
insert into nav values ('公司管理', '审批管理', '差旅审批', 'item', 5, 0, 'site/trip_approve', '正常', 0);
insert into nav values ('公司管理', '审批管理', '休假审批', 'item', 5, 1, 'site/leave_mgr', '正常', 0);
insert into nav values ('公司管理', '工资管理', '工资调整', 'item', 5, 0, 'site/salary_info', '正常', 0);
--------------------公司管理（老板页面）-------------END
