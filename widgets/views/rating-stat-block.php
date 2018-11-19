<div class="rating-stat">
    <div class="reviews-count">
        Оценки на основе <?= $count ?> отзывов
    </div>
    <div class="rating-strings">
        <?php foreach ($ratingStat as $stat) : ?>
            <div class="rating-string-wrap" style="padding-bottom:16px; line-height: 28px">
                <div class="clearfix">
                    <div class="rating-string-name pull-left">
                        <?= $stat['name'] ?>
                    </div>
                    <div class="rating-string-value pull-right">
                        <b><?= Yii::$app->formatter->asDecimal($stat['avg_value'], 1) ?></b>
                    </div>
                </div>
                <div class="ratin-string" style="width:100%; background: #e3e3e3; height: 4px;">
                    <div style="background: #0059a9; width: <?= 20 * $stat['avg_value'] ?>%; height: 100%;"></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>