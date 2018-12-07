<?php

use pantera\reviews\models\Review;
use pantera\reviews\models\ReviewMetricType;
use yii\web\View;

/* @var $form \yii\widgets\ActiveForm */
/* @var $model Review */
/* @var $this View */
?>
<div class="row">
    <?php foreach (ReviewMetricType::find()->orderBy('type ASC')->all() as $metricType) : ?>
        <?php if ($metricType->type == $metricType::TYPE_TEXT) : ?>
            <div class="col-md-12">
                <?= $form->field($model, 'metrics[' . $metricType->id . ']')->textarea([

                ])->label($metricType->name) ?>
            </div>
        <?php elseif ($metricType->type == $metricType::TYPE_RATING) : ?>
            <div class="col-md-3">
                <?= $form->field($model, 'metrics[' . $metricType->id . ']')
                    ->textInput([
                        'type' => 'number',
                        'max' => 5,
                        'min' => 0,
                        'placeholder' => Yii::t('reviews', 'From 1 to 5'),
                    ])
                    ->label($metricType->name) ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

