
    <h1>Product Detail</h1>
    <div class="content_half float_l">
        <a  rel="lightbox[portfolio]" href="<?= $product->imageUrl ?>"><img src="<?= $product->getImageUrl([200,200]) ?>" alt="image" /></a>
    </div>
    <div class="content_half float_r">
        <table>
            <tr>
                <td width="160">Price:</td>
                <td><?= $product->price ?></td>
            </tr>
            <tr>
                <td>Availability:</td>
                <td>In Stock</td>
            </tr>
            <tr>
                <td>Model:</td>
                <td><?= $product->name ?></td>
            </tr>
            <tr>
                <td>Manufacturer:</td>
                <td>Apple</td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td><input type="text" value="1" style="width: 20px; text-align: right" /></td>
            </tr>
        </table>
        <div class="cleaner h20"></div>

        <a href="<?= \yii\helpers\Url::to(['cart/add', 'productId' => $product->id]) ?>" class="addtocart"></a>
        <a href="<?= \yii\helpers\Url::to(['whishlist/add', 'id' => $product->id]) ?>">Добавить в список желаний</a>

    </div>
    <div class="cleaner h30"></div>

    <h5>Product Description</h5>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur semper quam sit amet turpis rhoncus id venenatis tellus sollicitudin. Fusce ullamcorper, dolor non mollis pulvinar, turpis tortor commodo nisl, et semper lectus augue blandit tellus. Quisque id bibendum libero. Validate <a href="http://validator.w3.org/check?uri=referer" rel="nofollow">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer" rel="nofollow">CSS</a>.</p>

    <div class="cleaner h50"></div>

    <h3>Related Products</h3>
    <div class="product_box">
        <a href="productdetail.html"><img src="images/product/01.jpg" alt="" /></a>
        <h3>Ut eu feugiat</h3>
        <p class="product_price">$ 100</p>
        <a href="<?= \yii\helpers\Url::to(['cart/add', 'productId' => $product->id]) ?>" class="addtocart"></a>
        <a href="<?= \yii\helpers\Url::to(['catalog/product','id' => $product->id]) ?>" class="detail"></a>
    </div>
    <div class="product_box">
        <a href="productdetail.html"><img src="images/product/02.jpg" alt="" /></a>
        <h3>Curabitur et turpis</h3>
        <p class="product_price">$ 200</p>
        <a href="<?= \yii\helpers\Url::to(['cart/add', 'productId' => $product->id]) ?>" class="addtocart"></a>
        <a href="<?= \yii\helpers\Url::to(['catalog/product','id' => $product->id]) ?>" class="detail"></a>
    </div>
    <div class="product_box no_margin_right">
        <a href="productdetail.html"><img src="images/product/03.jpg" alt="" /></a>
        <h3>Mauris consectetur</h3>
        <p class="product_price">$ 120</p>
        <a href="<?= \yii\helpers\Url::to(['cart/add', 'productId' => $product->id]) ?>" class="addtocart"></a>
        <a href="<?= \yii\helpers\Url::to(['catalog/product','id' => $product->id]) ?>" class="detail"></a>
    </div>
