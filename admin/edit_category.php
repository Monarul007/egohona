<?php 
    include 'inc/header.php';
    include '../classes/Category.php'; 
?>
<?php
    if (!isset($_GET['cat_id']) || $_GET['cat_id'] == NULL) {
        echo "<script>window.location = 'catlist.php'; </script>";
    } else {
        $id = preg_replace('[^A-Za-z0-9_]', '', $_GET['cat_id']);

    }
    $cat = new Category();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['cat_title'];
        $parentCat = $_POST['parent_category'];
        $cat_desc = $_POST['cat_description'];
        $updateCat = $cat->catUpdate($catName, $id, $parentCat, $cat_desc);
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
                                    <div>UPDATE CATEGORY
                                        <div class="page-title-subheading">Welcome Back! <strong><?= $admin_name ?> </strong> Here you can add new product. Product you added here will dynamically display on the main page where ever you want. Isn't fun?
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                                    <div class="main-card mb-3 card">
                                            <div class="card-body">
                                                <?php 
                                                    if (isset($updateCat)) {
                                                        echo $updateCat;
                                                    }
                                                ?>
                                                <?php 
                                                    $getCat = $cat->getCatById($id);
                                                    if ($getCat) {
                                                        while ($result = $getCat->fetch_assoc()) {
                                                ?>
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <div class="position-relative form-group"><label for="cat_title">Category Title</label><input value="<?= $result['cat_name'] ?>" name="cat_title" type="text" class="form-control"></div>
                                                    
                                                    <div class="position-relative form-group"><label for="exampleCustomSelect" class="">Select Parent Category</label><select type="select" id="exampleCustomSelect" name="parent_category" class="custom-select" required>
                                                        <option value="">Select Parent Category</option>
                                                        <?php 
                                                    $getCat = $cat->getAllCat();
                                                    if ($getCat) {
                                                        while ($result = $getCat->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?= $result['id'] ?>"><?= $result['cat_name'] ?></option>
                                                    <?php } } ?>
                                                    </select>
                                                    </div>
                                                    <div class="position-relative form-group"><label for="exampleText" class="">Category Description</label><textarea value="" name="cat_description" class="form-control"> <?= $result['cat_desc'] ?> </textarea></div>
                                                        
                                                    </div>
                                                    <button name="update" type="submit" class="mt-1 btn btn-primary">Update Category</button>
                                                </form>
                                                <?php } } ?>
                                            </div>
                                        </div>  
                            </div>                     
                        </div>
                    </div>
<?php 
    include 'inc/footer.php';
?>