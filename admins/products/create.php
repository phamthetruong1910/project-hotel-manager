<?php
session_start();
error_reporting(0);
include('../config.php');

if ($_SESSION['alogin'] == null) {
    header('location:index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $nameHotel = $_POST['nameHotel'];
        $type = $_POST['type'];
        $location = $_POST['location'];
        $ranking = $_POST['ranking'];
        $description = $_POST['description'];
        $dateTimeNow = date("Y-m-d H:i:s");
        $statusHotels = "ENABLE";
        $isBreakfastService = $_POST['isBreakfastService'];
        $famousLocation = $_POST['famousLocation'];
        $district = $_POST['district'];

        $src = '';
        if ($_POST['embedLocation'] != null && preg_match('/<iframe.*?src=["\']([^"\']+)/i', $_POST['embedLocation'], $matches)) {
            $src = $matches[1];
        }
        $embedLocation = $src;
        $convenient = $_POST['convenient'];
        $convenientString = implode(" - ", $convenient);

        $images = array();
        foreach ($_FILES as $inputName => $fileInfo) {
            if (preg_match('/^packageimage-\d+$/', $inputName)) {
                $filename = $fileInfo['name'];
                $tempFile = $fileInfo['tmp_name'];
                $targetFile = '../images/products/' . $filename;

                if (move_uploaded_file($tempFile, $targetFile)) {
                    $images[] = array('name' => $filename);
                }
            }
        }

        $dbh->beginTransaction();

        $sql = "INSERT INTO hotels(name,type,location,ranking,description,createdAt,status,createdBy,embedLocation,convenient,isBreakfastService,famousLocation,district) 
            VALUES(:name,:type,:location,:ranking,:description,:createdAt,:status,:createdBy,:embedLocation,:convenient,:isBreakfastService,:famousLocation,:district)";
        $query = $dbh->prepare($sql);

        $query->bindParam(':name', $nameHotel, PDO::PARAM_STR);
        $query->bindParam(':type', $type, PDO::PARAM_STR);
        $query->bindParam(':location', $location, PDO::PARAM_STR);
        $query->bindParam(':ranking', $ranking, PDO::PARAM_INT);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':createdAt', $dateTimeNow, PDO::PARAM_STR);
        $query->bindParam(':status', $statusHotels, PDO::PARAM_STR);
        $query->bindParam(':createdBy', $_SESSION['alogin'], PDO::PARAM_STR);
        $query->bindParam(':embedLocation', $embedLocation, PDO::PARAM_STR);
        $query->bindParam(':convenient', $convenientString, PDO::PARAM_STR);
        $query->bindParam(':isBreakfastService', $isBreakfastService, PDO::PARAM_STR);
        $query->bindParam(':famousLocation', $famousLocation, PDO::PARAM_STR);
        $query->bindParam(':district', $district, PDO::PARAM_STR);

        $roomType = array();
        $roomTypeInput = $_POST;
        $fieldsToRemove = array(
            'nameHotel',
            'type',
            'location',
            'ranking',
            'description',
            'submit',
            'embedLocation',
            'convenient',
            'isBreakfastService',
            'famousLocation',
            'name',
            'code',
            'singleBed',
            'totalNumber',
            'numberCustomer',
            'price',
            'depositPercent',
            'district'
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

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();

        $sqlRoomType = "INSERT INTO roomType(name,hotelId,code,doubleBed,singleBed,totalNumber,price,numberCustomer,depositPercent,isUseDeposit,acreage,status) 
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $sqlRoomTypeConvenient = "INSERT INTO roomtypeconvenient(convenientId,roomTypeId) VALUES(?, ?)";

        foreach ($roomType as $keyRoomType => $values) {
            $values['hotelId'] = $lastInsertId;

            $stmt = $dbh->prepare($sqlRoomType);

            $stmt->execute([
                $values['name'],
                $values['hotelId'],
                $values['code'],
                $values['doubleBed'],
                $values['singleBed'],
                $values['totalNumber'],
                $values['price'],
                $values['numberCustomer'],
                $values['depositPercent'],
                $values['isUseDeposit'],
                $values['acreage'],
                'ENABLE'
            ]);

            $lastInsertIdRoomType = $dbh->lastInsertId();

            if ($queryCon->rowCount() > 0) {
                foreach ($cons as $key => $value) {
                    if ($values['convenient' . ($key + 1)] !== NULL) {
                        $rtc = $dbh->prepare($sqlRoomTypeConvenient);

                        $rtc->execute([$values['convenient' . ($key + 1)], $lastInsertIdRoomType]);
                    }
                }
            }

            $sqlImages = "INSERT INTO images(name,objectId,code) VALUES(?, ?, ?)";

            $targetDir = '../images/products/';
            $count = count($_FILES['images-' . $keyRoomType]["name"]);
            $imagesRoomType = array();

            for ($i = 0; $i < $count; $i++) {
                $filename = basename($_FILES['images-' . $keyRoomType]["name"][$i]);

                $targetFile = $targetDir . basename($_FILES['images-' . $keyRoomType]["name"][$i]);
                if (move_uploaded_file($_FILES['images-' . $keyRoomType]["tmp_name"][$i], $targetFile)) {
                    $imagesRoomType[] = array('name' => $filename);
                }
            }

            foreach ($imagesRoomType as $values) {
                $values['objectId'] = $lastInsertIdRoomType;
                $values['code'] = 'ROOMTYPE';

                $stImages = $dbh->prepare($sqlImages);

                $stImages->execute([
                    $values['name'],
                    $values['objectId'],
                    $values['code'],
                ]);
            }
        }


        foreach ($images as $values) {
            $values['objectId'] = $lastInsertId;
            $values['code'] = 'HOTEL';

            $stImages = $dbh->prepare($sqlImages);

            $stImages->execute([
                $values['name'],
                $values['objectId'],
                $values['code'],
            ]);
        }

        $dbh->commit();

        if ($lastInsertId) {
            header('location:index.php');
        }
    } catch (Exception $e) {
        print_r($e->getMessage());
        die();
//            $error = "Có lỗi trong quá trình xử lý dữ liệu";
    }
}


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
                        <h2>TẠO KHÁCH SẠN, RESORT</h2>
                    </div>
                    <div class="body">
                        <form id="form_validation" method="POST"  enctype="multipart/form-data">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="nameHotel" required>
                                        <label class="form-label">Tên <b style="color: red">*</b></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select name="type" class="form-control show-tick" required>
                                            <option value="Khách sạn">Khách sạn</option>
                                            <option value="Resort">Resort</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="location">
                                        <label class="form-label">Địa Chỉ <b style="color: red">*</b></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select name="district" class="form-control show-tick" required>
                                            <option value="Quận Hải Châu">Quận Hải Châu</option>
                                            <option value="Quận Thanh Khê">Quận Thanh Khê</option>
                                            <option value="Quận Sơn Trà">Quận Sơn Trà</option>
                                            <option value="Quận Ngũ Hành Sơn">Quận Ngũ Hành Sơn</option>
                                            <option value="Quận Liên Chiểu">Quận Liên Chiểu</option>
                                            <option value="Quận Cẩm Lệ">Quận Cẩm Lệ</option>
                                            <option value="Huyện Hòa Vang">Huyện Hòa Vang</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select name="ranking" class="form-control show-tick" required>
                                            <option value="1">1 sao</option>
                                            <option value="2">2 sao</option>
                                            <option value="3">3 sao</option>
                                            <option value="4">4 sao</option>
                                            <option value="5">5 sao</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="description" id="description" cols="30" rows="5" class="form-control no-resize"></textarea>
                                        <label class="form-label">Mô tả</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="embedLocation">
                                        <label class="form-label">Embed Location (link google map) <b style="color: red">*</b></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
