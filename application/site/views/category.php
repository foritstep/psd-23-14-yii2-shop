<h1>New Products</h1>

<?php foreach ($products as $product) { ?>

    <div class="product_box">
        <h3> <?= $product->name ?> </h3>
        <a href="<?= \yii\helpers\Url::to(['catalog/product','id' => $product->id]) ?>"><img src="<?= $product->getImageUrl([200,200]) ?>" alt="Shoes 1" /></a>
        <p><?= $product->description ?></p>
        <p class="product_price"><?= $product->price ?></p>
        <a href="<?= \yii\helpers\Url::to(['cart/add', 'productId' => $product->id]) ?>" class="addtocart"></a>
        <a href="<?= \yii\helpers\Url::to(['catalog/product','id' => $product->id]) ?>" class="detail"></a>
    </div>

<?php } ?>

