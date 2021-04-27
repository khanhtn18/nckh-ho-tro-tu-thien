<footer class="container-fluid bg-dcolor p-5">
    <div class="container my-5 footer-div">
        <p>Hãy giữ liên lạc với chúng tôi! Để lại email và thông tin ở mục bên dưới để có các thông tin mới nhất.</p>
        <form class="form-inline my-5" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="container form-div">
                <label for="inputEmail" class="sr-only">Email</label>
                <input class="rounded-pill" type="email" name="inputEmail" id="inputEmail" placeholder="Email" aria-required="true" aria-invalid="true" required>
                <label for="inputName" class="sr-only">Name</label>
                <input class="rounded-pill" type="text" name="inputName" id="inputName" placeholder="Tên / Tổ Chức" aria-required="true" aria-invalid="true">
                <label for="inputPhone" class="sr-only">Phone</label>
                <input class="rounded-pill" type="tel" name="inputPhone" id="inputPhone" placeholder="Số điện thoại" aria-required="true" aria-invalid="true">
            </div>
            <button type="submit" class="btn btn-primary">Hoàn thành</button>
        </form>
        <p>Mái Ấm Truyền Tin, một mái ấm cho mọi nhà.</p>
        <a class="navbar-brand m-3 p-0 my-5" href="#">
            <img class="rounded-pill" src="img/matt_logo.jpg" width="70" height="70" alt="logo">
        </a>
        <ul id="footer-nav" style="display: flex; flex-direction: row;">
        </ul>
        <ul id="icon-nav" class="my-5">
            <li>
                <a href="https://www.facebook.com/M%C3%A1i-%E1%BA%A4m-Truy%E1%BB%81n-Tin-712547722195087/" title="facebook-link">
                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                </a>
                <a href="#" title="gmail-link">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
        <h1 class="mt-5 font-italic">
            2020 @Mái Ấm Truyền Tin
        </h1>
    </div>
</footer>
<?php
    if (!!$_POST && !!$_POST['inputEmail']) {  
        $msg = 'Tài khoản email ' . $_POST['inputEmail'] . ' gửi thành công!';
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    mysqli_close($con);
?>
<script src="js/optimized-min_7.js"></script><script src="js/optimized-min_5.js"></script><script src="js/optimized-min_1.js"></script><script src="js/optimized-min.js"></script><script src="js/optimized-min_4.js"></script><script src="js/optimized-min_3.js"></script><script src="js/optimized-min_2.js"></script><script src="js/optimized-min_6.js"></script>
<script src="js/main.js"></script>