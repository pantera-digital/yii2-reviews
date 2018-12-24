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
        <div class="reviews-block__title">
            Все отзывы
        </div>
        <div class="review-sorter">
            <div class="review-sorter__title">
                Сортировать:
            </div>
            <div class="review-sorter__links">
            <?php $revSort = Yii::$app->request->getQueryParam('reviews_sort'); ?>
                <a class="review-sorter__link <?= in_array($revSort, ['date', 'date_asc']) ? 'review-sorter__link_active' : '' ?>"
                   href="?reviews_sort=<?= $revSort == 'date' ? 'date_asc' : 'date' ?>">по дате</a>
                <a class="review-sorter__link <?= in_array($revSort, ['rating_asc', 'rating']) ? 'review-sorter__link_active' : '' ?>"
                   href="?reviews_sort=<?= $revSort == 'rating' ? 'rating_asc' : 'rating' ?>">по оценке</a>
                <a class="review-sorter__link <?= in_array($revSort, ['liegs_asc', 'likes']) ? 'review-sorter__link_active' : '' ?>"
                   href="?reviews_sort=<?= $revSort == 'likes' ? 'likes_asc' : 'likes' ?>">по полезности</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-md-offset-1 col-md-push-8" id="reviews-summary">
                <div class="reviews-grid-wrapper">
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
