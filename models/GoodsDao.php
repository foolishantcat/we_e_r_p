<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property string $goods_id
 * @property string $goods_name 商品名称，如：苹果
 * @property string $kind 商品种类，如：水果
 * @property string $detail 商品详细信息
 * @property string $type 商品类型，其他，例如：需求商品,未上架，已下架
 * @property string $handler 操作人，填写员工姓名
 * @property string $start_time 第一次录入时间
 * @property string $update_date 最后一次操作时间
 * @property string $status 当前记录状态
 * @property int $del 是否删除
 */
class GoodsDao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['goods_id', 'goods_name', 'kind'], 'required'],
            [['start_time', 'update_date'], 'safe'],
            [['del'], 'integer'],
            [['goods_id', 'goods_name'], 'string', 'max' => 128],
            [['kind', 'type', 'handler', 'status'], 'string', 'max' => 32],
            [['detail'], 'string', 'max' => 1000],
            [['goods_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'goods_id' => 'Goods ID',
            'goods_name' => 'Goods Name',
            'kind' => 'Kind',
            'detail' => 'Detail',
            'type' => 'Type',
            'handler' => 'Handler',
            'start_time' => 'Start Time',
            'update_date' => 'Update Date',
            'status' => 'Status',
            'del' => 'Del',
        ];
    }
}
