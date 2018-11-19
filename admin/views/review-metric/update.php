<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model rivership\modules\reviews\models\ReviewMetric */

$this->title = 'Update Review Metric: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Review Metrics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="review-metric-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
