<?php 
    include 'inc/header.php';
    include '../classes/Banner.php'; 
?>
<?php 
    $bnnr = new Banner();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $insertBanner = $bnnr->BannerInsert($_POST, $_FILES);
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
                                                    if (isset($insertBanner)) {
                                                        echo $insertBanner;
                                                    }
                                                ?>
                                                <form action="" class="" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="bannerText" class="">Banner Text</label>
                                                        <input name="bannerText" placeholder="Enter Banner text" type="text" class="form-control">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="bannerType" class="">Banner Type</label>
                                                        <select type="select" id="bannerType" name="bannerType" class="custom-select">
                                                            <option value="1">Hero Right Banner</option>
                                                            <option value="2">Home Popup Banner</option>
                                                            <option value="3">Promotion Banner</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="bannerImage" class="">Upload Banner Image</label>
                                                        <input name="bannerImage" id="bannerImage" type="file" class="form-control-file">
                                                    </div>
                                                        
                                                    </div>
                                                    <button name="submit" type="submit" class="mt-1 btn btn-primary">Add Banner</button>
                                                </form>
                                                
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>