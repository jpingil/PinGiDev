<main>
    <article>
        <h2>Product</h2>
        <div id="product" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-inner">
                <?php
                for ($i = 0; $i < $product['img_carousel_length']; $i++) {
                    ?>
                    <div class="carousel-item active">
                        <img src="<?=
                        'assets/' . $product['img_folder'] . '/Carousel Images/' .
                        $product['product_name'] . $i . '.' . $product['img_extension'];
                        ?>" alt="<?= $product['product_description']; ?>" class="d-block w-100">
                    </div>
                    <?php
                }
                ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#product" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#product" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </article>
</main>

