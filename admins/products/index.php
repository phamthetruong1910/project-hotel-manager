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
<style>
    .text-limit {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
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
                            DANH SÁCH
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
                                    <th style="white-space: nowrap">Hình ảnh khách sạn</th>
                                    <th style="white-space: nowrap">Tên</th>
                                    <th style="white-space: nowrap">Loại hình</th>
                                    <th style="white-space: nowrap">Vị trí</th>
                                    <th style="white-space: nowrap">Hạng</th>
                                    <th style="white-space: nowrap">Ngày tạo</th>
                                    <th style="white-space: nowrap">Tạo bởi</th>
                                    <th style="white-space: nowrap">Cập nhật</th>
                                    <th style="white-space: nowrap">Cập nhật bởi</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $sql = "SELECT * from hotels where status != 'DELETED' ORDER BY createdAt DESC";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {

                                        $sqlImage = "SELECT * from images where code = 'HOTEL' AND objectId =:objectId limit 1";
                                        $queryImage = $dbh->prepare($sqlImage);
                                        $queryImage->bindParam(':objectId', $result->id);
                                        $queryImage->execute();
                                        $image = $queryImage->fetch(PDO::FETCH_OBJ);

                                        ?>
                                        <tr id="record-<?php echo $result->id ?>">
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <?php
                                                if ($image && $image->name) { ?>
                                                    <td style="width: 200px">
                                                        <a href="../images/products/<?php echo $image->name ?>"
                                                           data-lightbox="example">
                                                            <img width="500px" class="img-thumbnail" src="../images/products/<?php echo $image->name ?>">
                                                        </a>
                                                    </td>
                                                        <?php
                                                } else { ?>
                                                    <td></td>
                                                    <?php
                                                }
                                            ?>

                                            <td><?php echo htmlentities($result->name); ?></td>
                                            <td><?php echo htmlentities($result->type); ?></td>
                                            <td><?php echo htmlentities($result->district); ?></td>
                                            <td>
                                                <?php echo $result->ranking . ' Sao';  ?>
                                            </td>
                                            <td><?php echo $result->createdAt; ?></td>
                                            <td><?php echo $result->createdBy; ?></td>
                                            <td><?php echo $result->updatedAt; ?></td>
                                            <td><?php echo $result->updatedBy; ?></td>

                                            <td>
                                                <button type="button" name="" class="btn-danger btn delete-button" data-id="<?php echo $result->id ?>" onclick="deleteRecord(<?php echo $result->id ?>)">Xóa</button>
                                            </td>
                                            <td>
                                                <a href="details.php?id=<?php echo htmlentities($result->id); ?>">
                                                    <button type="button" class="btn btn-primary btn-block">Chi tiết và cập nhật phòng
                                                    </button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="update.php?id=<?php echo htmlentities($result->id); ?>">
                                                    <button type="button" class="btn btn-primary btn-block">Cập nhật
                                                    </button>
                                                </a>
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
                        swal("Lỗi trong quá trình xử lý dữ liệu!", "", "error");

                        // Handle the error here
                    }
                });
            }
        })
    }
</script>
<?php include('structure/footer.php') ?>
</html>