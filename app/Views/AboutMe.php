<main>
    <section id="presentation">
        <h1>Jorge Pino Gil</h1>
        <p>Web Developer</p>
    </section>
    <section>
        <div id="description">
            <img src="assets/imgs/AboutMe/jorge.jpg" alt="PinGiDev selfie" />
            <p>
                Hello! My name is Jorge, and I am a web developer. I finished the
                higher education cycle in web development and now I want to study
                computer enginering.
            </p>
        </div>
    </section>
    <section>
        <div id="formation">
            <h2>Formation</h2>
            <div class="formation">
                <p>Bachelor's degree</p>
                <p>Higher Cycle of Web Application Development</p>
            </div>
        </div>
        <div id="skills">
            <h2>Skills</h2>
            <div class="aptitudes">
                <p>CSS</p>
                <p>PHP</p>
                <p>Java</p>
                <p>HTML</p>
                <p>JavaScript</p>
                <p>Bootstrap</p>
                <p>Power Bi</p>
                <p>AWS</p>
                <p>SQL</p>
            </div>
        </div>
    </section>
    <section>
        <?php
        if (isset($products) && !empty($products)) {
            ?>
            <div id="products">
                <h2>Products</h2>
                <div id="carouselProducts" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <?php
                        $counter = 0;
                        foreach ($products as $product) {
                            ?>
                            <div class="carousel-item <?php echo ($counter === 0) ? 'active' : ''; ?>">
                                <img src="<?php
                                echo '../../assets/' . $product['img_folder'] . '/Main Image/' .
                                $product['product_name'] . '.' . $product['img_extension'];
                                ?>" alt="<?php echo $product['product_description']; ?>" class="d-block" id="producImg">                
                            </div>
                            <?php
                            $counter++;
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselProducts" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselProducts" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <?php
        }
        ?>
    </section>
</main>