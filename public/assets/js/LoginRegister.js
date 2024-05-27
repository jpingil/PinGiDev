function seeLoginRegister(view) {
    var container = document.querySelector('.loginRegisterContainer');
    var data = {view: view};

    fetch("/seeLoginRegister", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(data)
    }).then(response => {
        if (response.ok) {
            return response.json();
        }
        throw new Error('LoginRegister fetch error.');
    })
            .then(data => {
                container.classList.remove('fadeIn');
                container.classList.add('fadeOut');

                setTimeout(() => {
                    if (data === 'Login') {
                        container.innerHTML = `
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
                                    <input type="password" name="pass" placeholder="Password" required />
                                </div>
                                <button>Login</button>
                            </form>
                            <p>Not registered yet? <span onclick="seeLoginRegister('Register')" id="register">Register.</span></p>
                        </div>
                    </section>`;
                    } else if (data === 'Register') {
                        container.innerHTML = `
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
                            </form>
                            <p>Already registered? <span onclick="seeLoginRegister('Login')" id="register">Login.</span></p>
                        </div>
                        <div>
                            <h2>Welcome to PinGiDev</h2>
                            <p class='paddingP'>You are on the website for the sale of websites. Create your 
                                own username to be able to make use of all the functions of 
                                the website. If you have any questions, don't hesitate to ask.</p>
                        </div>
                    </section>`;
                    } else {
                        throw new Error('Invalid response from server.');
                    }

                    container.classList.remove('fadeOut');
                    container.classList.add('fadeIn');
                }, 200);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
}
