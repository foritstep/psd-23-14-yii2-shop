<?php
?>
<h1>Products List</h1>

<?php foreach ($products as $product) { ?>

    <div class="product_box">
        <h3> <?= $product->name ?> </h3>
        <a href="productdetail.html"><img src="<?= $product->getImageUrl([200,200]) ?>" alt="Shoes 1" /></a>
        <p><?= $product->description ?></p>
        <p class="product_price"><?= $product->price ?></p>
        <a href="<?= \yii\helpers\Url::to(['cart/add', 'productId' => $product->id]) ?>" class="addtocart"></a>
        <a href="productdetail.html" class="detail"></a>
        <a href="<?= \yii\helpers\Url::to(['whishlist/delete', 'id'=>$product->id])?>">    Удалить из Избранного  </a>
    </div>

<?php } ?>
