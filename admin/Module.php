<?php

namespace pantera\reviews\admin;

use Yii;
use yii\helpers\ArrayHelper;

class Module extends \yii\base\Module
{
    /* @var array Массив ролей которым доступна админка */
    public $permissions = ['@'];
    public $reviewAdminClasses = [];

    public function getClassesList()
    {
        $classes = [];
        foreach ($this->reviewAdminClasses as $class => $config) {
            $classes[$class] = ArrayHelper::getValue($config, 'title');
        }
        return $classes;
    }

    public function getMenuItems()
    {
        return [
            ['label' => Yii::t('reviews', 'Reviews'), 'url' => ['/reviews/review'], 'icon' => 'comments'],
        ];
    }
}
