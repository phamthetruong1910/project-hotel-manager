<?php
session_start();
include('../config.php');
if (empty($_SESSION['alogin'])) {
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<html>
<?php
include('structure/header.php');
include ('../structure/menu.php');

?>

<body class="theme-red">
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>

            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Cập nhật khách hàng</h2>

                    </div>
                    <div class="body">
                        <?php
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM users WHERE id =:id AND status != 'DELETED' ";
                        $query = $dbh->prepare($sql);
                        $query->bindParam('id', $id);
                        $query->execute();
                        $user = $query->fetch();
                        ?>
                        <form id="form_validation">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="fullName" class="form-control" name="fullName" <?php if ($query->rowCount() > 0) { ?>value="<?php echo $user['fullName']; ?>" <?php } ?> required>
                                    <label class="form-label">Tên</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="mobileNumber" class="form-control" name="mobileNumber" onblur="validatePhoneNumber(this, '<?php echo $id; ?>')" <?php if ($query->rowCount() > 0) { ?>value="<?php echo $user['mobileNumber']; ?>" <?php } ?> required>
                                    <label class="form-label">Số điện thoại</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="email" class="form-control" name="email"  onblur="validateEmail(this, '<?php echo $id; ?>')" <?php if ($query->rowCount() > 0) { ?>value="<?php echo $user['email']; ?>" <?php } ?> required>
                                    <label class="form-label">email</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="password" class="form-control" name="password">
                                    <label class="form-label">mật khẩu</label>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect" id="submitBtn" type="button" onclick="updateForm('<?php echo $id; ?>')">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Validation -->
    </div>
</section>
</body>
<script>
    function updateForm(id) {
        event.preventDefault()

        var form = document.getElementById("form_validation");

        // Trigger form validation
        if (!form.reportValidity()) {
            return;
        }

        Swal.fire({
            title: 'Bạn có chắc chắn  muốn thực hiện cập nhật này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xác nhận',
            cancelButtonText: 'Huỷ'
        }).then((result) => {
            if (result.isConfirmed) {
                var mobileNumber = document.getElementById("mobileNumber").value;
                var name = document.getElementById("fullName").value;
                var email = document.getElementById("email").value;
                var password = document.getElementById("password").value;
                $.ajax({
                    url: "update-submit.php",
                    method: "POST",
                    data: {
                        id: id,
                        name: name,
                        mobileNumber: mobileNumber,
                        email: email,
                        password: password,
                    },
                    success: function (response) {
                        if (response.key) {
                            swal(response.message, "", "success");
                        } else {
                            swal(response.message, "", "error");
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(error)
                        alert(status)
                        alert(xhr)
                        // Handle the error here
                    }
                });
            }
        })

        return false;
    }
    function validateEmail(input, id) {
        var submitButton = document.getElementById("submitBtn");

        $.ajax({
            url: "validate-update-email.php",
            method: "POST",
            data: {
                id: id,
                email: input.value
            },
            success: function (response) {
                if (response.key) {
                    console.log(response.key);
                    submitButton.disabled = false;

                } else {
                    swal(response.message, "", "error");

                    // input.setCustomValidity(response.message);
                    submitButton.disabled = true;
                }
            },
            error: function (xhr, status, error) {
                alert(error)
                alert(status)
                alert(xhr)
                // Handle the error here
            }
        });
    }
    function validatePhoneNumber(input, id) {
        var submitButton = document.getElementById("submitBtn");

        // Xác thực số điện thoại với regex
        var phoneNumberPattern = /^[0-9]{10}$/;
        if (!phoneNumberPattern.test(input.value)) {
            return swal("Vui lòng nhập số điện thoại hợp lệ (10 chữ số).", "", "error");
        }

        $.ajax({
            url: "validate-update-moblie.php",
            method: "POST",
            data: {
                id: id,
                mobileNumber: input.value
            },
            success: function (response) {
                if (response.key) {
                    submitButton.disabled = false;

                } else {
                    swal(response.message, "", "error");

                    submitButton.disabled = true;
                }
            },
            error: function (xhr, status, error) {
                alert(error)
                alert(status)
                alert(xhr)
                // Handle the error here
            }
        });
    }
</script>
<?php include('structure/footer.php') ?>
</html>