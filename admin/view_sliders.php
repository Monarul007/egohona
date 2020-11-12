<?php include 'inc/header.php'; ?>
<?php include '../classes/Slider.php'; ?>
<?php 
	$slider = new Slider();

	if (isset($_GET['delete'])) {
		$id = preg_replace('[^A-Za-z0-9_]', '', $_GET['delete']);
		$delSlider = $slider->delSliderById($id);

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
                                        <div class="page-title-subheading">Welcome Back! <strong><?= $admin_name ?> </strong> Here you can view products, products title, price, manage products like delete or edit options.
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
                                                <th>Slider Name</th>
                                                <th>Slider Image</th>
                                                <th>Slider Title</th>
                                                <th>Slider Type</th>
                                                <th>Slider Caption</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                    $getSlider = $slider->getAllSliders();
                                                    if ($getSlider) {
                                                        $i = 0;
                                                        while ($result = $getSlider->fetch_assoc()) {
                                                            $i++;
                                                ?>
                                                <tr>
                                                    <th scope="row"><?= $i ?></th>
                                                    <td><?= $result['slide_title'] ?></td>
                                                    <td style="text-align:center;"><img src="<?= $result['slide_img'] ?>" style="width:70px; height:auto;" ></td>
                                                    <td><?= $result['slide_title'] ?></td>
                                                    <td><?= $result['slide_type'] ?></td>
                                                    <td><?= $result['slide_caption'] ?></td>
                                                    <td style="text-align: center;"><a href="edit_slider.php?id=<?= $result['id'] ?>" <i class="fa fa-edit" aria-hidden="true" title="Edit"></i></td>
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