<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property string $id ID
 * @property string $order_id 订单ID
 * @property string $type 订单类型
 * @property string $title 订单标题
 * @property string $customer_id
 * @property string $good_id 商品ID
 * @property string $good_name 商品名
 * @property int $good_count 订单商品数量
 * @property int $logis_id
 * @property int $hander_user_id 订单所属人ID
 * @property string $handler 订单所属人
 * @property string $start_time 开始时间
 * @property string $end_time 结束时间
 * @property string $status
 * @property string $update_time 更新时间
 * @property int $del 删除标记
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
            [['customer_id', 'logis_id'], 'required'],
            [['good_count', 'logis_id', 'hander_user_id', 'del'], 'integer'],
            [['start_time', 'end_time', 'update_time'], 'safe'],
            [['order_id', 'customer_id', 'good_id', 'good_name'], 'string', 'max' => 128],
            [['type', 'handler', 'status'], 'string', 'max' => 32],
            [['title'], 'string', 'max' => 64],
            [['order_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'type' => 'Type',
            'title' => 'Title',
            'customer_id' => 'Customer ID',
            'good_id' => 'Good ID',
            'good_name' => 'Good Name',
            'good_count' => 'Good Count',
            'logis_id' => 'Logis ID',
            'hander_user_id' => 'Hander User ID',
            'handler' => 'Handler',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'status' => 'Status',
            'update_time' => 'Update Time',
            'del' => 'Del',
        ];
    }
}
