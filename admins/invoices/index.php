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
                                    <th></th>
                                    <th style="white-space: nowrap">code</th>
                                    <th style="white-space: nowrap">Ngày đặt phòng</th>
                                    <th style="white-space: nowrap">Khách sạn</th>
                                    <th style="white-space: nowrap">Hình thức thanh toán</th>
                                    <th style="white-space: nowrap">Tổng tiền đã cọc</th>
                                    <th style="white-space: nowrap">liên hệ</th>
                                    <th style="white-space: nowrap">Ngày nhận phòng</th>
                                    <th style="white-space: nowrap">Ngày Trả phòng</th>
                                    <th style="white-space: nowrap">Tổng số ngày</th>
                                    <th style="white-space: nowrap">Yêu cầu</th>
                                    <th style="white-space: nowrap">Trạng thái</th>
                                    <th style="white-space: nowrap">Ngày Đặt phòng</th>
                                    <th style="white-space: nowrap">Ngày cập nhật</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th style="white-space: nowrap">Hủy bởi</th>
                                    <th style="white-space: nowrap">Ngày huỷ</th>
                                    <th style="white-space: nowrap">Ghi chú admin</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $sql = "SELECT 
                                            *,
                                            invoice.id as invoice_id,
                                            hotels.name as hotel_name, 
                                            invoice.createdAt as invoice_created, 
                                            paymentmethod.name as payment_method_name,
                                            invoice.updatedAt as update_at_invoice,
                                            invoice.updatedBy as update_by_invoice,
                                            invoice.createdAt as invoice_created,
                                            invoice.cancelAt as invoice_cancel_at,
                                            invoice.cancelBy as invoice_cancel_by,
                                            hotels.id as hotel_id
                                    FROM invoice 
                                    INNER JOIN users ON users.id = invoice.userId 
                                    INNER JOIN hotels ON hotels.id = invoice.hotelId 
                                    INNER JOIN invoicepayment ON invoice.id = invoicepayment.invoiceId 
                                    INNER JOIN paymentmethod ON paymentmethod.id = invoicepayment.paymentId WHERE invoice.status != 'DELETED' ORDER BY invoice_created DESC ";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll();
                                $cnt = 1;

                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                        ?>
                                        <tr align="center" id="record-<?php echo $result['invoice_id'] ?>">
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php if ($result['code']) { echo htmlentities($result['code']); } else { echo $result['invoice_id']; } ?></td>
                                            <td><?php echo htmlentities($result['invoice_created']); ?></td>
                                            <td>
                                                <a href="../../package-details.php?pkgid=<?php echo htmlentities($result['hotel_id']); ?>"><?php echo htmlentities($result['hotel_name']); ?></a>
                                            </td>
                                            <td>
                                                <?php echo htmlentities($result['payment_method_name']); ?>
                                            </td>
                                            <td><b><?php echo htmlentities(number_format($result['price'], 0, ',', '.')) . ' VND'; ?></b></td>
                                            <td>
                                                <?php echo htmlentities(($result['emailContact']) . '-' .htmlentities($result['mobileContact'])); ?>
                                            </td>
                                            <td><?php echo ($result['fromDate']); ?></td>
                                            <td><?php echo ($result['toDate']); ?></td>
                                            <td><?php echo ($result['numberDay']); ?></td>
                                            <td><?php echo htmlentities($result['comment']); ?></td>
                                            <td><?php
                                                $now = new DateTime();
                                                $target = new DateTime($result['fromDate']);

                                                $interval = $now->diff($target);
                                                $daysRemaining = $interval->days;
                                                if ($result['status'] === 'ENABLE' && $daysRemaining >= 3) {
                                                    echo '<span class="label label-success">Đang trong tiến trình</span>';
                                                } else if ($result['status'] === 'ENABLE' && $result['fromDate'] > date("Y-m-d H:i:s")) {
                                                    echo '<span class="label label-warning">Sắp tới hạn</span>';
                                                } else if($result['status'] === 'CANCEL') {
                                                    echo '<span class="label label-default">Đã Huỷ</span>';
                                                } else if ($result['status'] === 'EXPIRES' || $result['fromDate'] < date("Y-m-d H:i:s")) {
                                                    echo '<span class="label label-danger">Hết hạn</span>';
                                                } else if ($result['status'] === 'USED') {
                                                    echo '<span class="label label-success">Đã sử dụng</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo htmlentities($result['invoice_created']); ?>
                                            </td>
                                            <td>
                                                <?php echo htmlentities($result['update_at_invoice']); ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" href="details.php?bkid=<?php echo htmlentities($result['invoice_id']); ?>">Chi tiểt</a>
                                            </td>
                                            <td>
                                            <?php if ($result['status'] === 'CANCEL') {
                                                ?>
                                            <?php } else { ?>
                                                <a class="btn btn-group"
                                                       onclick="cancelRecord(<?php echo $result['invoice_id'] ?>)">Hủy đặt phòng</a>
                                            <?php } ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger"
                                                   onclick="deleteRecord(<?php echo $result['invoice_id'] ?>)">Xoá hoá đơn</a>
                                            </td>
                                            <td>
                                                <?php echo htmlentities($result['cancelBy']); ?>
                                            </td>
                                            <td>
                                                <?php echo htmlentities($result['invoice_cancel_at']); ?>
                                            </td>
                                            <td>
                                                <?php echo htmlentities($result['noteAdmin']); ?>
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
    function cancelRecord(id) {
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
                    url: "cancel.php",
                    method: "POST",
                    data: {id: id},
                    success: function(response) {
                        if (response.key) {
                            $("#record-"+id).remove();

                                $("#table-id").load(location.href + " #table-id>*", "");
                            swal(response.message, "", "success");
                        } else {
                            swal(response.message, "", "error");
                        }
                    },
                    error: function(xhr, status, error) {
                        swal("Lỗi trong quá trình xử lý dữ liệu!", "", "error");
                    }
                });
            }
        })
    }

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
                    success: function(response) {
                        if (response.key) {
                            $("#record-"+id).remove();

                            $("#table-id").load(location.href + " #table-id>*", "");
                            swal(response.message, "", "success");
                        } else {
                            swal(response.message, "", "error");
                        }
                    },
                    error: function(xhr, status, error) {
                        swal("Lỗi trong quá trình xử lý dữ liệu!", "", "error");
                    }
                });
            }
        })
    }

</script>
<?php include('structure/footer.php') ?>
</html>