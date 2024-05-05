<main>
    <article>
        <h2>Product</h2>
        <div class="product">
            <img src="<?php echo '../assets/' . $product['img_folder'] . '/Main Image/' .
            $product['product_name'] . '.' . $product['img_extension'];
            ?>" alt="<?php echo $product['product_description']; ?>" class="d-block w-100">

            <button class="carousel-control-prev" type="button" data-bs-target="#product" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#product" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </article>
</main>

