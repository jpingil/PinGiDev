<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../public/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../public/assets/css/All.css" />
    <link rel="stylesheet" href="../../public/assets/css/<?php echo $view;?>.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <title>PinGiDev</title>
    <link rel="icon" href="../../public/assets/imgs/icon/PinGiDevMini.png">
  </head>
  <body>
    <header>
      <h1><a href="Aboutme.html"><img src="../../public/assets/imgs/icon/PinGiDev.png" alt="Principal icon of PinGiDev"></a></h1>
      <nav class="navbar navbar-expand-lg navbar-dark">
        <button
          class="navbar-toggler shadow-none border-0"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasDarkNavbar"
          aria-controls="offcanvasDarkNavbar"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="offcanvas offcanvas-end bg-black text-bg-dark"
          tabindex="-1"
          id="offcanvasDarkNavbar"
          aria-labelledby="offcanvasDarkNavbarLabel"
        >
          <div class="offcanvas-header">
            <button
              type="button"
              class="btn-close btn-close-white border-0 shadow-none"
              data-bs-dismiss="offcanvas"
              aria-label="Close"
            ></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#"
                  >About Me</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Products.html">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="CustomProject.html">Custom Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="LoginRegister.html">Login Register</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>