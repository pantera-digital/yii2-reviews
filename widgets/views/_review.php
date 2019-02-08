<?php

use pantera\reviews\models\Review;
use pantera\reviews\Module;
use yii\helpers\Url;
use yii\web\View;

/* @var Review $model */
/* @var $this View */
?>
<div class="review-heading">
    <?php $averageRating = $model->getAverageRating() ?>
    <div class="review-heading__total">
        <div class="rating-string-avatar"></div>
        <div class="review-heading__name">
            <?= $model->name ?>
        </div>
    </div>
    <div class="rating-value-label">
        <?= Yii::$app->formatter->asDecimal($averageRating, 1) ?>
    </div>
</div>
<div class="review-metric">
    <?php foreach ($model->reviewMetricsTypeText as $metric) : ?>
        <div class="review-metric__wrap">
            <div class="review-metric__name">
                <?= $metric->type->name ?>
            </div>
            <div class="review-metric__text">
                <?= $metric->value ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="review__bottom">
    <div class="review-date">
        <?= Yii::$app->formatter->asDatetime($model->created_at, 'php:j F Y в H:i') ?>
    </div>
    <div class="rating-like-dislike">
        <div class="rating-like-dislike__useful">Полезно?</div>
        <a href="<?= Url::to(['/reviews/default/like', 'id' => $model->id]) ?>"
           class="btn-review-like rating-like-dislike__link">
            <i class="fa fa-thumbs-up fa-fw"></i>
            <span class="rating-like-dislike-likes"><?= $model->likes ?></span>
        </a>
        <a href="<?= Url::to(['/reviews/default/dislike', 'id' => $model->id]) ?>"
           class="btn-review-dislike rating-like-dislike__link">
            <i class="fa fa-thumbs-down fa-fw"></i>
            <span class="rating-like-dislike-dislikes"><?= $model->dislikes ?></span>
        </a>
    </div>
</div>