<?php include 'inc/header.php'; ?>
<?php include '../classes/Brand.php'; ?>
<?php 
	$brand = new Brand();

	if (isset($_GET['delete_brand'])) {
		$id = preg_replace('[^A-Za-z0-9_]', '', $_GET['delete_brand']);
		$delBrand = $brand->delBrandById($id);

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
                                    <div>VIEW BRANDS
                                        <div class="page-title-subheading">Welcome Back! <strong>admin</strong> Here you can view products, products title, price, manage products like delete or edit options.
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div> 
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Showing All Brands Order By Ascending</h5>
                                <div class="table-responsive table-bordered">
                                    <?php 
               
                                    if (isset($delBrand)) {
                                        echo $delBrand;
                                    }
                                    
                                    ?> 
                                    <table class="mb-0 table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Brand Name</th>
                                                <th>Brand Description</th>
                                                <th>Last Modified</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                    $getBrand = $brand->getAllBrand();
                                                    if ($getBrand) {
                                                        $i = 0;
                                                        while ($result = $getBrand->fetch_assoc()) {
                                                            $i++;
                                                ?>
                                                <tr>
                                                    <th scope="row"><?= $i ?></th>
                                                    <td><a href="edit_brand.php?id=<?= $result['id']; ?>"><?= $result['brand_name']; ?></a></td>
                                                    <td style="width: 400px;"><?= $result['brand_desc']; ?></td>
                                                    <td><?= $result['date']; ?></td>
                                                    <td style="text-align: center;"><a href="edit_brand.php?id=<?= $result['id']; ?>" <i class="fa fa-edit" aria-hidden="true" title="Edit"></i></td>
                                                    <td style="text-align: center;"><a onclick="return confirm('Are you sure to delete Brand?')" href="?delete_brand=<?= $result['id']; ?>" <i class="fa fa-trash" aria-hidden="true" title="Delete"></i></td>
                                                </tr>
                                                <?php } } else { ?>
                                                    <span class="error">Brand not found!</span>
                                                <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>