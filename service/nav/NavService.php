<?php

namespace app\service\nav;


use app\models\NavDao;

class NavService
{
    /**
     * 获取初始化路由信息
     * @return mixed
     */
    public function getNavInfo()
    {
        $navDao = new NavDao();
        $out['bars'] = $navDao->find()->where(['catalog_id' => '进销存系统', 'level' => 'bar'])->orderBy('seq_num')->asArray()->all();
        $out['items'] = $navDao->find()->where(['catalog_id' => '进销存系统', 'level' => 'item'])->asArray()->all();;
        return $out;
    }
}