<?php
session_start();
include('../config.php');
if (empty($_SESSION['alogin']) || empty($_GET['bkid'])) {
    header('location: ../../index.php');
}
?>
<!DOCTYPE html>
<html>
<?php
include('structure/header.php');
include ('../structure/menu.php');
$invoiceId = $_GET['bkid'];
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
                        <button class="btn btn-success" onclick="SubmitIssue(<?php echo $invoiceId; ?>)" >Cập nhật yêu cầu khách hàng</button>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên phòng</th>
                                    <th>Giá gốc</th>
                                    <th>Tiền đã cọc</th>
                                    <th>Tổng số phòng cọc</th>
                                    <th>Phần trăm cọc</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php

                                $sql = "SELECT 
                                            *,
                                            invoicedetails.id as invoice_detail_id,
                                            invoicedetails.price as invoiceDetail_price,
                                            invoicedetails.quantity as invoicedetail_quantity,
                                            roomtype.name as roomtype_name,
                                            roomtype.price as roomtype_price,
                                            roomtype.depositPercent as roomtype_deposit,
                                            invoicedetails.roomCode as roomtype_roomCode,
                                            roomtype.hotelId as roomtype_hotel_id,
                                            invoicedetails.isUseDeposit as invoice_isUseDeposit,
                                            invoicedetails.depositPercent as invoice_deposit
                                    FROM invoicedetails
                                    INNER JOIN roomtype ON roomtype.id = invoicedetails.roomTypeId WHERE invoicedetails.invoiceId =:id AND invoicedetails.status != 'DELETED'";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':id', $invoiceId);
                                $query->execute();
                                $results = $query->fetchAll();
                                $cnt = 1;

                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {

                                        $sqlInvoice = 'SELECT * FROM invoice WHERE id=:id';
                                        $queryInvoice = $dbh->prepare($sqlInvoice);
                                        $queryInvoice->bindParam(':id', $invoiceId);
                                        $queryInvoice->execute();
                                        ?>

                                        <tr align="center">
                                            <td>
                                                <?php echo $cnt ?>
                                            </td>
                                            <td>
                                                <a href="../products/details.php?id=<?php echo htmlentities($result['roomtype_hotel_id']); ?>"><?php echo htmlentities($result['roomtype_name']); ?></a>
                                            </td>
                                            <td>
                                                <?php echo htmlentities(number_format($result['roomtype_price'], 0, ',', '.')) . ' VND/ PHÒNG/ ĐÊM';?>
                                            </td>
                                            <td>
                                                <?php
                                                    $price = $result['invoiceDetail_price'];
                                                    echo htmlentities(number_format($price, 0, ',', '.')) . ' VND';
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo htmlentities($result['invoicedetail_quantity']); ?>
                                            </td>
                                            <td>
                                                <?php if ($result['invoice_isUseDeposit']) { echo '<b>'. htmlentities(number_format($result['invoice_deposit'], 0, ',', '.')) . ' %' .'</b>'; } else { echo "trả thẳng không cọc"; } ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger" onclick="SubmitCancelRoom(<?php echo $invoiceId; ?>, <?php echo $result['invoice_detail_id']; ?>)">Huỷ phòng</a>
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
<script>

    function SubmitCancelRoom(id, detailId) {
        event.preventDefault();
        Swal.fire({
            title: 'Bạn có muốn đổi hay muốn cập nhập hay không ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xác nhận',
            cancelButtonText: 'Huỷ'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "cancel-room.php",
                    method: "POST",
                    data: {
                        id: id,
                        detailId: detailId
                    },
                    success: function (response) {
                        if (response.key) {
                            $("#record-" + detailId).remove();

                            $("#table-id").load(location.href + " #table-id>*", "");
                            Swal.fire(response.message, "", "success");
                        } else {
                            Swal.fire(response.message, "", "error");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                        console.log(status);
                        console.log(error);
                        Swal.fire("Lỗi trong quá trình xử lý dữ liệu!", "", "error");
                    }
                });
            }
        })
    }

    async function SubmitIssue(id) {
        event.preventDefault();

        const { value: text } = await Swal.fire({
            input: 'textarea',
            inputLabel: 'Ghi chú yêu cầu',
            inputPlaceholder: '...',
            inputAttributes: {
                'aria-label': '...'
            },
            showCancelButton: true
        })

        if (text) {
            $.ajax({
                url: "update-note.php",
                method: "POST",
                data: {
                    id: id,
                    text: text
                },
                success: function (response) {
                    if (response.key) {
                        Swal.fire(response.message, "", "success");
                    } else {
                        Swal.fire(response.message, "", "error");
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    console.log(status);
                    console.log(error);
                    Swal.fire("Lỗi trong quá trình xử lý dữ liệu!", "", "error");
                }
            });
        }
    }
</script>
</body>

<?php include('structure/footer.php') ?>
</html>