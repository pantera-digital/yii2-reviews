<?php $this->beginContent('@app/views/layouts/main.php'); ?>
    <?=\yii\bootstrap\Tabs::widget([
        'items' => [
            ['label' => 'Отзывы', 'url' => ['/review-admin/review'], 'active' => Yii::$app->controller->id == 'review'],
            ['label' => 'Метрики отзыва', 'url' => ['/review-admin/review-metric-type'], 'active' => Yii::$app->controller->id == 'review-metric-type'],
        ]
    ]) ?>
    <?=$content?>

<?php $this->endContent(); ?>