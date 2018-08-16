<?php

namespace everyday\simplemaintenance\models;

use craft\base\Model;

class Settings extends Model
{
    public $view = 'simple-maintenance/_503';
    public $maintenance = false;

    public function init()
    {
        parent::init();
    }

    public function rules()
    {
        return [
            [['view'], 'required'],
        ];
    }
}
