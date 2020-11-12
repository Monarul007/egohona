<?php 
    include 'inc/header.php';
    include '../classes/Brand.php'; 
?>
<?php 
    $brand = new Brand();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brand_name'];
        $brandDesc = $_POST['brand_desc'];

        $insertBrand = $brand->brandInsert($brandName, $brandDesc);
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
                                    <div>ADD NEW BRAND
                                        <div class="page-title-subheading">Welcome Back! <strong> admin </strong> Here you can add new product. Product you added here will dynamically display on the main page where ever you want. Isnt fun?
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div> 
                                        <div class="main-card mb-3 card">
                                            <div class="card-body">
                                                <?php 
                                                    if (isset($insertBrand)) {
                                                        echo $insertBrand;
                                                    }
                                                ?>
                                                <form action="" class="" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="brand_name" class="">Brand Title</label>
                                                        <input name="brand_name" placeholder="Enter brand title" type="text" class="form-control">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="brand_desc" class="">Brand Description</label>
                                                        <textarea name="brand_desc" class="form-control"></textarea>
                                                    </div>
                                                        
                                                    </div>
                                                    <button name="add_brand" type="submit" class="mt-1 btn btn-primary">Add New Brand</button>
                                                </form>
                                                
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>