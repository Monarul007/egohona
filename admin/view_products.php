<?php include 'inc/header.php';?>
<?php include '../classes/Product.php'; ?>
<?php include_once '../helpers/Format.php'; ?>
<?php 
	$pd = new Product();
	$fm = new Format();
	if (isset($_GET['delete'])) {
		$id = preg_replace('[^A-Za-z0-9_]', '', $_GET['delete']);
		$delProd = $pd->delProuductById($id);

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
                                    <div>VIEW PRODUCTS
                                        <div class="page-title-subheading">Welcome Back! <strong> admin </strong> Here you can view products, products title, price, manage products like delete or edit options.
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div> 
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Showing All Products Order By Descending</h5>
                                <div class="table-responsive table-bordered">
                                    <?php 
                                        if (isset($delProd)) {
                                            echo $delProd;
                                        }
                                    ?>
                                    <table class="mb-0 table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Product Title</th>
                                                <th>Product Price</th>
                                                <th>Model</th>
                                                <th>Date Added</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php 
                                                        $getPd = $pd->getAllProduct();
                                                        if ($getPd) {
                                                            $i = 0;
                                                            while ($result = $getPd->fetch_assoc()) {
                                                                $i++;
                                                ?>
                                                <tr>
                                                    <th scope="row"><?= $i ?></th>
                                                    <th style="text-align: center;"><a href="../product.php?id=<?= $result['id']; ?>"><img style="width:40px; height:auto;" src="<?= $result['product_img']; ?>"></a></th>
                                                    <td><a href="../product.php?id=<?= $result['id']; ?>"><?= $result['product_title']; ?></a></td>
                                                    <td><span style="text-decoration: line-through;"><?= $result['regular_price']; ?></span> <?= $result['new_price']; ?></td>
                                                    <td><?= $result['product_code']; ?></td>
                                                    <td><?= $result['date']; ?></td>
                                                    <td style="text-align: center;"><a href="edit_product.php?edit=<?= $result['id']; ?>" <i class="fa fa-edit" aria-hidden="true" title="Edit"></i></td>
                                                    <td style="text-align: center;"><a onclick="return confirm('Are your sure to Delete!')" href="?delete=<?= $result['id']; ?>" <i class="fa fa-trash" aria-hidden="true" title="Delete"></i></td>
                                                </tr>
                                                <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php';?>