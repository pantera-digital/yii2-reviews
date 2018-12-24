<?php

use pantera\reviews\models\Review;
use pantera\reviews\Module;
use yii\helpers\StringHelper;
use yii\web\View;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $model Review */
/* @var $this View */
?>
<div class="m-lastest-reviews__title">
    Последние отзывы
</div>
<?php foreach ($dataProvider->models as $model) : ?>
    <?php if ($model->getFirstMetricTypeText()) : ?>
        <div class="review-heading">
            <?php $averageRating = $model->getAverageRating() ?>
            <div class="rating-string-name rating-string-name--bold">
                <?= $model->name ?>
            </div>
            <div class="rating-string-value">
                <b>
                    <?= Yii::$app->formatter->asDecimal($averageRating, 1) ?>
                </b>
            </div>
            <div class="rating-value-label">
                <?= Module::ratingLabel($averageRating) ?>
            </div>
        </div>
        <div class="rating-string">
            <div class="rating-string__line" style="width: <?= 20 * $averageRating ?>%;"></div>
        </div>
        <div class="review-mt-4">
            <?= StringHelper::truncate($model->getFirstMetricTypeText()->value, 190) ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
<?php if ($dataProvider->totalCount) : ?>
    <a href="#reviews" class="other-review-link">
        Остальные отзывы &raquo;
    </a>
<?php endif; ?>