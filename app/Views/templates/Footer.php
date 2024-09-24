<footer>
    <div class="legal">
        <a href="">Legal Notices</a></p>
        <a href="">Privacity</a></p>
        <a href="">Contact</a></p>
    </div>
    <p id="copyright">© Creative Commons</p>
    <div class="contact">
        <a href="https://www.instagram.com/" class="fa-brands fa-instagram icon" style="color: #ffffff" aria-label="Instagram"></a>
        <a class="fa-brands fa-github icon" style="color: #ffffff" aria-label="GitHub"></a>
        <a class="fa-regular fa-envelope icon" style="color: #ffffff" aria-label="Linkedln"></a>
    </div>
</footer>
<script src="assets/js/bootstrap.min.js"></script>
<?php
if (isset($jss)) {
    foreach ($jss as $js) {
        ?>
        <script src="assets/js/<?php echo $js ?>.js"></script>
        <?php
    }
}
?>
</body>
</html>