<!--                                        <input type="text" class="form-control" name="convenient" value="Máy lạnh - Nhà hàng -Hồ bơi - Lễ tân 24h - Chỗ đậu xe - Thang máy - Wifi">-->
<!--                                        <label class="form-label">Tiện nghi</label>-->
                                        <h2 class="card-inside-title">Tiện nghi</h2>
                                        <div class="demo-checkbox">
                                            <input type="checkbox" id="md_checkbox_21"  name="convenient[]" class="filled-in chk-col-red" checked value="Máy lạnh" />
                                            <label for="md_checkbox_21">Máy lạnh</label>
                                            <input type="checkbox" id="md_checkbox_22"  name="convenient[]" class="filled-in chk-col-pink" checked value="Nhà hàng"/>
                                            <label for="md_checkbox_22">Nhà hàng</label>
                                            <input type="checkbox" id="md_checkbox_23"  name="convenient[]" class="filled-in chk-col-purple" checked value="Hồ bơi"/>
                                            <label for="md_checkbox_23">Hồ bơi</label>
                                            <input type="checkbox" id="md_checkbox_24"  name="convenient[]" class="filled-in chk-col-deep-purple" checked value="Lễ tân 24h"/>
                                            <label for="md_checkbox_24">Lễ tân 24h</label>
                                            <input type="checkbox" id="md_checkbox_25" name="convenient[]" class="filled-in chk-col-indigo" checked value="Chỗ đậu xe"/>
                                            <label for="md_checkbox_25">Chỗ đậu xe</label>
                                            <input type="checkbox" id="md_checkbox_26" name="convenient[]" class="filled-in chk-col-blue" checked  value="Thang máy"/>
                                            <label for="md_checkbox_26">Thang máy</label>
                                            <input type="checkbox" id="md_checkbox_27" name="convenient[]" class="filled-in chk-col-light-blue" checked value="Wifi"/>
                                            <label for="md_checkbox_27">Wifi</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="famousLocation">
                                        <label class="form-label">Các địa điểm nỗi tiếng xung quanh <b
                                                    style="color: red">*</b></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="">
                                        <div class="switch">
                                            <label>Có phục vụ buổi sáng<input type="checkbox" name="isBreakfastService" value="1" checked><span
                                                        class="lever switch-col-red"></span></label>
                                        </div>
                                    </div>
                                </div>

                            <h2 class="card-inside-title">Tạo Loại phòng <b
                                        style="color: red">*</b></h2>

                                <div class="form-group">
                                    <div class="row clearfix">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="name-0" id="ajax" list="json-datalist" type="text" placeholder="Tên loại phòng" required>
                                                    <datalist id="json-datalist"></datalist>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="code-0" placeholder="Mã phòng (vd: VIP)"
                                                           type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="doubleBed-0" placeholder="Giường đôi"
                                                           type="number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="singleBed-0" type="number" placeholder="Giường đơn">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="acreage-0" type="number" placeholder="Diện tích (m2)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="totalNumber-0" placeholder="Tổng số phòng" value="10"
                                                           type="number" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="price-0" placeholder="Giá phòng"
                                                           type="number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="numberCustomer-0" placeholder="Số khách"
                                                           type="number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="depositPercent-0" placeholder="Phần trăm đặt phòng"
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
                                                    if ($queryCon->rowCount() > 0) {
                                                        foreach ($cons as $value) {
                                                            ?>
                                                            <input type="checkbox" id="md_checkbox_<?php echo $value->id ?>" name="convenient<?php echo $value->id ?>-0"
                                                                   class="filled-in chk-col-green" value="<?php echo $value->id ?>" checked/>
                                                            <label for="md_checkbox_<?php echo $value->id ?>"><?php echo $value->name ?></label>
                                                        <?php } } ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="image">Thêm ảnh phòng:</label>
                                                <input type="file" name="images-0[]" multiple>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="switch">
                                                    <label>Sử dụng đặt cọc<b style="color: red">*</b><input type="checkbox" name="isUseDeposit-0" value="1" checked><span
                                                                class="lever switch-col-red"></span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="">
                                                    <button type="button" class="btn btn-default addButton"><b
                                                                style="color: red">+</b></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group hide" id="bookTemplate">
                                    <div class="row clearfix">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="name" id="ajax" placeholder="Tên loại phòng"
                                                           list="json-datalist" type="text">
                                                    <datalist id="json-datalist"></datalist>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="code" type="text" placeholder="Mã phòng (vd: VIP)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="doubleBed" type="number" placeholder="Giường đôi">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="singleBed" type="number" placeholder="Giường đơn">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="acreage"
                                                           placeholder="Diện tích" type="number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="totalNumber" placeholder="Tổng số phòng "
                                                           type="number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="price" type="number" placeholder="Giá phòng">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="numberCustomer" placeholder="Số khách"
                                                           type="number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" name="depositPercent" placeholder="Phần trăm đặt phòng"
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
                                                    if ($queryCon->rowCount() > 0) {
                                                        foreach ($cons as $value) {
                                                            ?>
                                                            <input type="checkbox" id="md_checkbox_21" name="convenient<?php echo $value->id ?>"
                                                                   class="filled-in chk-col-green" value="<?php echo $value->id ?>" checked/>
                                                            <label for="md_checkbox_21"><?php echo $value->name ?></label>
                                                        <?php } } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="image">Thêm ảnh phòng:</label>
                                                <input type="file" name="images[]" multiple>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="switch">
                                                    <label>Sử dụng đặt cọc<b style="color: red">*</b><input type="checkbox" name="isUseDeposit" value="1" checked><span
                                                                class="lever switch-col-red"></span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="">
                                                    <button type="button" class="btn btn-default removeButton">x
                                                    </button>
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
                                                    <input type="file" name="packageimage-0" id="packageimage1">
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
                                                    <input type="file" name="packageimage" id="packageimage1">
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
                                <button class="btn btn-primary waves-effect float-right" id="btn-submit" type="submit">Tạo</button>
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
        .on('click', '.addButton', function () {
            counter++;
            var $template = $('#bookTemplate'),
                $clone = $template
                    .clone()
                    .removeClass('hide')
                    .removeAttr('id')
                    .attr('data-book-index', counter)
                    .insertBefore($template);

            // Update the name attributes
            $clone
                .find('[name="name"]').attr('name', 'name-' + counter).end()
                .find('[name="code"]').attr('name', 'code-' + counter).end()
                .find('[name="doubleBed"]').attr('name', 'doubleBed-' + counter).end()
                .find('[name="singleBed"]').attr('name', 'singleBed-' + counter).end()
                .find('[name="totalNumber"]').attr('name', 'totalNumber-' + counter).end()
                .find('[name="price"]').attr('name', 'price-' + counter).end()
                .find('[name="convenient"]').attr('name', 'convenient-' + counter).end()
                .find('[name="numberCustomer"]').attr('name', 'numberCustomer-' + counter).end()
                .find('[name="depositPercent"]').attr('name', 'depositPercent-' + counter).end()
                .find('[name="isUseDeposit"]').attr('name', 'isUseDeposit-' + counter).end()
                .find('[name="acreage"]').attr('name', 'acreage-' + counter).end()
                .find('[name="images[]"]').attr('name', 'images-' + counter + '[]').end()

            const name = document.getElementById('name'+ counter);
            const code = document.getElementById('code'+ counter);
            const doubleBed = document.getElementById('doubleBed'+ counter);
            const singleBed = document.getElementById('singleBed'+ counter);
            const totalNumber = document.getElementById('totalNumber'+ counter);
            const price = document.getElementById('price'+ counter);
            const convenient = document.getElementById('convenient'+ counter);
            const numberCustomer = document.getElementById('numberCustomer'+ counter);
            const depositPercent = document.getElementById('depositPercent'+ counter);
            const isUseDeposit = document.getElementById('isUseDeposit'+ counter);
            const acreage = document.getElementById('acreage'+ counter);

            name.setAttribute('required', '')
            code.setAttribute('required', '')
            doubleBed.setAttribute('required', '')
            singleBed.setAttribute('required', '')
            totalNumber.setAttribute('required', '')
            price.setAttribute('required', '')
            convenient.setAttribute('required', '')
            numberCustomer.setAttribute('required', '')
            depositPercent.setAttribute('required', '')
            isUseDeposit.setAttribute('required', '')
            acreage.setAttribute('required', '')

            var $convenientInputs = $clone.find('input[name^="convenient"]');

            $convenientInputs.each(function (index) {
                var nameAttr = $(this).attr('name');
                $(this).attr('name', nameAttr + '-' + counter);
            });

            var $imageInputs = $clone.find('input[name^="image"]');

            var imageCount = 0;
            $.each($imageInputs[0].files, function (index, file) {
                var imageName = 'image-' + counter + '-' + (++imageCount);
                var $newImageInput = $('<input>', {type: 'hidden', name: imageName});
                $clone.append($newImageInput);

                var formData = new FormData();
                formData.append(imageName, file);
            });

        })

        // Remove button click handler
        .on('click', '.removeButton', function () {
            var $row = $(this).parents('.form-group'),
                index = $row.attr('data-book-index');

            // const name = document.getElementById('name'+ index);
            // const code = document.getElementById('code'+ index);
            // const doubleBed = document.getElementById('doubleBed'+ index);
            // const singleBed = document.getElementById('singleBed'+ index);
            // const totalNumber = document.getElementById('totalNumber'+ index);
            // const price = document.getElementById('price'+ index);
            // const convenient = document.getElementById('convenient'+ index);
            // const numberCustomer = document.getElementById('numberCustomer'+ index);
            // const depositPercent = document.getElementById('depositPercent'+ index);
            // const isUseDeposit = document.getElementById('isUseDeposit'+ index);
            // const acreage = document.getElementById('acreage'+ index);
            //
            // name.removeAttribute('required')
            // code.removeAttribute('required')
            // doubleBed.removeAttribute('required')
            // singleBed.removeAttribute('required')
            // totalNumber.removeAttribute('required')
            // price.removeAttribute('required')
            // convenient.removeAttribute('required')
            // numberCustomer.removeAttribute('required')
            // depositPercent.removeAttribute('required')
            // isUseDeposit.removeAttribute('required')
            // acreage.removeAttribute('required')
            $row.remove();
            var $rowImage = $('[data-book-index-image-room=' + index + ']');

            $rowImage.remove();
        });


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
                .find('[name="packageimage"]').attr('name', 'packageimage-' + counter).end()
        })
        // Remove button click handler
        .on('click', '.removeButtonImage', function () {
            var $row = $(this).parents('.form-group'),
                index = $row.attr('data-book-index-image');

            // Remove element containing the fields
            $row.remove();
        });

    // $('#btn-submit').on('click',function(e){
    //     e.preventDefault();
    //     var form = $(this).parents('form');
    //     Swal.fire({
    //         title: 'Bạn có chắc muốn tạo?',
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Xác nhận',
    //         cancelButtonText: 'Huỷ'
    //     }.then((result) => {
    //         if (result.isConfirmed) {
    //             alert(1);
    //             form.submit();
    //         };
    //     });
    // });


    function toggleCheckboxes(checkbox) {
        var checkboxes = document.querySelectorAll('.chk-col-green');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] !== checkbox) {
                checkboxes[i].checked = !checkbox.checked;
            }
        }
    }
</script>

<?php include('structure/footer.php') ?>
</html>