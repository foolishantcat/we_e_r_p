<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property string $order_id 订单编号（大写字符串+日期数字）
 * @property string $type 订单类型，如采购，销售
 * @property string $title 订单标题，如：某人的某些订单（只能由数字、字母、汉字组成）
 * @property string $customer_id 客户id，为customer表的外键
 * @property string $good_id 商品id，为goods表外键
 * @property string $good_name 商品名称（只能由数字、字母、汉字组成）
 * @property int $good_count 商品数量，单位“件”
 * @property string $amountofmoney 订单总金额
 * @property string $logis_id 货运单号，为logistic表外键
 * @property string $handler 最后操作人
 * @property string $start_time 订单开始时间
 * @property string $end_time 订单结束时间
 * @property string $status 订单当前状态
 * @property int $del 是否删除订单
 * @property string $update_time 订单最后更新时间
 */
class OrdersDao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['good_count', 'del'], 'integer'],
            [['amountofmoney'], 'number'],
            [['start_time', 'end_time', 'update_time'], 'safe'],
            [['type', 'handler', 'status'], 'string', 'max' => 32],
            [['title'], 'string', 'max' => 64],
            [['customer_id', 'good_id', 'good_name', 'logis_id'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'type' => 'Type',
            'title' => 'Title',
            'customer_id' => 'Customer ID',
            'good_id' => 'Good ID',
            'good_name' => 'Good Name',
            'good_count' => 'Good Count',
            'amountofmoney' => 'Amountofmoney',
            'logis_id' => 'Logis ID',
            'handler' => 'Handler',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'status' => 'Status',
            'del' => 'Del',
            'update_time' => 'Update Time',
        ];
    }
}
