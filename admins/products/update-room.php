<?php
session_start();
error_reporting(0);
include('../config.php');

if ($_SESSION['alogin'] == null) {
    header('location:../index.php');
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $id = $_GET['id'];
            $name = $_POST['name'];
            $code = $_POST['code'];
            $doubleBed = $_POST['doubleBed'];
            $singleBed = $_POST['singleBed'];
            $acreage = $_POST['acreage'];
            $totalNumber = $_POST['totalNumber'];
            $price = $_POST['price'];
            $numberCustomer = $_POST['numberCustomer'];
            $depositPercent = $_POST['depositPercent'];
            $isUseDeposit = $_POST['isUseDeposit'] ? 1 : 0;
            $price = $_POST['price'];
            $code = $_POST['code'];

            $sql = "UPDATE roomtype SET name=:name,doubleBed=:doubleBed,singleBed=:singleBed,acreage=:acreage,totalNumber=:totalNumber,price=:price,numberCustomer=:numberCustomer,depositPercent=:depositPercent,isUseDeposit=:isUseDeposit,code=:code WHERE id=:id AND status != 'DELETED'";
            $query = $dbh->prepare($sql);
            $query->bindParam(':id', $id);
            $query->bindParam(':name', $name);
            $query->bindParam(':doubleBed', $doubleBed);
            $query->bindParam(':singleBed', $singleBed);
            $query->bindParam(':acreage', $acreage);
            $query->bindParam(':totalNumber', $totalNumber);
            $query->bindParam(':price', $price);
            $query->bindParam(':numberCustomer', $numberCustomer);
            $query->bindParam(':depositPercent', $depositPercent);
            $query->bindParam(':isUseDeposit', $isUseDeposit);
            $query->bindParam(':code', $code);

            $query->execute();

            $roomType = array();
            $roomTypeInput = $_POST;
            $fieldsToRemove = array(
                'name',
                'hotelId',
                'doubleBed',
                'singleBed',
                'acreage',
                'totalNumber',
                'price',
                'numberCustomer',
                'depositPercent',
                'isUseDeposit',
                'status',
                'code',
            );

            foreach ($fieldsToRemove as $field) {
                unset($roomTypeInput[$field]);
            }

            $sqlCon = "SELECT * from convenient WHERE status != 'DELETED'";
            $queryCon = $dbh->prepare($sqlCon);
            $queryCon->execute();
            $cons = $queryCon->fetchAll(PDO::FETCH_OBJ);

            if ($queryCon->rowCount() > 0) {
                foreach ($cons as $key => $value) {
                    unset($roomTypeInput['convenient' . ($key + 1)]);
                }
            }

            foreach ($roomTypeInput as $key => $value) {
                $index = substr($key, strpos($key, "-") + 1);

                if (strpos($key, "-") != 0) {
                    if (!isset($roomType[$index])) {
                        $roomType[$index] = array();
                    }

                    $roomType[$index][preg_replace('/-\d+$/', '', $key)] = $value;
                }
            }
            $roomType = array_values($roomType);

            $sqlRoomTypeConvenient = "INSERT INTO roomtypeconvenient(convenientId,roomTypeId) VALUES(?, ?)";

            if (count($roomType) > 0) {
                $sqlDeleteConvenient = "DELETE FROM roomtypeconvenient WHERE roomTypeId=:roomTypeId";
                $queryDelete = $dbh->prepare($sqlDeleteConvenient);
                $queryDelete->bindParam(':roomTypeId', $id);
                $queryDelete->execute();
            }
            foreach ($roomType as $keyRoomType => $values) {
                if (($queryCon->rowCount() > 0) && $values['convenient'] !== NULL) {
                    $rtc = $dbh->prepare($sqlRoomTypeConvenient);
                    $rtc->execute([$values['convenient'], $id]);
                }
            }

            header('Location: update-room.php?id='. $id);
        } catch (Exception $e) {
            print_r($e->getMessage());die();
        }
    }
}

