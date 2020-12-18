<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap3/bootstrap.css',
        'css/ionicons.min.css',
        'css/adminlte.css',
        'css/font-awesome.css',
        'css/skins/_all-skins.min.css',
        'plugins/iCheck/flat/blue.css',
        'css/site.css',
        'css/breadcrumbs.css',
        'css/customLogin.css',
        //'css/Chart.min.css'
     
 
    ];
    public $js = [
        'js/bootstrap/bootstrap.min.js',
        //'js/jquery.min.js',
        'js/evaluation/raphael-min.js',
        'plugins/sparkline/jquery.sparkline.min.js',
        'plugins/slimScroll/jquery.slimscroll.min.js',
        'plugins/fastclick/fastclick.min.js',
        'js/app.min.js',
        //'js/Chart.min.js',
        //'js/dashboard.js',
        //'js/main.js',
        
        'js/evaluation/ajax-modal-popup.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'rmrevin\yii\fontawesome\CdnProAssetBundle'
    ];
}
