<?php $title = 'Register';
ob_start(); ?>

<!-- Start Sign In -->
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12 mx-auto">
                <div class="contact-form-right">
                    <h2 class="text-center">Create New Account</h2>
                    <form action="index.php?action=register-new-user" method="post" id="formRegister">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputName" class="mb-0">First Name</label>
                                    <input type="text" name="firstname" class="form-control" id="InputName" placeholder="First Name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputLastname" class="mb-0">Last Name</label>
                                    <input type="text" name="lastname" class="form-control" id="InputLastname" placeholder="Last Name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputEmail1" class="mb-0">Email Address</label>
                                    <input type="email" name="email" class="form-control" id="InputEmail1" placeholder="Enter Email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputPassword1" class="mb-0">Password</label>
                                    <input type="password" name="password" class="form-control" id="InputPassword1" placeholder="Password">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="submit-button text-center">
                                    <button type="submit" name="account-register" class="btn hvr-hover">Register</button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Sign In-->

<?php
$content = ob_get_clean();
require 'view/frontend/template.php';
?>