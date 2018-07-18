<?php


/**
 * Created by PhpStorm.
 * User: jukaibo_cd
 * Date: 2018/7/15
 * Time: 18:02
 */
namespace app\publicutil;

class Util
{
    /**
     * 获取随机唯一编号
     * Displays homepage.
     * @return string
     */
    public function genUniqueTimeId()
    {
        $timeStamp = microtime(true);
        $str_id = date('YmdHms') . '_' . $timeStamp;
        return $str_id;
    }
}