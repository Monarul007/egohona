<?php 
    include 'inc/header.php';
    include '../classes/Slider.php'; 
?>
<?php
    if (!isset($_GET['id']) || $_GET['id'] == NULL) {
        echo "<script>window.location = 'view_sliders.php'; </script>";
    } else {
        $id = preg_replace('[^A-Za-z0-9_]', '', $_GET['id']);

    }
    $slider = new Slider();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $updateSlider = $slider->sliderUpdate($_POST, $_FILES, $id);
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
                                    <div>UPDATE SLIDER
                                        <div class="page-title-subheading">Welcome Back! <strong> admin </strong> Here you can add new slider. Slider you added here will dynamically display on the main page where ever you want. Isn't fun?
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div> 
                                        <div class="main-card mb-3 card">
                                            <div class="card-body">
                                                <?php 
                                                    if (isset($updateSlider)) {
                                                        echo $updateSlider;
                                                    }
                                                ?>
                                                <?php 
                                                    $getSlider = $slider->getSliderById($id);
                                                    if ($getSlider) {
                                                        while ($result = $getSlider->fetch_assoc()) {
                                                ?>
                                                <form class="" method="POST" enctype="multipart/form-data">
                                                    <div class="position-relative form-group"><label for="slider_title">Slider Title</label><input name="sliderTitle" value="<?= $result['slide_title'] ?>" type="text" class="form-control"></div>
                                                    <div class="position-relative form-group"><label for="slider_title">Slider Type</label><input name="sliderType" value="<?= $result['slide_type'] ?>" type="text" class="form-control"></div>
                                                    <div class="position-relative form-group"><label for="slider_cap" >Slider Caption</label><input name="sliderCap" value="<?= $result['slide_caption'] ?>" type="text" class="form-control"></div>
                                                    <div class="position-relative form-group">
                                                    <img src="<?= $result['slide_img'] ?>" alt="" name="slideImg" width="70px"> <br>
                                                    <label for="slider_img" >Upload Slider Image</label> 
                                                    <input name="sliderImg" type="file" class="form-control-file">
                                                    </div>
                                                    </div>
                                                    <button name="submit" type="submit" class="mt-1 btn btn-primary">Update Slider</button>
                                                </form>
                                                <?php } } ?>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
<?php  include 'inc/footer.php'; ?>