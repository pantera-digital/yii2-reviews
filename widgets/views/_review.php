<?php

use pantera\reviews\models\Review;
use pantera\reviews\Module;
use yii\helpers\Url;
use yii\web\View;

/* @var Review $model */
/* @var $this View */
?>
<div class="row">
    <div class="col-md-12">
        <div class="clearfix">
            <div class="review-heading rating-string-wrap pull-left">
                <div class="clearfix">
                    <?php $averageRating = $model->getAverageRating() ?>
                    <div class="rating-string-name pull-left">
                        <b><?= $model->name ?></b>
                        <div class="review-date">
                            <?= Yii::$app->formatter->asDate($model->created_at, 'long') ?>
                        </div>
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
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <?php foreach ($model->reviewMetricsTypeText as $metric) : ?>
            <div class="review-metric-wrap">
                <div class="review-metric-name">
                    <b><?= $metric->type->name ?></b>
                </div>
                <div class="review-metric-text">
                    <?= $metric->value ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="col-md-4">
        <div class="review-mt-16">
            <?php foreach ($model->reviewMetricsTypeRating as $metric) : ?>
                <div class="rating-string-wrap">
                    <div class="clearfix">
                        <div class="rating-string-name pull-left">
                            <?= $metric->type->name ?>
                        </div>
                        <div class="rating-string-value pull-right">
                            <b><?= $metric->value ?></b>
                        </div>
                    </div>
                    <div class="rating-string">
                        <div style="width: <?= 20 * $metric->value ?>%;"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="rating-like-dislike text-right">
            <a href="<?= Url::to(['/reviews/default/like', 'id' => $model->id]) ?>"
               class="btn btn-link btn-review-like">
                <i class="fa fa-thumbs-up fa-fw"></i>
                <span class="review-likes"><?= $model->likes ?></span>
            </a>
            <a href="<?= Url::to(['/reviews/default/dislike', 'id' => $model->id]) ?>"
               class="btn btn-link btn-review-dislike">
                <i class="fa fa-thumbs-down fa-fw"></i>
                <span class="review-dislikes"><?= $model->dislikes ?></span>
            </a>
        </div>
    </div>
</div>