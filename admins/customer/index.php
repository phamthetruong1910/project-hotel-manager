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

<body class="theme-red"><style>
    .dt-buttons {
    }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>


            </h2>
        </div>
        <!--  -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>

                        </h2>
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th style="white-space: nowrap">#</th>
                                    <th style="white-space: nowrap">Tên</th>
                                    <th style="white-space: nowrap">Số điện thoại</th>
                                    <th style="white-space: nowrap">email</th>
                                    <th style="white-space: nowrap">Ngày tạo</th>
                                    <th style="white-space: nowrap">Ngày cập nhật</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tfoot>

                                </tfoot>
                                <tbody>
                                <?php $sql = "SELECT * from users where status != 'DELETED'";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                        ?>
                                        <tr id="record-<?php echo $result->id ?>">
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo htmlentities($result->fullName); ?></td>
                                            <td><?php echo htmlentities($result->mobileNumber); ?></td>
                                            <td><?php echo htmlentities($result->email); ?></td>
                                            <td><?php echo $result->createdAt; ?></td>
                                            <td><?php echo $result->updatedAt; ?></td>
                                            <td>
                                                <button type="button" name="" class="btn-danger btn delete-button" data-id="<?php echo $result->id ?>" onclick="deleteRecord(<?php echo $result->id ?>)">Xóa</button>
                                            </td>
                                            <td>
                                                <a href="update.php?id=<?php echo $result->id ?>" class="btn btn-primary btn-block">Cập nhật</a>
                                            </td>
                                        </tr>
                                        <?php $cnt = $cnt + 1;
                                    }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END#  -->
    </div>
</section>

</body>
<script>
    function deleteRecord(id) {
        // You can use AJAX to send the ID to the delete.php file and delete the record
        Swal.fire({
            title: 'Bạn có chắc chắn  muốn thực hiện xóa ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xác nhận',
            cancelButtonText: 'Huỷ'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "delete.php",
                    method: "POST",
                    data: {id: id},
                    success: function (response) {
                        if (response.key) {
                            $("#record-" + id).remove();

                            $("#table-id").load(location.href + " #table-id>*", "");
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
    }
</script>
<?php include('structure/footer.php') ?>
</html>