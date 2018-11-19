<?php

namespace pantera\reviews\admin;

class Module extends \yii\base\Module
{
    /* @var array Массив ролей которым доступна админка */
    public $permissions = ['@'];
    public $reviewAdminClasses = [];
}
