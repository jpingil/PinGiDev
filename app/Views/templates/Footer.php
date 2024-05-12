<footer>
    <div class="legal">
        <a href="">Legal Notices</a></p>
        <a href="">Privacity</a></p>
        <a href="">Contact</a></p>
    </div>
    <p id="copyright">© Creative Commons</p>
    <div class="contact">
        <a href="https://www.instagram.com/" class="fa-brands fa-instagram icon" style="color: #ffffff"></a>
        <i class="fa-brands fa-github icon" style="color: #ffffff"></i>
        <i class="fa-regular fa-envelope icon" style="color: #ffffff"></i>
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