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
                                    <th style="white-space: nowrap">Vấn đề</th>
                                    <th style="white-space: nowrap">Mô tả</th>
                                    <th style="white-space: nowrap">Ngày tạo</th>
                                    <th style="white-space: nowrap">Giải đáp</th>
                                    <th style="white-space: nowrap">Ngày trả lời</th>
                                    <th style="white-space: nowrap">Trạng thái</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sql = "SELECT * from issues";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                        ?>
                                        <tr id="record-<?php echo $result->id ?>">
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo htmlentities($result->Issue); ?></td>
                                            <td><?php echo htmlentities($result->description); ?></td>
                                            <td><?php echo $result->createdAt; ?></td>
                                            <td id="adminRemark-<?php echo $result->id ?>"><?php echo $result->adminRemark; ?></td>
                                            <td id="adminRemarkDate-<?php echo $result->id ?>"><?php echo $result->adminremarkDate; ?></td>
                                            <td>
                                                <?php if ($result->type === 'WAITING') { ?>
                                                    <tag style="color: chocolate">Đang chờ</tag>
                                                <?php } else if ($result->type === 'FINISHED') { ?>
                                                    <tag style="color: #0f9d58">Đã đáp ứng</tag>
                                                <?php } else if($result->type === 'CANCEL') { ?>
                                                    <tag style="color: red">Không thể đáp ứng</tag>
                                                <?php } else { ?>
                                                    <tag style="color: #0f9d58">Đã trả lời</tag>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a type="button" href="../invoices/details.php?bkid=<?php echo $result->invoiceId ?>" class="btn-primary btn">Chi tiết HĐ</a>
                                            </td>
                                            <td>
                                                <a type="button" class="btn-success btn" onclick="SubmitAdminRemark(<?php echo $result->id ?>)">Trả lời</a>
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
    async function SubmitAdminRemark(id) {
        const { value: result } = await Swal.fire({
            title: 'Trả lời',
            html:
                '<div>' +
                '<input type="radio" id="color-red" name="type" value="FINISHED">' +
                '<label for="color-red">Đã đáp ứng</label><br>' +
                '<input type="radio" id="color-green" name="type" value="CANCEL">' +
                '<label for="color-green">Không thể đáp ứng</label><br>' +
                '<input type="radio" id="color-blue" name="type" value="ANSWERED">' +
                '<label for="color-blue">Đã trả lời</label><br>' +
                '<div><textarea id="textarea-text" class="swal2-textarea" placeholder="Mô tả ..."></textarea></div>' +
                '</div>',
            inputValidator: (value) => {
                if (!value) {
                    return 'You need to choose something!';
                }
            },
            focusConfirm: false,
            preConfirm: () => {
                const selectedRadio = document.querySelector('input[name="type"]:checked');
                if (!selectedRadio) {
                    Swal.showValidationMessage('Bạn cần chọn điều kiện!');
                } else {
                    return {
                        textareaText: document.getElementById('textarea-text').value,
                        radioValue: selectedRadio.value
                    };
                }
            },
            showCancelButton: true
        });

        const currentDateTime = getCurrentDateTime();
        if (result) {
            const { textareaText, radioValue } = result;
            $.ajax({
                url: "remark.php",
                method: "POST",
                data: {
                    id: id,
                    textareaText: textareaText,
                    radioValue: radioValue
                },
                success: function (response) {
                    if (response.key) {
                        $("#adminRemark-" + id).text(textareaText);
                        $("#adminRemarkDate-" + id).text(currentDateTime);

                        swal(response.message, "", "success");
                    } else {
                        swal(response.message, "", "error");
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

    function getCurrentDateTime() {
        const now = new Date();

        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');

        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        const datetime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

        return datetime;
    }
</script>
<?php include('structure/footer.php') ?>
</html>