<?php

use pantera\reviews\models\Review;
use yii\web\View;
use pantera\reviews\models\ReviewMetricType;
use pantera\reviews\Module;

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
        <div class="clearfix review-heading" style="margin-top:10px">
            <?php $averageRating = $model->getAverageRating() ?>
            <div class="rating-string-name pull-left" style="margin-right:25px;">
                <b><?= $model->name ?></b>
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
        <div class="rating-string" style="width:100%; background: #e3e3e3; height: 8px;">
            <div style="background: #0059a9; width: <?= 20 * $averageRating ?>%; height: 100%;"></div>
        </div>
        <div style="margin-top:4px;">
            <?= \yii\helpers\StringHelper::truncate($metric->value, 190, '...') ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
<?php if ($dataProvider->totalCount) : ?>
    <a href="#reviews" class="pull-right" style="margin-top:10px; margin-bottom:10px; display:block">
        <b>
            Остальные отзывы &raquo;
        </b>
    </a>
<?php endif; ?>