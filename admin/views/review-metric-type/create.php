<?php

use pantera\reviews\models\ReviewMetricType;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model ReviewMetricType */

$this->title = Yii::t('reviews', 'Create Review Metric Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('reviews', 'Review Metric Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-metric-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
