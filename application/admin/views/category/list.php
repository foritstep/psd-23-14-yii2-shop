<?php

$this->params['breadcrumbs'][] = 'Categories';

use yii\helpers\Url;
use yii\helpers\Html;
?>

<h1>Categories list <a class="btn btn-primary pull-right" href="<?= Url::to(['category/add'])?>">Add category</a></h1>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $filterModel,
    'columns' => [
        'id',
        [
            'attribute' => 'name',
            'value' => function ($category) {
                if (!empty($category->childs)) {
                    return Html::a($category->name, Url::to(['category/index', 'CategoryFilter' => ['parentId' => $category->id]]));
                }

                return $category->name;
            },
            'format' => 'html'
        ],
        [
            'attribute' => 'parentId',
            'value' => 'parent.name',
            'filter' => $categories,
            'filterInputOptions' => [
                'encode' => false,
                'class' => 'form-control'
            ]
        ],
        'createdAt',
        'updatedAt',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}'
        ]
    ]
]) ?>