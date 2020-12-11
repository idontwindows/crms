<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class FeedbackAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'//maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css',
        'css/ionicons.min.css',
        //'css/site.css',
        'css/smiley.css',
        'css/font-awesome.min.css',
        'css/star-rating.css',
        //'css/multistep.css',
        'css/vkeyboard.css',
        'css/carousel.css'


    ];
    public $js = [
        //'js/bootstrap/bootstrap.min.js',
        //'//code.jquery.com/ui/1.11.4/jquery-ui.min.js',
        'js/evaluation/raphael-min.js',
        'js/app.min.js',
        //'//maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js',    
        'js/evaluation/star-rating.js',
        //'js/evaluation/multistep.js',
        'js/evaluation/vkeyboard.js',
        'js/evaluation/get.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'rmrevin\yii\fontawesome\CdnProAssetBundle'
    ];
}
