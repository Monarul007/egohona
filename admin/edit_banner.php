<?php 
    include 'inc/header.php';
    include '../classes/Banner.php'; 
?>
<?php
    if (!isset($_GET['id']) || $_GET['id'] == NULL) {
        echo "<script>window.location = 'view_banners.php'; </script>";
    } else {
        $id = preg_replace('[^A-Za-z0-9_]', '', $_GET['id']);

    }
    $banner = new Banner();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $updateBanner = $banner->bannerUpdate($_POST, $_FILES, $id);
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
                                    <div>ADD NEW BANNER
                                        <div class="page-title-subheading">Welcome Back! <strong> admin </strong> Here you can add new product. Product you added here will dynamically display on the main page where ever you want. Isnt fun?
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div> 
                                        <div class="main-card mb-3 card">
                                            <div class="card-body">
                                                <?php 
                                                    if (isset($updateBanner)) {
                                                        echo $updateBanner;
                                                    }
                                                ?>
                                                <?php 
                                                    $getBanner = $banner->getBannerById($id);
                                                    if ($getBanner) {
                                                        while ($result = $getBanner->fetch_assoc()) {
                                                ?>
                                                <form action="" class="" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="bannerText" class="">Banner Text</label>
                                                        <input name="bannerText" value="<?= $result['banner_title']; ?>" type="text" class="form-control">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="bannerType" class="">Banner Type</label>
                                                        <select type="select" id="bannerType" name="bannerType" class="custom-select">
                                                            <option>Select Banner Type</option>
                                                                <?php 
                                                                if ($result['banner_type'] == 1) { ?>
                                                                    <option selected="selected" value="1">Hero Right Banner</option>
                                                                    <option value="2">Home Popup Banner</option>
                                                                    <option value="3">Promotion Banner</option>
                                                                <?php } elseif ($result['banner_type'] == 2) { ?>
                                                                    <option value="1">Hero Right Banner</option>
                                                                    <option selected="selected" value="2">Home Popup Banner</option>
                                                                    <option value="3">Promotion Banner</option>
                                                                <?php } elseif ($result['banner_type'] == 3) { ?>
                                                                    <option value="1">Hero Right Banner</option>
                                                                    <option value="2">Home Popup Banner</option>
                                                                    <option selected="selected" value="3">Promotion Banner</option>
                                                                <?php  } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="bannerImage" class="">Upload Banner Image</label> <br>
                                                        <img src="<?= $result['banner_image']; ?>" alt="" width="80px">
                                                        <input value="<?= $result['banner_image']; ?>" name="bannerImage" id="bannerImage" type="file" class="form-control-file">
                                                    </div>
                                                        
                                                    </div>
                                                    <button name="submit" type="submit" class="mt-1 btn btn-primary">Update Banner</button>
                                                </form>
                                                <?php } } ?>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>