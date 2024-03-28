<?php
session_start();
error_reporting(0);
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $mnumber = $_POST['mobilenumber'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $dateTimeNow = date("Y-m-d H:i:s");
    $status = 'ENABLE';
    $sqlUser = "SELECT * FROM users WHERE email=:email AND status != 'DELETED'";
    $queryUser = $dbh->prepare($sqlUser);
    $queryUser->bindParam(':email', $email);
    $queryUser->execute();

    $sqlUserPhone = "SELECT * FROM users WHERE mobileNumber=:mobileNumber AND status != 'DELETED'";
    $queryUserPhone = $dbh->prepare($sqlUserPhone);
    $queryUserPhone->bindParam(':mobileNumber', $mnumber);
    $queryUserPhone->execute();


    if ($queryUser->rowCount() > 0) {
        $_SESSION['msg'] = "Email bị trùng lặp!";
        $url = "thankyou.php";
        echo "<script>location.href='$url'</script>";
        exit();
    } elseif ($queryUserPhone->rowCount() > 0) {
        $_SESSION['msg'] = "Số điện thoại bị trùng lặp!";
        $url = "thankyou.php";
        echo "<script>location.href='$url'</script>";
        exit();
    } else {
        try {
            $sql = "INSERT INTO users(fullName,mobileNumber,email,password,createdAt,status) VALUES(:fname,:mnumber,:email,:password,:createdAt,:status)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':fname', $fname, PDO::PARAM_STR);
            $query->bindParam(':mnumber', $mnumber, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->bindParam(':createdAt', $dateTimeNow);
            $query->bindParam(':status', $status);

            $query->execute();

            if ($query->rowCount() > 0) {
                $_SESSION['msg'] = "Bạn đã đăng ký thành công.";
                $_SESSION['login'] = $email;

                echo "<script type='text/javascript'> document.location = 'package-list.php'; </script>";
            } else {
                $_SESSION['msg'] = "Something went wrong. Please try again.";
                $url = "thankyou.php";
                echo "<script>location.href='$url'</script>";
                exit();
            }
        } catch (Exception $exception) {
            $_SESSION['msg'] = "Lỗi trong quá trình cập nhật dữ liệu";
        }
    }
}
?>
<!--Javascript for check email availabilty-->
<script>
    function checkAvailability() {

        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data: 'emailid=' + $("#email").val(),
            type: "POST",
            success: function (data) {
                $("#user-availability-status").html(data);
                $("#loaderIcon").hide();
            },
            error: function () {
            }
        });
    }
    function checkPhone() {
        var phone = $("#mobilenumber").val();
        $("#loaderIcon").show();
        console.log($("#mobilenumber").val())
        jQuery.ajax({
            url: "check-phone-signin.php",
            data: {
                phone: phone
            },
            type: "POST",
            success: function (data) {
                $("#user-availability-status-phone").html(data);
                $("#loaderIcon").hide();
            },
            error: function () {
            }
        });
    }

    function validatePhoneNumber(input) {
        // Kiểm tra nếu phím được nhấn không phải là số
        if (event.keyCode < 48 || event.keyCode > 57) {
            event.preventDefault();
        }

        // Xác thực số điện thoại với regex
        var phoneNumberPattern = /^[0-9]{10}$/;
        if (!phoneNumberPattern.test(input.value)) {
            input.setCustomValidity("Vui lòng nhập số điện thoại hợp lệ (10 chữ số).");
        } else {
            input.setCustomValidity("");
        }
    }

</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <section>
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
                                <form name="signup" method="post">
                                    <h3>Tạo tài khoản</h3>

                                    <input type="text" value="" placeholder="Họ và tên" name="fname" autocomplete="off" style="color: black"
                                           required="">
                                    <input type="text" value="" placeholder="Số điện thoại" maxlength="10" oninput="validatePhoneNumber(this)" onkeypress="validatePhoneNumber(this)" style="color: black"
                                           name="mobilenumber" id="mobilenumber" onblur="checkPhone()" autocomplete="off" required="">
                                    <span id="user-availability-status-phone" style="font-size:12px;"></span>

                                    <input type="text" value="" placeholder="Nhập email" name="email" id="email" style="color: black"
                                           onBlur="checkAvailability()" autocomplete="off" required="">
                                    <span id="user-availability-status" style="font-size:12px;"></span>
                                    <input type="password" value="" placeholder="Nhập mật khẩu" name="password" required="" style="color: black">
                                    <input type="submit" name="submit" id="submit" value="Đăng ký">
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <p>Đăng Nhập và Đồng ý với<a href="page.php?type=LOST_POLICY">Các Điều Khoản Sử dụng</a> và <a
                                    href="page.php?type=PRIVACY_TERMS">Chính Sách Bảo Mật</a></p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>