<?php

use yii\bootstrap\Tabs;
use yii\web\View;

/* @var $this View */
/* @var $content string */

$this->beginContent('@app/views/layouts/main.php');
echo Tabs::widget([
    'items' => [
        [
            'label' => Yii::t('reviews', 'Reviews'),
            'url' => ['/reviews/review'],
            'active' => Yii::$app->controller->id == 'review',
        ],
        [
            'label' => Yii::t('reviews', 'Review Metrics'),
            'url' => ['/reviews/review-metric-type'],
            'active' => Yii::$app->controller->id == 'review-metric-type',
        ],
    ]
]);
echo $content;
$this->endContent();
