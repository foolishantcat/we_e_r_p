<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nav".
 *
 * @property string $catalog_id
 * @property string $bar_id
 * @property string $item_id
 * @property string $level
 * @property int $authcode
 * @property int $seq_num
 * @property string $view
 * @property string $status
 * @property int $del
 */
class NavDao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nav';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catalog_id'], 'required'],
            [['authcode', 'seq_num', 'del'], 'integer'],
            [['catalog_id', 'bar_id', 'item_id', 'status'], 'string', 'max' => 64],
            [['level'], 'string', 'max' => 32],
            [['view'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'catalog_id' => 'Catalog ID',
            'bar_id' => 'Bar ID',
            'item_id' => 'Item ID',
            'level' => 'Level',
            'authcode' => 'Authcode',
            'seq_num' => 'Seq Num',
            'view' => 'View',
            'status' => 'Status',
            'del' => 'Del',
        ];
    }
}
