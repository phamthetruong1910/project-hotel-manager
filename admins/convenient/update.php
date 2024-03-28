<?php
session_start();
include('../config.php');
if (empty($_SESSION['alogin'])) {
    header('location:../index.php');
} else {
    if ($_GET['pid']) {
        $id = $_GET['pid'];
        $sql = "SELECT * from convenient where status != 'DELETED' AND convenient.name= :name AND id != :id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $_POST['name']);
        $query->bindParam('id', $id);
        $query->execute();
        $dateTimeNow = date("Y-m-d H:i:s");

        if ($query->rowCount() === 0) {
            try {
                $sqlConvenient = "UPDATE convenient SET name =:name,updatedAt =:updatedAt WHERE id=:id";
                $queryConvenient = $dbh->prepare($sqlConvenient);
                $queryConvenient->bindParam(':id', $id);
                $queryConvenient->bindParam(':updatedAt', $dateTimeNow);

                $queryConvenient->execute();

                header('location:index.php');

            } catch (Exception $exception) {
                echo $exception;
            }
        }
    } else {
        header('location:index.php');
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

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            TIỆN NGHI
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
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
                        <form method="post">
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <?php ?>
                                            <input type="text" name="name" class="form-control" placeholder="tên" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">Tạo mới
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Inline Layout -->

    </div>
</section>

</body>

<?php include('structure/footer.php') ?>
</html>
