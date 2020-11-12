<?php include 'inc/header.php'; ?>
<?php include '../classes/Banner.php'; ?>
<?php 
	$banner = new Banner();

	if (isset($_GET['delete'])) {
		$id = preg_replace('[^A-Za-z0-9_]', '', $_GET['delete']);
		$delBanner = $banner->delBannerById($id);

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
                                    <div>VIEW SLIDERS
                                        <div class="page-title-subheading">Welcome Back! <strong>admin </strong> Here you can view products, products title, price, manage products like delete or edit options.
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div> 
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Showing All Slider Order By Ascending</h5>
                                <div class="table-responsive table-bordered">
                                    <?php 
                                        if (isset($delSlider)) {
                                            echo $delSlider;
                                        }
                                    ?>
                                    <table class="mb-0 table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Banner Type</th>
                                                <th>Banner Image</th>
                                                <th>Banner Text</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                    $getBanner = $banner->getAllBanners();
                                                    if ($getBanner) {
                                                        $i = 0;
                                                        while ($result = $getBanner->fetch_assoc()) {
                                                            $i++;
                                                ?>
                                                <tr>
                                                    <th scope="row"><?= $i ?></th>
                                                    <?php 
                                                        if ($result['banner_type'] == 1) { ?>
                                                            <td>Hero Right Banner</td>
                                                        <?php } elseif ($result['banner_type'] == 2) { ?>
                                                            <td>Hero Right Banner</td>
                                                        <?php } elseif ($result['banner_type'] == 3) { ?>
                                                            <td>Promotion Banner</td>
                                                        <?php } ?>
                                                    <td style="text-align:center;"><img src="<?= $result['banner_image'] ?>" style="width:70px; height:auto;" ></td>
                                                    <td><?= $result['banner_title'] ?></td>
                                                    <td style="text-align: center;"><a href="edit_banner.php?id=<?= $result['id'] ?>" <i class="fa fa-edit" aria-hidden="true" title="Edit"></i></td>
                                                    <td style="text-align: center;"><a onclick="return confirm('Are your sure to Delete!')" href="?delete=<?= $result['id']; ?>" <i class="fa fa-trash" aria-hidden="true" title="Delete"></i></td>
                                                </tr>
                                                <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>