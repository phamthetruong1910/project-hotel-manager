<?php
session_start();
//if (isset($_POST['signin'])) {
//    $email = $_POST['email'];
//    $password = md5($_POST['password']);
//    try {
//        $sql = "SELECT email,password FROM users WHERE email=:email and password=:password";
//        $query = $dbh->prepare($sql);
//        $query->bindParam(':email', $email, PDO::PARAM_STR);
//        $query->bindParam(':password', $password, PDO::PARAM_STR);
//        $query->execute();
//        $results = $query->fetchAll(PDO::FETCH_OBJ);
//        if ($query->rowCount() > 0) {
//            $_SESSION['login'] = $_POST['email'];
//            echo "<script type='text/javascript'>
//                    Swal.fire({
//                        icon: 'success',
//                        title: 'Đăng nhập thành công!',
//                        showConfirmButton: false,
//                        timer: 1500
//                    }).then(function () {
//                        window.location.href = 'package-list.php';
//                    });
//                  </script>";
//        }
//    } catch (Exception $exception) {
//        echo $exception->getMessage();
//    }
//}

?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
        function submitLogin() {
            event.preventDefault();
            const password = $('#password').val();
            const email = $('#nameEmail').val();

            console.log(email);
            console.log(password);

            $.ajax({
                url: 'includes/submit-login.php',
                method: "POST",
                data: {
                    email: email,
                    password: password
                },
                success: function (response) {
                    if (response.key) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function() {
                            setTimeout(function() {
                                window.location.href = 'package-list.php';
                            }, 500); // Add the desired delay in milliseconds
                        });

                    } else {
                        Swal.fire(response.message, "", "error");
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr)
                    console.error(status)
                    console.error(error)
                    // Handle the error here
                }
            });
        }
</script>
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-info">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body modal-spa">
                <div class="login-grids">
                    <div class="login">
                        <div class="login-left">
                            <ul>
                                <li><a class="fb" href="#"><i></i>Facebook</a></li>
                                <li><a class="goog" href="#"><i></i>Google</a></li>

                            </ul>
                        </div>
                        <div class="login-right">
                            <form method="post">
                                <h3>Đăng Nhập Bằng Tài Khoản của bạn </h3>
                                <input type="text" name="nameEmail" id="nameEmail" placeholder="Nhập email" value="" required style="color: black">
                                <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" value="" style="color: black"
                                       required>
                                <h4><a href="forgot-password.php">Quên mật khẩu</a></h4>

                                <input type="button" style="background: #4CB320;
    color: #fff;
    font-size: 20px;
    border: none;
    width: 100%;
    outline: none;
    -webkit-appearance: none;
    padding: 10px 15px;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    margin-top: 20px;" onclick="submitLogin()" name="signin" value="Đăng nhập">
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <p>Đăng Nhập và Đồng ý với <a href="page.php?type=terms">Các Điều Khoản Điều kiện</a> và <a
                                href="page.php?type=privacy">Chính Sách Bảo Mật</a></p>
                </div>
            </div>
        </div>
    </div>
</div>