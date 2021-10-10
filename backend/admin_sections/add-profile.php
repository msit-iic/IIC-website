<section class="container" style="padding:0 7.5px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0">Admin Profiles</h3>
                </div>
                <div class="col-sm-6">
                    <ul class="float-sm-right">
                        <li class="breadcrumb-item active"><button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#add-new-profile">Add New</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

$admins = fetchData("admin", "*", 1);


if (is_array($admins)) {
    // In the Case when We have Received Data of Admin Profiles

?>


    <?php
    for ($i = 0; $i < count($admins); $i++) { ?>

        <div class="container">
            <div class="row row-with-info d-flex align-items-center">
                <div class="col-sm-8">
                    <div class="m-0" style="font-size:larger;"><?php echo $admins[$i]["username"]; ?></div>
                </div>

                <div class="col-sm-4 text-right">
                    <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#update-admin-details-<?php echo $i; ?>">Update</button>
                    <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#are-you-sure-<?php echo $i; ?>" <?php if ($_SESSION["id"] == $admins[$i]["id"]) {
                                                                                                                                            echo 'disabled';
                                                                                                                                        } ?>>Delete</button>
                </div>
            </div>
        </div>
        <div class="modal fade update-admin-profile" id="update-admin-details-<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="update-admin-details" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                <div class="modal-content">
                    <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>

                    <div class="modal-body">

                        <div class="modal-header-title"><?php echo $admins[$i]["username"] . "'s Details : "; ?></div>
                        <div class="login-form">

                            <form id="update-modal-form-<?php echo $i; ?>" method="post">

                                <div class="alert alert-danger error" role="alert"></div>
                                <div class="alert alert-success success" role="alert"></div>
                                <div class="alert alert-warning warning" role="alert"></div>

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Username" value="<?php echo $admins[$i]["username"]; ?>" name="username">
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" value="<?php echo $admins[$i]["email"]; ?>" name="email">
                                </div>

                                <input type="hidden" name="admin-id" value="<?php echo $admins[$i]["id"]; ?>">


                                <div class="form-group">
                                    <button type="submit" class="btn btn-md full-width btn-success update-admin-profile-submit">Save Changes</button>
                                </div>
                            </form>

                            <form method="post" id="reset-password">
                                <div class="alert alert-warning warning" role="alert"></div>                                
                                <input type="hidden" name="username" value="<?php echo $admins[$i]["username"]; ?>">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary">Reset Password</button>                                                                                                                                        
                                </div>                                                                                                                                        
                            </form>

                            <form method="post" id="verification-code">
                                <div class="alert alert-warning warning" role="alert"></div>
                                <div class="alert alert-success success" role="alert"></div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <input type="text" id="verification-code" name="verification-code" placeholder="Verification Code Here" class="form-control" maxlength="6" />
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <form method="post" id="update-password">
                                <div class="alert alert-warning warning" role="alert"></div>
                                <div class="alert alert-success success" role="alert"></div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <input type="password" id="update-password" name="update-password" placeholder="New Password Here" class="form-control" />
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="are-you-sure-<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="are-you-sure" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                <div class="modal-content">
                    <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>

                    <div class="modal-body">

                        <div class="modal-header-title">Remove <span style="font-weight:900;color:brown;"><?php echo $admins[$i]["username"]; ?></span> Profile as Admin</div>
                        <div class="login-form">
                            <form id="delete-modal-form-<?php echo $i; ?>" method="post">
                                <div class="form-group">
                                    <input type="hidden" class="deleting-admin" name="username" value="<?php echo $admins[$i]["username"]; ?>">
                                    <button type="button" class="btn btn-md full-width btn-danger delete-admin-profile-btn">Delete</button>
                                    <button type="button" class="btn btn-md full-width btn-secondary mod-close" data-dismiss="modal" aria-hidden="true" style="margin-top:3px;">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    <?php
    }
} else { ?>

    <!-- In the case We Have Received Error Msg string -->
    <div class="alert alert-warning" role="alert">
        <?php
        print_r($admins);
        ?>
    </div>

<?php } ?>

<div class="modal fade" id="add-new-profile" tabindex="-1" role="dialog" aria-labelledby="add-new-profile" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="sign-up">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>

            <div class="modal-body">

                <h4 class="modal-header-title">Add Admin Profile</h4>
                <div class="login-form">
                    <form id="add-new-profile-form" method="post" enctype="multipart/form-data">

                        <div class="alert alert-danger error" role="alert"></div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="username">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" name="email">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="*******" name="password">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-md btn-success full-width pop-login">Submit</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>