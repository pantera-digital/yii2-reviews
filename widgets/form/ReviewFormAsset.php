<?php

namespace pantera\reviews\widgets\form;

use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;

class ReviewFormAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';

    public $js = [
        'js/script.js',
    ];

    public $depends = [
        LaddaAsset::class,
        GrowlAsset::class,
        BootstrapAsset::class,
        BootstrapPluginAsset::class,
    ];
}
