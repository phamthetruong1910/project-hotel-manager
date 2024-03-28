<?php
session_start();
include('../config.php');
if (empty($_SESSION['alogin'])) {
    header('location:../index.php');
}

if (empty($_GET['id'])) {
    header('location:index.php');
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
        <!--  -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            CHI TIẾT PHÒNG
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="create-room.php?id=<?php echo $_GET['id'] ?>">
                                    <button type="button" class="btn btn-primary btn-block">TẠO MỚI
                                    </button>
                                </a></td>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th style="white-space: nowrap">#</th>
                                    <th style="white-space: nowrap">Hình ảnh chi tiết phòng</th>
                                    <th style="white-space: nowrap">Tên phòng khách sạn</th>
                                    <th style="white-space: nowrap">Khách sạn</th>
                                    <th style="white-space: nowrap">Code</th>
                                    <th style="white-space: nowrap">Giường đôi</th>
                                    <th style="white-space: nowrap">Giường đơn</th>
                                    <th style="white-space: nowrap">Số lượng người</th>
                                    <th style="white-space: nowrap">Diện tích</th>
                                    <th style="white-space: nowrap">Giá</th>
                                    <th style="white-space: nowrap">Tổng số phòng</th>
                                    <th style="white-space: nowrap">Phần trăm đặt cọc</th>
                                    <th style="white-space: nowrap">Đặt cọc</th>
                                    <th style="white-space: nowrap"></th>
                                    <th style="white-space: nowrap"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $id = $_GET['id'];
                                $sql = "SELECT * from roomtype where hotelId=:hotelId AND status != 'DELETED'";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':hotelId',$id);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {

                                        $sqlImage = "SELECT * from images where code = 'ROOMTYPE' AND objectId =:objectId";
                                        $queryImage = $dbh->prepare($sqlImage);
                                        $queryImage->bindParam(':objectId', $result->id);
                                        $queryImage->execute();
                                        $images = $queryImage->fetchAll(PDO::FETCH_OBJ);

                                        $sqlHotel = "SELECT * from hotels where id=:id AND status != 'DELETED'";
                                        $queryHotel = $dbh->prepare($sqlHotel);
                                        $queryHotel->bindParam(':id', $result->hotelId);
                                        $queryHotel->execute();
                                        $hotelName = $queryHotel->fetch();
                                        ?>
                                        <tr id="record-<?php echo $result->id ?>">
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td>
                                                <?php foreach ($images as $image)  {?>
                                                <a href="../images/products/<?php echo $image->name ?>"
                                                   data-lightbox="example">
                                                    <img width="200px" class="img-thumbnail" src="../images/products/<?php echo $image->name ?>">
                                                </a>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo htmlentities($result->name); ?></td>
                                            <td>
                                                <a href="../../package-details.php?pkgid=<?php echo htmlentities($result->hotelId); ?>"><?php echo htmlentities($hotelName['name']); ?></a>
                                            </td>
                                            <td><?php echo htmlentities($result->code); ?></td>
                                            <td><?php echo htmlentities($result->doubleBed); ?></td>
                                            <td><?php echo htmlentities($result->singleBed); ?></td>
                                            <td><?php echo htmlentities($result->numberCustomer); ?></td>
                                            <td><?php echo htmlentities($result->acreage) . ' m2'; ?></td>
                                            <td><?php echo number_format($result->price, 0, ',', '.') . ' VND'; ?></td>
                                            <td><?php echo htmlentities($result->totalNumber); ?></td>
                                            <td><?php echo htmlentities($result->depositPercent); ?></td>
                                            <td><?php if ($result->isUseDeposit) { echo '<span class="label label-success">Cho phép</span>'; } else { echo '<span class="label label-danger">Không cho phép</span>'; } ?></td>
                                            <td>
                                                <button type="button" name="" class="btn-danger btn delete-button" data-id="<?php echo $result->id ?>" onclick="deleteRecord(<?php echo $result->id ?>)">Xóa</button>
                                            </td>
                                            <td>
                                                <a href="update-room.php?id=<?php echo htmlentities($result->id); ?>">
                                                    <button type="button" class="btn btn-primary btn-block">Cập nhật
                                                    </button>
                                                </a></td>

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
                    url: "delete-room.php",
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