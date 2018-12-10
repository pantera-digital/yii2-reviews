<?php

namespace pantera\reviews\widgets\form;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class GrowlAsset extends AssetBundle
{
    public $sourcePath = '@bower/growl';
    public $css = [
        'stylesheets/jquery.growl.css',
    ];
    public $js = [
        'javascripts/jquery.growl.js',
    ];
    public $depends = [
        JqueryAsset::class,
    ];
}
