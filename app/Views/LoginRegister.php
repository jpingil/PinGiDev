

<main>
    <article>

        <input type="checkbox" id="chk" />

        <section class="signup">

            <form action="/Register" method="post">
                <label for="chk">Sign up</label>
                <input type="text" name="userName" placeholder="User name" 
                       value="<?php echo (isset($data['userName'])) ? $data['userName'] : ""; ?>"
                       required />
                <input type="email" name="email" placeholder="Email"
                       value="<?php echo (isset($data['email'])) ? $data['email'] : ""; ?>"
                       required />
                <input
                    type="password"
                    name="pass"
                    placeholder="Password"
                    value="<?php echo (isset($data['pass'])) ? $data['pass'] : ""; ?>"
                    required
                    />
                <input
                    type="password"
                    name="pass2"
                    placeholder="Verify password"
                    value="<?php echo (isset($data['pass2'])) ? $data['pass2'] : ""; ?>"
                    required
                    />

                <button type="submit">Sign up</button>                    
                <?php
                if (isset($errors)) {
                    ?>
                    <p class="text-danger d-flex justify-content-center"><?php echo $errors['registerErrors'] ?></p>
                    <?php
                }
                ?>

            </form>
        </section>

        <section class="login">
            <form action="/Login" method="post">
                <label for="chk">Login</label>
                <input type="email" name="email" placeholder="Email" required="" />
                <input
                    type="password"
                    name="pswd"
                    placeholder="Password"
                    required
                    />
                <button>Login</button>
            </form>
        </section>

    </article>
</main>

