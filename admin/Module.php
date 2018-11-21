<?php

namespace pantera\reviews\admin;

class Module extends \yii\base\Module
{
    /* @var array Массив ролей которым доступна админка */
    public $permissions = ['@'];
    public $reviewAdminClasses = [];

    public function getMenuItems()
    {
        return [
        	['label' => 'Отзывы', 'url' => ['/reviews/review'], 'icon' => 'comments'],
    	];
    }
}
