<?php 
    include 'inc/header.php';
    include '../classes/General.php'; 
?>
<?php
    if (!isset($_GET['id']) || $_GET['id'] == NULL) {
        echo "<script>window.location = 'user_profile.php'; </script>";
    } else {
        $id = preg_replace('[^A-Za-z0-9_]', '', $_GET['id']);

    }
    $proimg = new General();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $adminPass = $_POST['changepass'];
        $updatePass = $proimg->adminPassUpdate($id, $adminPass);
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
                                    <div>Change Password
                                        <div class="page-title-subheading">Welcome Back! <strong> <?= $result['name'] ?> </strong> Here you can add new product. Product you added here will dynamically display on the main page where ever you want. Isnt fun?
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div> 
                                        <div class="main-card mb-3 card">
                                            <div class="card-body">
                                                <?php 
                                                    if (isset($updatePass)) {
                                                        echo $updatePass;
                                                    }
                                                ?>
                                                <?php
                                                    $id = Session::get("adminId");
                                                    $query 	= "SELECT * FROM admins WHERE id = '$id'";
                                                    $result = $db->select($query);
                                                    if ($result) {
                                                        while ($followingdata = $result->fetch_assoc()) {
                                                    
                                                ?>
                                                <form action="" class="" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="changepass" class="">Change Password</label>
                                                        <input name="changepass" value="<?php echo $followingdata['admin_pass']; ?>" type="password" class="form-control">
                                                    </div>
                                                        
                                                    </div>
                                                    <button name="changePass" type="submit" class="mt-1 btn btn-primary">Change Password</button>
                                                </form>
                                                <?php } } ?>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>