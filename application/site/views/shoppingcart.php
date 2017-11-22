<h1>Shopping Cart</h1>
<?php use \yii\helpers\Url; ?>
<table width="680px" cellspacing="0" cellpadding="5">
    <tr bgcolor="#ddd">
        <th width="220" align="left">Image </th>
        <th width="180" align="left">Description </th>
        <th width="100" align="center">Quantity </th>
        <th width="60" align="right">Price </th>
        <th width="60" align="right">Total </th>
        <th width="90"> </th>
    </tr>
    <?php
        foreach($products as $product) { ?>
            <tr>
                <td><a href="productdetail.html"><img src="<?= $product->getImageUrl([200,200])?>" alt="Shoes 1"/></a></td>
                <td><p><?= $product->description ?></p></td>
                <td align="center"><input type="text" value="<?= $quantities[$product->id] ?>" style="width: 20px; text-align: right" /> </td>
                <td align="right"><p class="product_price"><?= $product->price ?></p> </td>
                <td align="right"><p class="product_price"><?= $product->price*$quantities[$product->id] ?></p> </td>
                <td align="center"> <a href="<?= Url::to(['cart/delete','productId' => $product->id]) ?>"><img src="images/remove_x.gif" alt="remove" /><br />Remove</a> </td>
                <?php $totalprice += $product->price*$quantities[$product->id] ?>
            </tr>
    <?php } ?>

    <tr>
        <td colspan="3" align="right"  height="30px">Have you modified your basket? Please click here to <a href="<?= \yii\helpers\Url::to(['cart/add', 'productId' => $product->id]) ?>"><strong>Update</strong></a>&nbsp;&nbsp;</td>
        <td align="right" style="background:#ddd; font-weight:bold"> Total </td>
        <td align="right" style="background:#ddd; font-weight:bold"><?= $totalprice ?> </td>
        <td style="background:#ddd; font-weight:bold"> </td>
    </tr>
</table>
<div style="float:right; width: 215px; margin-top: 20px;">

    <p><a href="checkout.html">Proceed to checkout</a></p>
    <p><a href="javascript:history.back()">Continue shopping</a></p>

</div>
