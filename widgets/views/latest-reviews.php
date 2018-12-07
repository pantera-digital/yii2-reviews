<?php

use pantera\reviews\models\Review;
use pantera\reviews\models\ReviewMetricType;
use pantera\reviews\Module;
use yii\helpers\StringHelper;
use yii\web\View;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $model Review */
/* @var $this View */
?>
    <h4>
        Последние отзывы
    </h4>
<?php foreach ($dataProvider->models as $model) : ?>
    <?php
    $metric = $model->getReviewMetrics()
        ->joinWith('type')
        ->andWhere(['type' => ReviewMetricType::TYPE_TEXT])
        ->one();
    ?>
    <?php if ($metric) : ?>
        <div class="clearfix review-heading">
            <?php $averageRating = $model->getAverageRating() ?>
            <div class="rating-string-name rating-string-name--bold pull-left">
                <?= $model->name ?>
            </div>
            <div class="rating-string-value pull-right">
                <b>
                    <?= Yii::$app->formatter->asDecimal($averageRating, 1) ?>
                </b>
            </div>
            <div class="rating-value-label pull-right">
                <?= Module::ratingLabel($averageRating) ?>
            </div>
        </div>
        <div class="rating-string">
            <div style="width: <?= 20 * $averageRating ?>%;"></div>
        </div>
        <div class="review-mt-4">
            <?= StringHelper::truncate($metric->value, 190) ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
<?php if ($dataProvider->totalCount) : ?>
    <a href="#reviews" class="pull-right other-review-link">
        Остальные отзывы &raquo;
    </a>
<?php endif; ?>