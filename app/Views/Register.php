<main>
    <article class="loginRegisterContainer">
        <section class="registerContainer">
            <div class="form-container">
                <h2>Sign up</h2>
                <form action="/Register" method="post">
                    <div class="inputContainer">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="user_name" placeholder="User name" required />
                    </div>
                    <div class="inputContainer">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required />
                    </div>
                    <div class="inputContainer">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="pass" placeholder="Password" required />
                    </div>
                    <div class="inputContainer">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="pass2" placeholder="Verify password" required />
                    </div>
                    <button>Register</button>
                    <?php
                    if (isset($errors['register'])) {
                        ?>
                        <p class="text-danger d-flex justify-content-center"><?php echo $errors['register'] ?></p>
                        <?php
                    }
                    ?>
                </form>
                <p>Already registered? <span onclick="seeLoginRegister('Login')" id="register">Login.</span></p>
            </div>
            <div>
                <h2>Welcome to PinGiDev</h2>
                <p class='paddingP'>You are on the website for the sale of websites. Create your 
                    own username to be able to make use of all the functions of 
                    the website. If you have any questions, don't hesitate to ask.</p>
            </div>
        </section>
    </article>
</main>

