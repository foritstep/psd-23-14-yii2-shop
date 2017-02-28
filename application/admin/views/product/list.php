<?php

$this->params['breadcrumbs'][] = 'Categories';

use yii\helpers\Url;
use yii\helpers\Html;
?>


<h1>Products list <a class="btn btn-primary pull-right" href="<?= Url::to(['product/create'])?>">Add product</a></h1>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $filterModel,
    'columns' => [
        'id',
        [
            'attribute' => 'image',
            'format' => 'html',
            'value' => function($item) {
                return Html::img($item->getImageUrl([50, 50]));
            }
        ],
        'name',
        [
            'attribute' => 'categoryId',
            'filter' => $categories
        ],
        'price',
        'createdAt',
        'updatedAt',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}'
        ]
    ]
]) ?>