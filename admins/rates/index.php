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
<style>
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
                                    <th style="white-space: nowrap">Xếp hạng</th>
                                    <th style="white-space: nowrap">Mô tả</th>
                                    <th style="white-space: nowrap">Ngày tạo</th>
                                    <th style="white-space: nowrap">Ngày cập nhật</th>
                                    <th style="white-space: nowrap">Trạng thái</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sql = "SELECT *,
                                                    users.fullname as user_name,
                                                    ratehotels.status as status_rate,
                                                    ratehotels.rate as rate_hotel,
                                                    ratehotels.description as description_rate,
                                                    ratehotels.createdAt as created_at,
                                                    ratehotels.updatedAt as updated_at,
                                                    ratehotels.id as rate_id
                                                FROM ratehotels
                                                LEFT JOIN users ON ratehotels.userId = users.id
                                                INNER JOIN hotels ON hotels.id = ratehotels.hotelId
                                                WHERE ratehotels.status != 'DELETED' ORDER BY ratehotels.createdAt DESC";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll();
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                        if (!empty($result['user_name'])) {
                                            $fullName = htmlentities($result['user_name']);
                                        } else {
                                            $fullName = htmlentities('Khách vãng lai');
                                        }

                                        if ($result['status_rate'] === 'WAITING') {
                                            $status_rate = 'Đang chờ duyệt';
                                        } else {
                                            $status_rate = 'Đã duyệt';
                                        }
                                        ?>
                                        <tr id="record-<?php echo $result['rate_id'] ?>">
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo $fullName ?></td>
                                            <td><?php echo $result['rate_hotel']; ?> Sao</td>
                                            <td><?php echo $result['description_rate']; ?></td>
                                            <td><?php echo $result['created_at']; ?></td>
                                            <td><?php echo $result['updated_at']; ?></td>
                                            <td><?php echo $status_rate ?></td>
                                            <td>
                                                <?php if ($result['status_rate'] !== 'ENABLE') { ?>
                                                <button type="button" name="" id="submit-rate-<?php echo $result['rate_id'] ?>" class="btn-primary btn"  onclick="confirmRecord(<?php echo $result['rate_id'] ?>)">Duyệt</button>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button type="button" name="" class="btn-danger btn delete-button" onclick="deleteRecord(<?php echo $result['rate_id'] ?>)">Xóa</button>
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
                        alert(error)
                        alert(status)
                        alert(xhr)
                        // Handle the error here
                    }
                });
            }
        })
    }
    function confirmRecord(id) {
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
                $.ajax({
                    url: "confirm.php",
                    method: "POST",
                    data: {id: id},
                    success: function (response) {
                        if (response.key) {
                            $("#submit-rate-"+ id).hide();

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