if (empty($_GET['id'])) {
    header('Location: index.php');
}
$id = $_GET['id'];
$sql = "SELECT * from roomtype WHERE id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id', $id);
$query->execute();
$roomType = $query->fetch(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html>
<?php
include('structure/header.php');
include('../structure/menu.php');

?>

<body class="theme-red">
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
            </h2>
        </div>
        <!-- Advanced Form Example With Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>CẬP NHÂT LOẠI PHÒNG  <?php echo strtoupper($roomType->name) ?></h2>
                    </div>
                    <div class="body">
                        <form id="form_validation" method="POST"  enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row clearfix">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control" name="name" id="ajax" value="<?php echo $roomType->name ?>"
                                                       list="json-datalist"
                                                       placeholder="tên loại phòng" type="text" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control" name="code" value="<?php echo $roomType->code ?>"
                                                       placeholder="Mã phòng (vd: VIP)"
                                                       type="text" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control" name="doubleBed" value="<?php echo $roomType->doubleBed ?>"
                                                       placeholder="Giường đôi"
                                                       type="number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control" name="singleBed" value="<?php echo $roomType->singleBed ?>"
                                                       placeholder="Giường đơn" type="number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control" name="acreage" value="<?php echo $roomType->acreage ?>"
                                                       placeholder="Diện tích" type="number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control" name="totalNumber" value="<?php echo $roomType->totalNumber ?>"
                                                       placeholder="Tổng số phòng"
                                                       type="number" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control" name="price" placeholder="giá phòng" value="<?php echo $roomType->price ?>"
                                                       type="number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control" name="numberCustomer" value="<?php echo $roomType->numberCustomer ?>"
                                                       placeholder="Số khách"
                                                       type="number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input class="form-control" name="depositPercent" value="<?php echo $roomType->depositPercent ?>"
                                                       placeholder="Phần trăm đặt phòng"
                                                       type="number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="demo-checkbox">
                                                <?php
                                                $sqlCon = "SELECT * from convenient WHERE status != 'DELETED'";
                                                $queryCon = $dbh->prepare($sqlCon);
                                                $queryCon->execute();
                                                $cons = $queryCon->fetchAll(PDO::FETCH_OBJ);

                                                $sqlroomtypeconvenient = "SELECT convenientId from roomtypeconvenient WHERE roomTypeId=:id";
                                                $queryroomtypeconvenient = $dbh->prepare($sqlroomtypeconvenient);
                                                $queryroomtypeconvenient->bindParam(':id', $roomType->id);
                                                $queryroomtypeconvenient->execute();
                                                $roomTypeConvenient = $queryroomtypeconvenient->fetchAll();
                                                $convenientIds = array_column($roomTypeConvenient, 'convenientId');

                                                if ($queryCon->rowCount() > 0) {
                                                    foreach ($cons as $value) {
                                                        ?>
                                                        <input type="checkbox" id="md_checkbox_<?php echo $value->id ?>" name="convenient-<?php echo $value->id ?>"
                                                               class="filled-in chk-col-green" value="<?php echo $value->id ?>" <?php if(in_array($value->id, $convenientIds)) {  ?>checked <?php } ?>/>
                                                        <label for="md_checkbox_<?php echo $value->id ?>"><?php echo $value->name ?></label>
                                                    <?php } } ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="switch">
                                                <label>Sử dụng đặt cọc<b style="color: red">*</b><input type="checkbox" name="isUseDeposit" value="1" <?php if ($roomType->isUseDeposit) { echo 'checked'; }  ?>><span
                                                        class="lever switch-col-red"></span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h2 class="card-inside-title">Thêm ảnh phòng</h2>

                            <div class="form-group">
                                <div class="row clearfix">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" name="images-0" id="packageimage1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-default addButtonImage"><b
                                                    style="color: red">+</b></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group hide" id="bookTemplateImage">
                                <div class="row clearfix">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" name="images" id="packageimage1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-default removeButtonImage"><b
                                                    style="color: red">x</b></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect float-right" type="submit">Cập Nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Advanced Form Example With Validation -->
    </div>
</section>

<script src="../../admin/js/jquery.nicescroll.js"></script>
<script src="../../admin/js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../../admin/js/bootstrap.min.js"></script>
</body>
<script>
    var counter = 0;
    var dataList = document.getElementById('json-datalist');


    $('#form_validation')
        // Add button click handler
        .on('click', '.addButtonImage', function () {
            counter++;
            var $template = $('#bookTemplateImage'),
                $clone = $template
                    .clone()
                    .removeClass('hide')
                    .removeAttr('id')
                    .attr('data-book-index-image', counter)
                    .insertBefore($template);

            // Update the name attributes
            $clone
                .find('[name="images"]').attr('name', 'images-' + counter).end()
        })
        // Remove button click handler
        .on('click', '.removeButtonImage', function () {
            var $row = $(this).parents('.form-group'),
                index = $row.attr('data-book-index-image');

            // Remove element containing the fields
            $row.remove();
        });

</script>

<?php include('structure/footer.php') ?>
</html>