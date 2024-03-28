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
            $nameHotel = $_POST['nameHotel'];
            $type = $_POST['type'];
            $location = $_POST['location'];
            $ranking = $_POST['ranking'];
            $description = $_POST['description'];
            $dateTimeNow = date("Y-m-d H:i:s");
            $statusHotels = "ENABLE";
            $isBreakfastService = $_POST['isBreakfastService'];
            $famousLocation = $_POST['famousLocation'];
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

            $sql = "UPDATE hotels SET name=:name,type=:type,location=:location,ranking=:ranking,description=:description,updatedAt=:updatedAt,status=:status,updatedBy=:updatedBy,embedLocation=:embedLocation,convenient=:convenient,isBreakfastService=:isBreakfastService,famousLocation=:famousLocation WHERE id=:id";
            $query = $dbh->prepare($sql);

            $query->bindParam(':name', $nameHotel, PDO::PARAM_STR);
            $query->bindParam(':type', $type, PDO::PARAM_STR);
            $query->bindParam(':location', $location, PDO::PARAM_STR);
            $query->bindParam(':ranking', $ranking, PDO::PARAM_INT);
            $query->bindParam(':description', $description, PDO::PARAM_STR);
            $query->bindParam(':updatedAt', $dateTimeNow, PDO::PARAM_STR);
            $query->bindParam(':status', $statusHotels, PDO::PARAM_STR);
            $query->bindParam(':updatedBy', $_SESSION['alogin'], PDO::PARAM_STR);
            $query->bindParam(':embedLocation', $embedLocation, PDO::PARAM_STR);
            $query->bindParam(':convenient', $convenientString, PDO::PARAM_STR);
            $query->bindParam(':isBreakfastService', $isBreakfastService, PDO::PARAM_STR);
            $query->bindParam(':famousLocation', $famousLocation, PDO::PARAM_STR);
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();

            $sqlImages = "INSERT INTO images(name,objectId,code) VALUES(?, ?, ?)";

            foreach ($images as $values) {
                $values['objectId'] = $id;
                $values['code'] = 'HOTEL';

                $stImages = $dbh->prepare($sqlImages);

                $stImages->execute([
                    $values['name'],
                    $values['objectId'],
                    $values['code'],
                ]);
            }

            $dbh->commit();

        } catch (Exception $e) {
            print_r($e->getMessage());die();
        }
    }
}

if (empty($_GET['id'])) {
    header('Location: index.php');
}
    $id = $_GET['id'];
    $sql = "SELECT * from hotels where status != 'DELETED' AND id=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id);
    $query->execute();
    $hotel = $query->fetch(PDO::FETCH_OBJ);

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
                        <h2>CẬP NHẬT KHÁCH SẠN, RESORT</h2>
                    </div>
                    <div class="body">
                        <form id="form_validation" method="POST"  enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nameHotel" value="<?php echo $hotel->name ?>" required>
                                    <label class="form-label">Tên<b style="color: red">*</b></label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="type" id="password" value="<?php echo $hotel->type ?>" required>
                                    <label class="form-label">Loại Khách sạn, Nhà (vd: nhà trọ, resort, khách sạn)<b
                                                style="color: red">*</b></label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="location" value="<?php echo $hotel->location ?>">
                                    <label class="form-label">Địa Chỉ*</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" class="form-control" name="ranking" max="5" min="1" value="<?php echo $hotel->ranking ?>"
                                           required>
                                    <label class="form-label">Xếp hạng sao <b style="color: red">*</b></label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="description" value="<?php echo $hotel->description ?>" required>
                                    <label class="form-label">Chi tiết</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="embedLocation" value="<?php echo '<iframe style=\'width: 100%; height: 400px\' src=\'' . $hotel->embedLocation . '\' width=\'600\' height=\'450\' style=\'border:0;\' allowfullscreen=\'\' loading=\'lazy\' referrerpolicy=\'no-referrer-when-downgrade\'></iframe>'; ?>">
                                    <label class="form-label">Embed Location (link google map)</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                        <?php $convenientArray = explode(" - ", $hotel->convenient); ?>
                                    <h2 class="card-inside-title">Tiện nghi</h2>
                                    <div class="demo-checkbox">
                                        <input type="checkbox" id="md_checkbox_21" name="convenient[]" class="filled-in chk-col-red" <?php if(in_array("Máy lạnh", $convenientArray, true)) { echo 'checked'; } ?> value="Máy lạnh" />
                                        <label for="md_checkbox_21">Máy lạnh</label>
                                        <input type="checkbox" id="md_checkbox_22"  name="convenient[]" class="filled-in chk-col-pink" <?php if(in_array("Nhà hàng", $convenientArray, true)) { echo 'checked'; } ?> value="Nhà hàng"/>
                                        <label for="md_checkbox_22">Nhà hàng</label>
                                        <input type="checkbox" id="md_checkbox_23"  name="convenient[]" class="filled-in chk-col-purple" <?php if(in_array("Hồ bơi", $convenientArray, true)) { echo 'checked'; } ?> value="Hồ bơi"/>
                                        <label for="md_checkbox_23">Hồ bơi</label>
                                        <input type="checkbox" id="md_checkbox_24"  name="convenient[]" class="filled-in chk-col-deep-purple" <?php if(in_array("Lễ tân 24h", $convenientArray, true)) { echo 'checked'; } ?> value="Lễ tân 24h"/>
                                        <label for="md_checkbox_24">Lễ tân 24h</label>
                                        <input type="checkbox" id="md_checkbox_25" name="convenient[]" class="filled-in chk-col-indigo" <?php if(in_array("Chỗ đậu xe", $convenientArray, true)) { echo 'checked'; } ?> value="Chỗ đậu xe"/>
                                        <label for="md_checkbox_25">Chỗ đậu xe</label>
                                        <input type="checkbox" id="md_checkbox_26" name="convenient[]" class="filled-in chk-col-blue" <?php if(in_array("Thang máy", $convenientArray, true)) { echo 'checked'; } ?>  value="Thang máy"/>
                                        <label for="md_checkbox_26">Thang máy</label>
                                        <input type="checkbox" id="md_checkbox_27" name="convenient[]" class="filled-in chk-col-light-blue" <?php if(in_array("Wifi", $convenientArray, true)) { echo 'checked'; } ?> value="Wifi"/>
                                        <label for="md_checkbox_27">Wifi</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="famousLocation"  value="<?php echo $hotel->famousLocation ?>">
                                    <label class="form-label">Các địa điểm nỗi tiếng xung quanh<b
                                                style="color: red">*</b></label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="">
                                    <div class="switch">
                                        <label>Có phục vụ buổi sáng<b style="color: red">*</b><input type="checkbox" name="isBreakfastService" value="<?php echo $hotel->isBreakfastService ?>" checked><span
                                                    class="lever switch-col-red"></span></label>
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
                            <button class="btn btn-primary waves-effect float-right" type="submit">Cập nhật</button>
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
                .find('[name="packageimage"]').attr('name', 'packageimage-' + counter).end()
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