<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

//(new yii\web\Application($config))->run();

class Var1ChangeEvent extends \yii\base\Event {
    public $oldValue;
    public $newValue;
}

class MyClass extends \yii\base\Component {
    private $_var1 = 0;

    public function setVar1($value) {
        if ($value != $this->_var1) {
            $old = $this->_var1;
            $this->_var1 = $value;

            $event = new Var1ChangeEvent([
                'oldValue' => $old,
                'newValue' => $this->_var1
            ]);
            $this->trigger('var1-change', $event);

            if ($old <= 10 && $this->_var1 > 10) {
                $this->trigger('var1-bigger-10');
            } else if ($old >= 10 && $this->_var1 < 10) {
                $this->trigger('var1-lower-10');
            } else if ($this->_var1 == 10) {
                $this->trigger('var1-equal-10');
            }
        }
    }

    public function behaviors() {
        return [
            'someBehavior' => [
                'class' => 'MyBehavior',
                'behaviorProperty' => 10
            ]
        ];
    }
}

/*
 * Привязка и обработка событий
$object = new MyClass();

function someEventHandler($event) {
    echo "Var1 was changed from {$event->oldValue} to {$event->newValue}<br/>";
}

$object->on('var1-change', 'someEventHandler', 'первый обработчик');

//$object->on('var1-change', 'onVar1Change', 'второй обработчик');

$object->on('var1-bigger-10', function () {
    echo 'Var1 became bigger then 10 <br/>';
});

$object->on('var1-lower-10', function () {
    echo 'Var1 became lower then 10 <br/>';
});

$object->on('var1-equal-10', function () {
    echo 'Var1 became 10 <br/>';
});

$object->var1 = 1;
$object->var1 = 5;
$object->var1 = 5;
$object->var1 = 10;
$object->var1 = 20;
$object->var1 = 15;
$object->var1 = 5;
*/

class MyBehavior extends \yii\base\Behavior {
    public $behaviorProperty;

    public function init() {
        if ($this->owner && !($this->owner instanceof MyClass)) {
            throw new \yii\base\Exception('Владелец этого поведения должен быть объектом MyClass');
        }
    }

    public function events()
    {
        return [
            'var1-change' => 'onVar1Change',
            'var1-bigger-10' => 'onVar1Bigger10',
            'var1-lower-10' => 'onVar1Lower10',
            'var1-equal-10' => 'onVar1Equal10',
        ];
    }

    public function behaviorMethod() {
        echo 'Some Method Called <br/>';
    }

    public function onVar1Change($event) {
        echo "Var1 was changed from {$event->oldValue} to {$event->newValue}<br/>";
    }

    public function onVar1Bigger10() {
        echo 'Var1 became bigger then 10 <br/>';
    }

    public function onVar1Lower10() {
        echo 'Var1 became lower then 10 <br/>';
    }

    public function onVar1Equal10() {
        echo 'Var1 became 10 <br/>';
        $this->owner->var1 = 11;
    }
}

/*
$object->attachBehavior('someBehavior', [
    'class' => 'MyBehavior',
    'behaviorProperty' => 10
]);
*/
$object = new MyClass();

$object->behaviorProperty = 50;
$object->behaviorMethod();

$object->var1 = 5;
$object->var1 = 10;
$object->var1 = 20;
$object->var1 = 5;

echo '<pre>';
//var_dump($object);

