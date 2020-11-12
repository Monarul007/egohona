<?php 
    include 'inc/header.php';
    include '../classes/Product.php'; 
    include '../classes/Category.php'; 
    include '../classes/Brand.php';
?>   
<?php 
    if (!isset($_GET['edit']) || $_GET['edit'] == NULL) {
        echo "<script>window.location = 'view_products.php'; </script>";
    } else {
        $id = preg_replace('[^A-Za-z0-9_]', '', $_GET['edit']);

    }
    $pd = new Product();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $updateProduct = $pd->productUpdate($_POST, $_FILES, $id);
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
                                    <div>ADD NEW PRODUCT
                                        <div class="page-title-subheading">Welcome Back! <strong> admin </strong> Here you can add new product. Product you added here will dynamically display on the main page where ever you want. Isn't fun?
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div> 
                        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                            <li class="nav-item">
                                <a role="tab" class="nav-link show active" id="tab-0" data-toggle="tab" href="#tab-content-0" aria-selected="true">
                                    <span>Basic Information</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane tabs-animation fade active show" id="tab-content-0" role="tabpanel">
                                        <div class="main-card mb-3 card">
                                            <div class="card-body">
                                                <?php 
                                                    if (isset($updateProduct)) {
                                                        echo $updateProduct;
                                                    }
                                                ?>
                                                <?php 
                                                    $getProd = $pd->getProductById($id);
                                                    if ($getProd) {
                                                        while ($value = $getProd->fetch_assoc()) {
                                                ?>
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <div class="position-relative form-group"><label for="pro_title" class="">Product Title</label><input name="pro_title" id="pro_title" value="<?= $value['product_title'] ?>" type="text" class="form-control"></div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="position-relative form-group"><label for="exampleCustomSelect" class="">Select Category</label><select type="select" id="exampleCustomSelect" name="category" class="custom-select">
                                                                <option value="">Select Category</option>
                                                                <?php 
                                                                    $cat = new Category();
                                                                    $getCat = $cat->getAllCat();
                                                                    if ($getCat) {
                                                                        while ($result = $getCat->fetch_assoc()) {
                                                                ?>
                                                                        <option 
                                                                            <?php if ($value['cat_id'] == $result['id']) { ?>
                                                                                    selected = "selected"
                                                                            <?php  } ?>
                                                                        value="<?php echo $result['id']; ?>"><?php echo $result['cat_name']; ?>
                                                                        </option>
                                                                <?php } } ?>
                                                            </select></div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="position-relative form-group"><label for="exampleCustomSelect" class="">Select Brand</label><select type="select" name="brand" class="custom-select">
                                                                <option value="">Select Brand</option>
                                                                <?php 
                                                                    $brand = new Brand();
                                                                    $getBrand = $brand->getAllBrand();
                                                                    if ($getBrand) {
                                                                        while ($result = $getBrand->fetch_assoc()) {
                                                                ?> 
                                                                        <option 
                                                                            <?php if ($value['brand_id'] == 
                                                                            $result['id']) { ?>
                                                                                selected = "selected"
                                                                            <?php } ?>
                                                                        value="<?php echo $result['id']; ?>"><?php echo $result['brand_name']; ?></option>
                                                                <?php } } ?>
                                                            </select></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="position-relative form-group"><label for="model">Model</label><input value="<?php echo $value['product_code']; ?>" type="text" name="model" class="form-control"></div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="position-relative form-group">
                                                            <label for="exampleCustomSelect" class="">Product Price</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend"><span class="input-group-text">BDT</span></div>
                                                                <input value="<?php echo $value['regular_price']; ?>" type="number" name="old_price" class="form-control">
                                                                <div class="input-group-append"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="position-relative form-group">
                                                            <label for="exampleCustomSelect" class="">Discounted Price</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend"><span class="input-group-text">BDT</span></div>
                                                                <input value="<?php echo $value['new_price']; ?>" step="1" type="number" name="new_price" class="form-control">
                                                                <div class="input-group-append"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="position-relative form-group"><label for="description" class="">Product Description</label><textarea name="description" class="form-control"><?php echo $value['product_desc']; ?></textarea></div>
                                                    <div class="position-relative form-group"><label for="specification" class="">Product Specification</label><textarea name="specification" class="form-control"><?php echo $value['product_spec']; ?></textarea></div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <img src="<?php echo $value['product_img']; ?>" width="50px"><br>
                                                            <div class="position-relative form-group"><label for="product_image" class="">Upload Product Image</label><input name="image" value="<?php echo $value['product_img']; ?>" type="file" class="form-control-file">
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-4">
                                                            <div class="position-relative form-group"><label for="product_type" class="">Product Type</label><select type="select" name="product_type" class="custom-select">
                                                                <option>Select Type</option>
                                                                <?php if ($value['product_type'] == 1) { ?>
                                                                    <option selected="selected" value="1">Featured Product</option>
                                                                    <option value="0">Regular Product</option>
                                                                <?php } else { ?>
                                                                <option value="1">Featured Product</option>
                                                                <option selected="selected" value="0">Regular Product</option>
                                                                <?php } ?>
                                                            </select></div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="position-relative form-group"><label for="product_status" class="">Product Status</label><select type="select" name="product_status" class="custom-select">
                                                                <option>Select Product Status</option>
                                                                <?php if ($value['product_status'] == 0) { ?>
                                                                    <option selected="selected" value="0">Enabled</option>
                                                                    <option value="1">Disabled</option>
                                                                <?php } else { ?>
                                                                <option value="0">Enabled</option>
                                                                <option selected="selected" value="1">Disabled</option>
                                                                <?php } ?>
                                                            </select></div> 
                                                        </div>  
                                                    </div>
                                                    <button name="submit" type="submit" class="mt-1 btn btn-primary">Update Product</button>
                                                </form>
                                                <?php } } ?>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>