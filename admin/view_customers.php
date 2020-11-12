<?php
include 'inc/header.php';
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
                                    <div>VIEW CUSTOMERS
                                        <div class="page-title-subheading">Welcome Back! <strong></strong> Here you can view products, products title, price, manage products like delete or edit options.
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div> 
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Showing All Customers Order By Descending</h5>
                                <div class="table-responsive table-bordered">
                                    <table class="mb-0 table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Customers Name</th>
                                                <th>Email Address</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                $i = 0;
                                                $query 	= "SELECT * FROM customers";
                                                $getData = $db->select($query);
                                                if ($getData) {
                                                    while ($result = $getData->fetch_assoc()) {
                                                        $i++
                                                ?>
                                                <tr>
                                                    <th scope="row"><?= $i ?></th>
                                                    <th><img style="width:40px; height:auto;" src="../<?= $result['profile_img']; ?>"></a></th>
                                                    <td><?= $result['full_name']; ?></td>
                                                    <td><?= $result['email_address']; ?></td>
                                                    <td><?= $result['phone']; ?></td>
                                                    <td><?= $result['billing_address']; ?></td>
                                                </tr>
                                                <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
 <?php
include 'inc/footer.php';
?> 