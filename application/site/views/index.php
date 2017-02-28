<div id="slider-wrapper">
    <div id="slider" class="nivoSlider">
        <img src="images/slider/02.jpg" alt="" />
        <a href="#"><img src="images/slider/01.jpg" alt="" title="This is an example of a caption" /></a>
        <img src="images/slider/03.jpg" alt="" />
        <img src="images/slider/04.jpg" alt="" title="#htmlcaption" />
    </div>
    <div id="htmlcaption" class="nivo-html-caption">
        <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>.
    </div>
</div>

<h1>New Products</h1>

<?php foreach ($products as $product) { ?>

    <div class="product_box">
        <h3> <?= $product->name ?> </h3>
        <a href="productdetail.html"><img src="<?= $product->getImageUrl([200,200]) ?>" alt="Shoes 1" /></a>
        <p><?= $product->description ?></p>
        <p class="product_price"><?= $product->price ?></p>
        <a href="shoppingcart.html" class="addtocart"></a>
        <a href="productdetail.html" class="detail"></a>
    </div>

<?php } ?>

