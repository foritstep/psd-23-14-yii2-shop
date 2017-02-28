<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace site\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SiteAsset extends AssetBundle
{
    public $sourcePath = '@site/views/package';
    public $baseUrl = '@web';
    public $css = [
        'css/slimbox2.css',
        'css/ddsmoothmenu.css',
        'css/templatemo_style.css'
    ];
    public $js = [
        'js/slimbox2.js',
        'js/jquery.nivo.slider.pack.js',
        'js/ddsmoothmenu.js',
        'js/global.js',
    ];
    public $depends = [
        'yii\web\YiiAsset'
    ];
}
