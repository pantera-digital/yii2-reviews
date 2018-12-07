<?php

use pantera\reviews\models\ReviewMetricType;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model ReviewMetricType */

$this->title = Yii::t('reviews', 'Update Review Metric Type: {NAME}', [
    'NAME' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('reviews', 'Review Metric Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('reviews', 'Update');
?>
<div class="review-metric-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
