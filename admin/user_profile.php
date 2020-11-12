<?php include 'inc/header.php'; ?>  
                <div class="app-main__outer">
                    <div class="app-main__inner">
                                        <?php
                                            $id = Session::get("adminId");
                                            $query 	= "SELECT * FROM admins WHERE id = '$id'";
			                                $result = $db->select($query);
                                            if ($result) {
                                                while ($followingdata = $result->fetch_assoc()) {
                                            
                                        ?>
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-user icon-gradient bg-strong-bliss">
                                        </i>
                                    </div>
                                    <div>PROFILE DETAILS 
                                        <div class="page-title-subheading">Welcome Back! <strong> <?= $followingdata['name'] ?> </strong> Here you can view customer orders, manage customers order, change order status, add new product, add new product category, homepage slider, add user, manage users or customers and many more. Have fun!
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div> 
                                                <?php } } ?>
                        <div class="row">
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Orders</div>
                                            <div class="widget-subheading">Total orders placed on this site</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers"><span><a href="" class="text-success"><?php 
                                                $sql = "SELECT * FROM orders";
                                                $result = $db->select($sql);
                                                $row_cnt = $result->num_rows;
                                                echo $row_cnt;
                                            ?></a></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Categories</div>
                                            <div class="widget-subheading">Total categories created till now</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-primary"><span><a href=""><?php 
                                                $sql = "SELECT * FROM categories";
                                                $result = $db->select($sql);
                                                $row_cnt = $result->num_rows;
                                                echo $row_cnt;
                                            ?></a></span></div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Products</div>
                                            <div class="widget-subheading">Total amount of added product</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers"><a href="view_products.php" class="text-warning"><span><?php 
                                                $sql = "SELECT * FROM products";
                                                $result = $db->select($sql);
                                                $row_cnt = $result->num_rows;
                                                echo $row_cnt;
                                            ?></span></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Customers</div>
                                            <div class="widget-subheading">People interacted</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-danger"><span><?php 
                                                $sql = "SELECT * FROM customers";
                                                $result = $db->select($sql);
                                                $row_cnt = $result->num_rows;
                                                echo $row_cnt;
                                            ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Brands</div>
                                            <div class="widget-subheading">Total Brands Included</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers"><span><?php 
                                                $sql = "SELECT * FROM brands";
                                                $result = $db->select($sql);
                                                $row_cnt = $result->num_rows;
                                                echo $row_cnt;
                                            ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Guests</div>
                                            <div class="widget-subheading">Total Guests</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-danger"><span><?php 
                                                $sql = "SELECT * FROM guests";
                                                $result = $db->select($sql);
                                                $row_cnt = $result->num_rows;
                                                echo $row_cnt;
                                            ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">Acoount Details</div>
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <?php
                                            $id = Session::get("adminId");
                                            $query 	= "SELECT * FROM admins WHERE id = '$id'";
			                                $result = $db->select($query);
                                            if ($result) {
                                                while ($followingdata = $result->fetch_assoc()) {
                                            
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <th>Profile Image</th>
                                                    <td class="text-muted">
                                                    <img src="<?= $followingdata['admin_image'] ?>" alt="" width="40px;"></td>
                                                </tr>
                                                <tr>
                                                    <th>Name:</th>
                                                    <td class="text-muted"><input name="name" type="text" value="<?= $followingdata['name'] ?>"></td>
                                                </tr>
                                                <tr>
                                                    <th>Username:</th>
                                                    <td class="text-muted"><input name="username" type="text" value="<?= $followingdata['username'] ?>"></td>
                                                </tr>
                                                <tr>
                                                    <th>Email Address:</th>
                                                    <td class="text-muted"><input name="email" type="email" value="<?= $followingdata['email'] ?>" style="width: 290px;"></td>
                                                </tr>
                                                <tr>
                                                    <th>User Level:</th>
                                                    <td class="text-muted">
                                                        <?php 
                                                            if ($followingdata['level'] == 0) {
                                                                echo "Administrator";
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-block text-center card-footer">
                                        <button class="btn-wide btn btn-success">Save</button>
                                        <a href="edit_proImg.php?id=<?= $followingdata['id']; ?>" class="btn-wide btn btn-success">Edit Profile Image</a>
                                        <a href="change_pass.php?id=<?= $followingdata['id']; ?>" class="btn-wide btn btn-success">Change Password</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                    </div>
<?php include 'inc/footer.php'; ?>