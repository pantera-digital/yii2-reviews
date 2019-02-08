<?php

use yii\web\View;

/* @var $this View */
/* @var $ratingStat array */
?>
<div class="rating-stat">
    <div class="rating-strings">
        <?php foreach ($ratingStat as $stat) : ?>
            <div class="rating-string-wrap">
                <div class="rating-string-wrap__header">
                    <div class="rating-string-name">
                        <?= $stat['name'] ?>
                    </div>
                    <div class="rating-string-value">
                        <?= Yii::$app->formatter->asDecimal($stat['avg_value'], 1) ?>
                    </div>
                </div>
                <div class="rating-string rating-string--sm">
                    <div class="rating-string__line" style="width: <?= 20 * $stat['avg_value'] ?>%;"></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>