<?php
/**
 *author:yyx
 *create_time:2017/9/22 15:17
 *description:
 */
namespace backend\modules\user\models;

use yii\base\Model;

class UserSearchConditionsForm extends Model
{
    public $search;

    public function rules()
    {
        return [
            [['search'],'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'search'=>'',
        ];
    }
}

