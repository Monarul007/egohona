<?php 
    include 'inc/header.php';
    include '../classes/Category.php'; 
?>
<?php 
    $cat = new Category();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['cat_title'];
        $parentCat = $_POST['parent_category'];
        $CatDesc = $_POST['cat_description'];
        $insertCat = $cat->catInsert($catName, $parentCat, $CatDesc);
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
                                    <div>ADD NEW CATEGORY
                                        <div class="page-title-subheading">Welcome Back! <strong> admin </strong> Here you can add new product. Product you added here will dynamically display on the main page where ever you want. Isnt fun?
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div> 
                                        <div class="main-card mb-3 card">
                                            <div class="card-body">
                                                <?php 
                                                    if (isset($insertCat)) {
                                                        echo $insertCat;
                                                    }
                                                ?>
                                                <form action="" class="" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group"><label for="cat_title" class="">Category Title</label><input name="cat_title" placeholder="Enter category title" type="text" class="form-control"></div>
                                                    
                                                    <div class="form-group"><label for="exampleCustomSelect" class="">Select Category</label>
                                                    <select type="select" name="parent_category" class="custom-select">
                                                        <option value="NULL">Select Category</option>
                                                        <?php 
                                                    $getCat = $cat->getAllCat();
                                                    if ($getCat) {
                                                        while ($result = $getCat->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?= $result['id'] ?>"><?= $result['cat_name'] ?></option>
                                                    <?php } } ?>
                                                    </select>
                                                    </div>
                                                    <div class="form-group"><label for="exampleText" class="">Category Description</label><textarea name="cat_description" class="form-control"></textarea></div>
                                                        
                                                    </div>
                                                    <button name="add_category" type="submit" class="mt-1 btn btn-primary">Add Category</button>
                                                </form>
                                                
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>