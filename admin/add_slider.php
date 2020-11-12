<?php 
    include 'inc/header.php';
    include '../classes/Slider.php'; 
?>
<?php 
    $slider = new Slider();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $insertSlider = $slider->sliderInsert($_POST, $_FILES);
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
                                    <div>ADD NEW SLIDER
                                        <div class="page-title-subheading">Welcome Back! <strong> admin </strong> Here you can add new slider. Slider you added here will dynamically display on the main page where ever you want. Isn't fun?
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div> 
                                        <div class="main-card mb-3 card">
                                            <div class="card-body">
                                                <?php 
                                                    if (isset($insertSlider)) {
                                                        echo $insertSlider;
                                                    }
                                                ?>
                                                <form class="" method="POST" enctype="multipart/form-data">
                                                    <div class="position-relative form-group"><label for="slider_title">Slider Title</label><input name="sliderTitle" placeholder="Enter Slider Title..." type="text" class="form-control"></div>
                                                    <div class="position-relative form-group"><label for="slider_title">Slider Type</label><input name="sliderType" placeholder="Enter Slider Type..." type="text" class="form-control"></div>
                                                    <div class="position-relative form-group"><label for="slider_cap" >Slider Caption</label><input name="sliderCap" placeholder="Enter Slider Caption Text" type="text" class="form-control"></div>
                                                    <div class="position-relative form-group"><label for="slider_img" >Upload Slider Image</label><input name="sliderImg" type="file" class="form-control-file">
                                                    </div>
                                                    </div>
                                                    <button name="submit" type="submit" class="mt-1 btn btn-primary">Add Slider</button>
                                                </form>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
<?php  include 'inc/footer.php'; ?>