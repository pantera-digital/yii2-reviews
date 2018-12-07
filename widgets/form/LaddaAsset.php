<?php

namespace pantera\reviews\widgets\form;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class LaddaAsset extends AssetBundle
{
    public $sourcePath = '@bower/ladda/dist';
    public $css = [
        'ladda-themeless.min.css',
    ];
    public $js = [
        'spin.min.js',
        'ladda.min.js',
        'ladda.jquery.min.js'
    ];
    public $depends = [
        JqueryAsset::class,
    ];
}
