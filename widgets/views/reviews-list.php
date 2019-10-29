<?php

use pantera\reviews\Module;
use pantera\reviews\widgets\ReviewsRatingStat;
use pantera\reviews\widgets\ReviewsEmpty;
use yii\web\View;
use yii\widgets\ListView;

/* @var $this View */
/* @var $averageRating string */
?>
<div class="reviews-list-widget" id="reviews">
    <div class="review-list-wrapper">
        <?php if ($reviewsCount = $dataProvider->totalCount) : ?>
            <div class="reviews-block__title">
                Все отзывы
                <span class="reviews-block__count">
                    <?= $reviewsCount ?>
                </span>
            </div>
            <div class="review-sorter">
                <div class="review-sorter__title">
                    Сортировать:
                </div>
                <div class="review-sorter__links">
                <?php $revSort = Yii::$app->request->getQueryParam('reviews_sort'); ?>
                    <a class="review-sorter__link <?= $revSort == 'date' ? 'review-sorter__link_asc ' : '' ?><?= in_array($revSort, ['date', 'date_asc']) ? 'review-sorter__link_active' : '' ?>"
                       data-href="?reviews_sort=<?= $revSort == 'date' ? 'date_asc' : 'date' ?>" rel="nofollow">по дате</a>
                    <a class="review-sorter__link <?= $revSort == 'rating' ? 'review-sorter__link_asc ' : '' ?><?= in_array($revSort, ['rating_asc', 'rating']) ? 'review-sorter__link_active' : '' ?>"
                       data-href="?reviews_sort=<?= $revSort == 'rating' ? 'rating_asc' : 'rating' ?>" rel="nofollow">по оценке</a>
                    <a class="review-sorter__link <?= $revSort == 'likes' ? 'review-sorter__link_asc ' : '' ?><?= in_array($revSort, ['likes_asc', 'likes']) ? 'review-sorter__link_active' : '' ?>"
                       data-href="?reviews_sort=<?= $revSort == 'likes' ? 'likes_asc' : 'likes' ?>" rel="nofollow">по полезности</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-md-offset-1 col-md-push-8" id="reviews-summary">
                    <div class="reviews-grid-wrapper">
                        <?= ReviewsRatingStat::widget([
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
                            'emptyText' => 'Отзывов ещё нет',
                            'summary' => false,
                        ]) ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?= ReviewsEmpty::widget([
                'linkHref' => 'mailto:info@river-ship.ru',
            ]) ?>
        <?php endif; ?>
    </div>
</div>
