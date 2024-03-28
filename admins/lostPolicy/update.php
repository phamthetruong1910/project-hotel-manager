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

        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Chính sách sử dụng</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <?php
                        $sql = "SELECT * FROM pages WHERE type = 'LOST_POLICY' AND status != 'DELETED' ";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $privacyTerms = $query->fetch();
                        ?>
                        <form id="form_validation">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="title" class="form-control" name="title" <?php if ($query->rowCount() > 0) { ?>value="<?php echo $privacyTerms['title']; ?>" <?php } ?> required>
                                    <label class="form-label">Tiêu đề</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <textarea name="description" id="description" cols="30" rows="5" class="form-control no-resize" style="height: 400px"><?php if ($query->rowCount() > 0) { echo $privacyTerms['description']; } ?></textarea>
                                    <label class="form-label">Mô tả</label>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect" type="button" onclick="updateForm()">Cập nhật</button>
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
    function updateForm() {
        event.preventDefault()
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
                var title = document.getElementById("title").value;
                var description = document.getElementById("description").value;

                $.ajax({
                    url: "submit.php",
                    method: "POST",
                    data: {
                        title: title,
                        description: description
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
</script>
<?php include('structure/footer.php') ?>
</html>