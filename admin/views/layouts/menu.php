<?php

use yii\bootstrap\Tabs;
use yii\web\View;

/* @var $this View */
/* @var $content string */

$this->beginContent('@app/views/layouts/main.php');
echo Tabs::widget([
    'items' => [
        [
            'label' => 'Отзывы',
            'url' => ['/reviews/review'],
            'active' => Yii::$app->controller->id == 'review',
        ],
        [
            'label' => 'Метрики отзыва',
            'url' => ['/reviews/review-metric-type'],
            'active' => Yii::$app->controller->id == 'review-metric-type',
        ],
    ]
]);
echo $content;
$this->endContent();
