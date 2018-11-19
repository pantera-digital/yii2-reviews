<?php

use pantera\reviews\models\Review;
use yii\web\View;
use pantera\reviews\Module;
use pantera\reviews\models\ReviewMetricType;

/* @var Review $model */
/* @var $this View */
$metrics = $model->getReviewMetrics()->joinWith('type')->orderBy('type')->all();
?>
<div class="row">
    <div class="col-md-12">
        <div class="clearfix">
            <div class="review-heading rating-string-wrap pull-left" style="
            padding-bottom: 16px;
            line-height: 27px;
            width: 100%;">
                <div class="clearfix">
                    <?php $averageRating = $model->getAverageRating() ?>
                    <div class="rating-string-name pull-left" style="margin-right:25px;">
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
                <div class="ratin-string" style="width:100%; background: #e3e3e3; height: 8px;">
                    <div style="background: #0059a9; width: <?= 20 * $averageRating ?>%; height: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <?php foreach ($metrics as $metric) : ?>
            <?php if ($metric->type->type == ReviewMetricType::TYPE_TEXT) : ?>
                <div class="review-metric-wrap">
                    <div class="review-metric-name">
                        <b><?= $metric->type->name ?></b>
                    </div>
                    <div class="review-metric-text">
                        <?= $metric->value ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="col-md-4">
        <div style="margin-top:16px">
            <?php foreach ($metrics as $metric) : ?>
                <?php if ($metric->type->type == ReviewMetricType::TYPE_RATING) : ?>
                    <div class="rating-string-wrap" style="padding-bottom:16px; line-height: 28px;">
                        <div class="clearfix">
                            <div class="rating-string-name pull-left">
                                <?= $metric->type->name ?>
                            </div>
                            <div class="rating-string-value pull-right">
                                <b><?= $metric->value ?></b>
                            </div>
                        </div>
                        <div class="ratin-string" style="width:100%; background: #e3e3e3; height: 4px;">
                            <div style="background: #0059a9; width: <?= 20 * $metric->value ?>%; height: 100%;"></div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="rating-like-dislike text-right">
            <a class="btn btn-link btn-review-like" data-review-id="<?= $model->id ?>">
                <i class="fa fa-thumbs-up fa-fw"></i> <span class="review-likes"><?= $model->likes ?></span>
            </a>
            <a class="btn btn-link btn-review-dislike" data-review-id="<?= $model->id ?>">
                <i class="fa fa-thumbs-down fa-fw"></i> <span class="review-dislikes"><?= $model->dislikes ?></span>
            </a>
        </div>
    </div>
</div>