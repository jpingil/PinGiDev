<main>
    <section>
        <div id="presentation">
            <h1>Jorge Pino Gil</h1>
            <p>Web Developer</p>
        </div>
    </section>
    <section>
        <div  class="grid" id="description">
            <img src="assets/imgs/AboutMe/jorge.jpg" alt="PinGiDev selfie" />
            <p>
                Hello! My name is Jorge, and I am a web developer. I finished the
                higher education cycle in web development and now I want to study
                computer enginering.
            </p>
        </div>
    </section>
    <section class="grid">
        <div id="skills">
            <h2>Skills</h2>
            <div class="aptitudes">
                <div>
                    <i class="fa-brands fa-css3-alt icon"></i>                    
                    <p>CSS</p>
                </div>
                <div>
                    <i class="fa-brands fa-js icon"></i>
                    <p>JavaScript</p>
                </div>               
                <div>
                    <i class="fa-brands fa-html5 icon"></i>
                    <p>HTML</p>
                </div>                
                <div>
                    <i class="fa-brands fa-bootstrap icon"></i>
                    <p>Boostrap</p>
                </div>                
                <div>
                    <i class="fa-brands fa-php icon"></i>
                    <p>PHP</p>
                </div>                
                <div>
                    <i class="fa-brands fa-java icon"></i>
                    <p>Java</p>
                </div>                
                <div>
                    <i class="fa-brands fa-aws icon"></i>
                    <p>AWS</p>
                </div>
                <div>
                    <i class="fa-brands fa-microsoft icon"></i>
                    <p>Power Bi</p>
                </div>               
                <div>
                    <i class="fa-solid fa-database icon"></i>
                    <p>SQL</p>
                </div>
            </div>
        </div>
        <div id="formation">
            <h2>Formation</h2>
            <div class="formation">
                <p>Bachelor's degree</p>
                <p>Higher Cycle of Web Application Development</p>
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