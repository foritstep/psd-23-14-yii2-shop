<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

//(new yii\web\Application($config))->run();

class MyClass extends \yii\base\Object {
    public $var1;

    private $_var2;
    private $_var3;
    private $_var4;

    public function setVar2($value) {
        $this->_var2 = $value;
    }

    public function getVar2() {
        return $this->_var2;
    }

    public function setVar3($value) {
        $this->_var3 = $value;
        $this->_var4 = $value * 2;
    }

    public function getVar4() {
        $this->_var4;
    }
}

$object = new MyClass();
$object->var1 = 1;
$object->var2 = 2;
$object->var3 = 3;
//$object->var4 = 4; Error read-only

echo $object->var1 . '<br/>';
echo $object->var2 . '<br/>';
//echo $object->var3 . '<br/>'; Error write-only
echo $object->var4 . '<br/>';

$object = new MyClass([
    'var1' => 1,
    'var2' => 2,
    'var3' => 3,
    //'var4' => 4, Error read-only
]);

$object = new MyClass();

\Yii::configure($object, [
    'var1' => 1,
    'var2' => 2,
    'var3' => 3
]);

\Yii::createObject(MyClass::className(), [
    'var1' => 1,
    'var2' => 2,
    'var3' => 3
]);

\Yii::createObject([
    'class' => MyClass::className(),
    'var1' => 1,
    'var2' => 2,
    'var3' => 3
]);

\Yii::createObject(function() {
    return new MyClass([
        'var1' => 1,
        'var2' => 2,
        'var3' => 3
    ]);
});
