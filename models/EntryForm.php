<?php

/**
 * @Author: caoyicheng_cd
 * @Date:   2018-06-05 21:59:58
 * @Last Modified by:   caoyicheng_cd
 * @Last Modified time: 2018-06-05 22:21:07
 */

namespace app\models;

use Yii;
use yii\base\Model;

class EntryForm extends model
{
    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }
}
