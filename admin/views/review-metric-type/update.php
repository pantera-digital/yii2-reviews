<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model rivership\modules\reviews\models\ReviewMetricType */

$this->title = 'Update Review Metric Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Review Metric Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="review-metric-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
