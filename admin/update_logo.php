<?php 
    include 'inc/header.php';
    include '../classes/General.php'; 
?>
<?php
    if (!isset($_GET['id']) || $_GET['id'] == NULL) {
        echo "<script>window.location = 'index.php'; </script>";
    } else {
        $id = preg_replace('[^A-Za-z0-9_]', '', $_GET['id']);

    }
    $logo = new General();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $updateLogo = $logo->logoUpdate($_POST, $_FILES, $id);
    }
?>

                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>UPDATE SITE LOGO
                                        <div class="page-title-subheading">Welcome Back! <strong> admin </strong> Here you can add new product. Product you added here will dynamically display on the main page where ever you want. Isnt fun?
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div> 
                                        <div class="main-card mb-3 card">
                                            <div class="card-body">
                                                <?php 
                                                    if (isset($updateLogo)) {
                                                        echo $updateLogo;
                                                    }
                                                ?>
                                                <?php 
                                                    $getLogo = $logo->getLogoById($id);
                                                    if ($getLogo) {
                                                        while ($result = $getLogo->fetch_assoc()) {
                                                ?>
                                                <form action="" class="" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="logoTitle" class="">Title</label>
                                                        <input name="logoTitle" value="<?= $result['logo_title']; ?>" type="text" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="logoImage" class="">Upload Logo</label> <br>
                                                        <img src="<?= $result['logo_image']; ?>" alt="" width="80px">
                                                        <input value="<?= $result['logo_image']; ?>" name="logoImage" id="logoImage" type="file" class="form-control-file">
                                                    </div>
                                                        
                                                    </div>
                                                    <button name="submit" type="submit" class="mt-1 btn btn-primary">Update Logo</button>
                                                </form>
                                                <?php } } ?>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>