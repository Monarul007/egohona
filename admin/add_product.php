<?php 
    include 'inc/header.php';
    include '../classes/Product.php'; 
    include '../classes/Category.php'; 
    include '../classes/Brand.php';
?>   
<?php 
    $pd = new Product();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $insertProduct = $pd->productInsert($_POST, $_FILES);
    }
?>
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
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
                                                    if (isset($insertProduct)) {
                                                        echo $insertProduct;
                                                    }
                                                ?>
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <div class="position-relative form-group"><label for="pro_title" class="">Product Title</label><input name="pro_title" id="pro_title" placeholder="Enter product title..." type="text" class="form-control"></div>
                                                    
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
                                                                        <option value="<?php echo $result['id']; ?>"><?php echo $result['cat_name']; ?></option>
                                                                <?php } } ?>
                                                            </select></div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="position-relative form-group"><label for="exampleCustomSelect" class="">Select Brand</label><select type="select" id="exampleCustomSelect" name="brand" class="custom-select">
                                                                <option value="">Select Brand</option>
                                                                <?php 
                                                                    $brand = new Brand();
                                                                    $getBrand = $brand->getAllBrand();
                                                                    if ($getBrand) {
                                                                        while ($result = $getBrand->fetch_assoc()) {
                                                                ?> 
                                                                        <option value="<?php echo $result['id']; ?>"><?php echo $result['brand_name']; ?></option>
                                                                <?php } } ?>
                                                            </select></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="position-relative form-group"><label for="model">Model</label><input placeholder="Enter Product Model..." type="text" name="model" class="form-control"></div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="position-relative form-group">
                                                            <label for="exampleCustomSelect" class="">Product Price</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend"><span class="input-group-text">BDT</span></div>
                                                                <input placeholder="Amount" type="number" name="old_price" class="form-control">
                                                                <div class="input-group-append"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="position-relative form-group">
                                                            <label for="exampleCustomSelect" class="">Discounted Price</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend"><span class="input-group-text">BDT</span></div>
                                                                <input placeholder="Amount" step="1" type="number" name="new_price" class="form-control">
                                                                <div class="input-group-append"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="position-relative form-group">
                                                        <label for="description" class="">Product Description</label>
                                                        <textarea name="description" rows="5" id="description" class="form-control"></textarea>
                                                    </div>
                                                    <div class="position-relative form-group"><label for="specification" class="">Product Specification</label><textarea name="specification" rows="5" id="exampleText" class="form-control"></textarea></div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="position-relative form-group"><label for="product_image" class="">Upload Product Image</label><input name="image" id="product_image" type="file" class="form-control-file">
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-4">
                                                            <div class="position-relative form-group"><label for="product_type" class="">Product Type</label><select type="select" id="product_type" name="product_type" class="custom-select">
                                                                <option value="1">Featured Product</option>
                                                                <option value="0">Regular Product</option>
                                                            </select></div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="position-relative form-group"><label for="product_status" class="">Product Status</label><select type="select" id="product_status" name="product_status" class="custom-select">
                                                                <option value="0">Enable Product</option>
                                                                <option value="1">Disable Product</option>
                                                            </select></div> 
                                                        </div>  
                                                    </div>
                                                    <button name="submit" type="submit" id="showtoast" class="mt-1 btn btn-primary">Add New Product</button>
                                                </form>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
<!-- Load TinyMCE -->
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>