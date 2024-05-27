<main>
    <article class="loginRegisterContainer fadeIn">
        <section class="loginContainer">
            <div>
                <h2>Welcome back</h2>
                <p class="paddingP">Enter your details to be able to use all the features of PinGiDev.</p>
            </div>
            <div class="form-container">
                <h2>Login</h2>
                <form action="/Login" method="post">
                    <div class="inputContainer">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required />
                    </div>
                    <div class="inputContainer">
                        <i class="fa-solid fa-lock"></i>
                        <input
                            type="password"
                            name="pass"
                            placeholder="Password"
                            required
                            />
                    </div>
                    <button>Login</button>
                    <?php
                    if (isset($errors['login'])) {
                        ?>
                        <p class="text-danger d-flex justify-content-center"><?php echo $errors['login'] ?></p>
                        <?php
                    }
                    ?>
                </form>
                <p>Not registered yet? <span onclick="seeLoginRegister('Register')" id="register">Register.</span></p>
            </div>
        </section>
    </article>
</main>

