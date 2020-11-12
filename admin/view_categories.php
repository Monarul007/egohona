<?php include 'inc/header.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php 
	$cat = new Category();
	if (isset($_GET['delete_cat'])) {
		$id = preg_replace('[^A-Za-z0-9_]', '', $_GET['delete_cat']);
		$delCat = $cat->delCatById($id);

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
                                    <div>VIEW CATEGORIES
                                        <div class="page-title-subheading">Welcome Back! <strong> admin </strong> Here you can view products, products title, price, manage products like delete or edit options.
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div> 
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Showing All Categories Order By Ascending</h5>
                                <div class="table-responsive table-bordered">
                                    <?php 
                                    if (isset($delCat)) {
                                        echo $delCat;
                                    }
                                    ?>  
                                    <table class="mb-0 table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Category Name</th>
                                                <th>Category Description</th>
                                                <th>Last Modified</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $getCat = $cat->getAllCat();
                                                if ($getCat) {
                                                    $i = 0;
                                                    while ($result = $getCat->fetch_assoc()) {
                                                        $i++;
                                            ?>
                                                <tr>
                                                    <th scope="row"><?= $i ?></th>
                                                    <td><a href="edit_category.php?cat_id=<?= $result['id']; ?>"><?= $result['cat_name']; ?></a></td>
                                                    <td style="width: 400px;"><?= $result['cat_desc']; ?></td>
                                                    <td><?= $result['date']; ?></td>
                                                    <td style="text-align: center;"><a href="edit_category.php?cat_id=<?= $result['id']; ?>" <i class="fa fa-edit" aria-hidden="true" title="Edit"></i></td>
                                                    <td style="text-align: center;"><a onclick="return confirm('Are you sure to delete category?')" href="?delete_cat=<?= $result['id']; ?>" <i class="fa fa-trash" aria-hidden="true" title="Delete"></i></td>
                                                </tr>
                                                <?php } } else { ?>
                                                    <span class="error">Category not found!</span>
                                                <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>