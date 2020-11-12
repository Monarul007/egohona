<?php 
    include 'inc/header.php';
    include '../classes/Brand.php'; 
?>
<?php
    if (!isset($_GET['id']) || $_GET['id'] == NULL) {
        echo "<script>window.location = 'brandlist.php'; </script>";
    } else {
        $id = preg_replace('[^A-Za-z0-9_]', '', $_GET['id']);

    }
    $brand = new Brand();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brand_name'];
        $brandDesc = $_POST['brand_desc'];
        $updateBrand = $brand->brandUpdate($brandName, $id, $brandDesc);
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
                                    <div>EDIT BRAND
                                        <div class="page-title-subheading">Welcome Back! <strong> admin </strong> Here you can add new product. Product you added here will dynamically display on the main page where ever you want. Isnt fun?
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div> 
                                        <div class="main-card mb-3 card">
                                            <div class="card-body">
                                                <?php 
                                                    if (isset($updateBrand)) {
                                                        echo $updateBrand;
                                                    }
                                                ?>
                                                <?php 
                                                    $getBrand = $brand->getBrandById($id);
                                                    if ($getBrand) {
                                                        while ($result = $getBrand->fetch_assoc()) {
                                                ?>
                                                <form action="" class="" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="brand_name" class="">Edit Brand Title</label>
                                                        <input name="brand_name" value="<?php echo $result['brand_name']; ?>" type="text" class="form-control">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="brand_desc" class="">Edit Brand Description</label>
                                                        <textarea name="brand_desc" class="form-control"><?= $result['brand_desc'] ?></textarea>
                                                    </div>
                                                        
                                                    </div>
                                                    <button name="update_brand" type="submit" class="mt-1 btn btn-primary">Update Brand</button>
                                                </form>
                                                <?php } } ?>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>