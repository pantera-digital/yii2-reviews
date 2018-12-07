<?php

use yii\web\View;

/* @var $this View */
/* @var $ratingStat array */
?>
<div class="rating-stat">
    <div class="reviews-count">
        Оценки на основе <?= $count ?> отзывов
    </div>
    <div class="rating-strings">
        <?php foreach ($ratingStat as $stat) : ?>
            <div class="rating-string-wrap">
                <div class="clearfix">
                    <div class="rating-string-name pull-left">
                        <?= $stat['name'] ?>
                    </div>
                    <div class="rating-string-value pull-right">
                        <b><?= Yii::$app->formatter->asDecimal($stat['avg_value'], 1) ?></b>
                    </div>
                </div>
                <div class="rating-string rating-string--sm">
                    <div style="width: <?= 20 * $stat['avg_value'] ?>%;"></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>