<?php $title = 'Sign In';
ob_start(); ?>

<!-- Start Sign In -->
<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12 mx-auto">
                <div class="contact-form-right">
                    <h2 class="text-center">Account Login</h2>
                    <form action="index.php?action=sign-in-user" method="post" id="formLogin">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputEmail" class="mb-0">Email Address</label>
                                    <input type="email" name="email" class="form-control" id="InputEmail" placeholder="Enter Email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputPassword" class="mb-0">Password</label>
                                    <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Password">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="submit-button text-center">
                                    <button type="submit" name="sign-in" class="btn hvr-hover">Login</button>
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