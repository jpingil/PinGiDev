
<main>
    <h2>Products</h2>
    <?php if (!empty($products)) {
        ?>
        <div class="products">
            <div class="product">
                <a href="Product.html">
                    <img src="" alt="" />
                </a>
                <div class="buttons">
                    <button class="btnCompra"><?php echo $products['price']; ?></button>
                    <button class="btnFavorito"><i class="fa fa-heart"></i></button>
                </div>
            </div>
        </div>
    <?php } ?>
</main>