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
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Ngày tạo</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Ngày tạo</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php $sql = "SELECT * from paymentmethod";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                        ?>
                                        <tr id="record-<?php echo $result->id ?>">
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo htmlentities($result->name); ?></td>
                                            <td><?php echo $result->createdAt; ?></td>


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
<?php include('structure/footer.php') ?>
</html>