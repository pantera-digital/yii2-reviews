<?php

use pantera\reviews\Module;
use pantera\reviews\widgets\RatingStatBlock;
use yii\web\View;
use yii\widgets\ListView;

/* @var $this View */
/* @var $averageRating string */
?>
<div class="reviews-list-widget" id="reviews">
    <div class="review-list-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="h3">
                    Все отзывы
                </div>
                <div class="review-sorter">
                    Сортировать: &nbsp;
                    <?php $revSort = Yii::$app->request->getQueryParam('reviews_sort'); ?>
                    <a class="<?= in_array($revSort, ['date', 'date_asc']) ? 'review-fw-bold' : '' ?>"
                       href="?reviews_sort=<?= $revSort == 'date' ? 'date_asc' : 'date' ?>">по дате</a> &nbsp;
                    <a class="<?= in_array($revSort, ['rating_asc', 'rating']) ? 'review-fw-bold' : '' ?>"
                       href="?reviews_sort=<?= $revSort == 'rating' ? 'rating_asc' : 'rating' ?>">по оценке</a> &nbsp;
                    <a class="<?= in_array($revSort, ['liegs_asc', 'likes']) ? 'review-fw-bold' : '' ?>"
                       href="?reviews_sort=<?= $revSort == 'likes' ? 'likes_asc' : 'likes' ?>">по полезности</a> &nbsp;
                </div>
            </div>
            <div class="col-md-3 col-md-offset-1 col-md-push-8" id="reviews-summary">
                <div class="reviews-grid-wrapper">
                    <div class="rating-string-wrap average-rate pull-left">
                        <div class="clearfix">
                            <div class="rating-string-name rating-string-name--big pull-left">
                                <?= Module::ratingLabel($averageRating); ?>
                            </div>
                            <div class="rating-string-value pull-right">
                                <?= Yii::$app->formatter->asDecimal($averageRating, 1) ?>
                            </div>
                        </div>
                    </div>
                    <?= RatingStatBlock::widget([
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
            <div class="col-md-8 col-md-pull-4" id="reviews-grid">
                <div class="reviews-grid-wrapper">
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_review',
                        'itemOptions' => [
                            'class' => 'review-block',
                        ],
                        'summary' => false,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
