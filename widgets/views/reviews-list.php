<?php $averageRating = pantera\reviews\models\ReviewMetric::find()
    ->joinWith(['type', 'review'])
    ->andWhere(['model_class' => $model::className(), 'model_id' => $model->getPrimaryKey()])
    ->andWhere(['type' => pantera\reviews\models\ReviewMetricType::TYPE_RATING])
    ->average('value') ?: 0 ?>
<style>
    .reviews-source-description {
        width: 100%;
        background: #0059a9;
        padding: 13px;
        margin-bottom: 11px;
        color: white;
        line-height: 1.6em;
        border-radius: 3px;
    }

    .reviews-source-description a {
        color: white;
        font-weight: bold;
    }

    .review-name,
    .rating-stat_title {
        font-size: 16px;
    }

    #reviews-grid .label {
        line-height: 20px;
    }

    #reviews-grid {
        padding-right: 8px;
    }

    .review-sorter {
        margin-bottom: 20px;
    }

    .review-block {
        margin-bottom: 15px;
        border-bottom: 2px dashed #e3e3e3;
        padding-bottom: 15px;
    }

    .reviews-grid-wrapper .review-block:last-child {
        border-bottom: none;
    }

    .review-metric-wrap {
        margin-top: 16px;
        margin-bottom: 0;
    }

    .review-date {
        position: absolute;
        bottom: -12px;
        font-size: 12px;
    }

    .review-heading .rating-string-value {
        padding: 2px 6px;
        background: #0059a9;
        color: white;
        border-radius: 5px;
        display: block;
        margin-bottom: 3px;
        font-weight: bold;
    }

    .rating-value-label {
        padding: 2px 6px;
        border-radius: 5px;
        display: block;
        margin-bottom: 3px;
        font-weight: bold;
    }

    .average-rate .rating-string-value {
        padding: 6px 13px;
        background: #0059a9;
        color: white;
        border-radius: 5px;
        font-weight: bold;
    }

    .btn-like,
    .btn-like:hover {
        border: 1px blue solid;
        margin-top: 5px;
    }

    .btn-dislike,
    .btn-dislike:hover {
        border: 1px red solid;
        margin-top: 5px;
    }

    .reviews-count {
        font-weight: bold;
        line-height: 18px;
        font-size: 15px;
        margin-bottom: 9px;
        color: #bab9b9;
    }

    #reviews-summary {
        margin-bottom: 20px;
    }
</style>
<div class="reviews-list-widget">
    <div class="review-list-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="h3">
                    Все отзывы
                </div>
                <div class="review-sorter">
                    Сортировать: &nbsp;
                    <?php $revSort = Yii::$app->request->getQueryParam('reviews_sort'); ?>
                    <a style="<?= in_array($revSort, ['date', 'date_asc']) ? 'font-weight:bold;' : '' ?>"
                       href="?reviews_sort=<?= $revSort == 'date' ? 'date_asc' : 'date' ?>">по дате</a> &nbsp;
                    <a style="<?= in_array($revSort, ['rating_asc', 'rating']) ? 'font-weight:bold;' : '' ?>"
                       href="?reviews_sort=<?= $revSort == 'rating' ? 'rating_asc' : 'rating' ?>">по оценке</a> &nbsp;
                    <a style="<?= in_array($revSort, ['liegs_asc', 'likes']) ? 'font-weight:bold;' : '' ?>"
                       href="?reviews_sort=<?= $revSort == 'likes' ? 'likes_asc' : 'likes' ?>">по полезности</a> &nbsp;
                </div>
            </div>
            <div class="col-md-3 col-md-offset-1 col-md-push-8" id="reviews-summary">
                <div class="reviews-grid-wrapper">
                    <div class="rating-string-wrap average-rate pull-left" style="
            padding-bottom: 16px;
            line-height: 27px;
            width: 100%;">
                        <div class="clearfix">
                            <div class="rating-string-name pull-left" style="
                        margin-right: 25px;
                        font-weight: bold;
                        font-size: 31px;
                        margin-top: 7px;
                    ">
                                <?= \pantera\reviews\Module::ratingLabel($averageRating); ?>
                            </div>
                            <div class="rating-string-value pull-right">
                                <?= Yii::$app->formatter->asDecimal($averageRating, 1) ?>
                            </div>
                        </div>
                    </div>
                    <?= \pantera\reviews\widgets\RatingStatBlock::widget([
                        'model' => $model,
                    ]) ?>
                    <div class="reviews-source-description">
                        100% подлинные отзывы <br>
                        Только реальные люди <br>
                        Только настоящие прогулки <br>
                        <a href="/faq">Читать подробнее &raquo;</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-pull-4" id="reviews-grid">
                <div class="reviews-grid-wrapper">
                    <?= \yii\widgets\ListView::widget([
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
