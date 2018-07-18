<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trade".
 *
 * @property string $id
 * @property string $trade_id 交易编号
 * @property string $title 交易名称
 * @property string $customer_id 顾客ID
 * @property int $project_id 项目ID
 * @property int $order_id 订单ID
 * @property string $detail 详细信息
 * @property string $dealer 跟单员
 * @property string $handler 操作员
 * @property string $start_time 开始时间
 * @property string $end_time 订单完成时间
 * @property int $status 状态
 * @property int $del 是否被删除
 * @property string $update_time 更新时间
 */
class TradeDao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'order_id', 'status', 'del'], 'integer'],
            [['start_time', 'end_time', 'update_time'], 'safe'],
            [['trade_id', 'customer_id'], 'string', 'max' => 128],
            [['title'], 'string', 'max' => 64],
            [['detail'], 'string', 'max' => 255],
            [['dealer', 'handler'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trade_id' => 'Trade ID',
            'title' => 'Title',
            'customer_id' => 'Customer ID',
            'project_id' => 'Project ID',
            'order_id' => 'Order ID',
            'detail' => 'Detail',
            'dealer' => 'Dealer',
            'handler' => 'Handler',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'status' => 'Status',
            'del' => 'Del',
            'update_time' => 'Update Time',
        ];
    }
}
