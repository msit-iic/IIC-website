<section class="container" style="padding:0 7.5px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0">Header Menu</h3>
                </div>
                <div class="col-sm-6">
                    <ul class="float-sm-right">
                        <li class="breadcrumb-item active"><button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#add-new-header-option" <?php if (isset($_SESSION["type"]) && $_SESSION["type"] == "admin-help") {
                                                                                                                                                                            echo 'disabled';
                                                                                                                                                                        } ?>>Add New</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
$row = displayHeaderMenu();
if (is_array($row)) {

    // In the Case when We have Received Data of Header
    $rows = count($row);
?>


    <?php
    for ($i = 0; $i < $rows; $i++) {
    ?>

        <div class="container">
            <div class="row row-with-info d-flex align-items-center">
                <div class="col-sm-8">
                    <div class="m-0" style="font-size:larger;"><?php echo $row[$i][1]; ?></div>
                </div>
                <div class="col-sm-4 text-right">
                    <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#update-header-menu-details-<?php echo $i; ?>" <?php if (isset($_SESSION["type"]) && $_SESSION["type"] == "admin-help") {
                                                                                                                                                        echo 'disabled';
                                                                                                                                                    } ?>>Update</button>
                    <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#are-you-sure-<?php echo $i; ?>" <?php if ((isset($_SESSION["type"]) && $_SESSION["type"] == "admin-help") || ($rows == 1)) {
                                                                                                                                            echo 'disabled';
                                                                                                                                        } ?>>Delete</button>
                </div>
            </div>
        </div>


        <!--=============== Updating Modal ==================-->
        <div class="modal fade" id="update-header-menu-details-<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="update-header-menu" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                <div class="modal-content">
                    <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>

                    <div class="modal-body">

                        <div class="modal-header-title"><?php echo $row[$i][1]; ?></div>
                        <div class="login-form">
                            <form id="update-header-form-<?php echo $i; ?>" method="post">

                                <div class="alert alert-danger error" role="alert"></div>
                                <div class="alert alert-success success" role="alert"></div>

                                <div class="row form-group">
                                    <div class="form-check col-md-6">
                                        <input class="form-check-input" type="checkbox" name="display" value="1" <?php if ($row[$i][3] == 1) {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                                        <label class="form-check-label">
                                            Display in Navbar
                                        </label>
                                    </div>
                                    <div class="form-check col-md-6">
                                        <input class="form-check-input" type="checkbox" name="dropdown" value="1" <?php if ($row[$i][5] == 1) {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                                        <label class="form-check-label">
                                            Make a Dropdown
                                        </label>
                                    </div>

                                </div>



                                <div class="form-group">
                                    <label for="pagetitle">Page Title</label>
                                    <input type="text" class="form-control" placeholder="Page Title" id="pagetitle" value="<?php echo $row[$i][1]; ?>" name="title">
                                </div>



                                <?php
                                if ($row[$i][6] == "Home") { ?>
                                    <h4>Sections</h4>
                                    <?php $sections = displayHomeSections();
                                    for ($j = 0; $j < count($sections); $j++) {
                                    ?>

                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="home-section-<?php echo $j + 1; ?>" value="1" <?php if ($sections[$j][2] == 1) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>>
                                                <label class="form-check-label"><?php echo $sections[$j][1]; ?></label>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                } else if ($row[$i][6] == "Contact") { ?>
                                    <h4>Edit</h4>
                                    <?php $contact = fetchcontactPage();
                                    // print_r ($contact);
                                    if (is_array($contact)) {
                                    ?>
                                        <div class="form-group">
                                            <label for="contact-heading">Page Heading</label>
                                            <input type="text" class="form-control" id="contact-heading" name="contact-heading" value="<?php echo $contact[0]; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-form-title">Form Title</label>
                                            <input type="text" class="form-control" id="contact-form-title" name="contact-form-title" value="<?php echo $contact[1]; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-text">Contacting Text</label>
                                            <input type="text" class="form-control" id="contact-text" name="contact-text" value="<?php echo $contact[2]; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Address</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="address" class="form-control" id="contact-address-line-1" name="contact-address-line-1" value="<?php echo $contact[3]; ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="address" class="form-control" id="contact-address-line-2" name="contact-address-line-2" value="<?php echo $contact[4]; ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="address" class="form-control" id="contact-address-line-3" name="contact-address-line-3" value="<?php echo $contact[5]; ?>">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label>Emails</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="address" class="form-control" id="contact-email-1" name="contact-email-1" value="<?php echo $contact[6]; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="address" class="form-control" id="contact-email-2" name="contact-email-2" value="<?php echo $contact[7]; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="address" class="form-control" id="contact-phone-1" name="contact-phone-1" value="<?php echo $contact[8]; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="address" class="form-control" id="contact-phone-2" name="contact-phone-2" value="<?php echo $contact[9]; ?>">
                                                </div>
                                            </div>
                                        </div>

                                    <?php  }
                                    ?>

                                <?php
                                }
                                ?>

                                <input type="hidden" name="page-id" value="<?php echo $row[$i][0]; ?>">

                                <div class="form-group">
                                    <button type="submit" class="btn btn-md full-width btn-success update-header-menu-submit">Save Changes</button>
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

                        <div class="modal-header-title">Remove <span style="font-weight:900;color:brown;"><?php echo $row[$i][1]; ?></span> Page from App</div>
                        <div class="login-form">
                            <form id="delete-header-menu-item-<?php echo $i; ?>" method="post">
                                <div class="alert alert-danger error" role="alert"></div>
                                <div class="alert alert-success success" role="alert"></div>
                                <div class="form-group">
                                    <input type="hidden" name="page-id" value="<?php echo $row[$i][0]; ?>">
                                    <button type="button" class="btn btn-md full-width btn-danger delete-header-menu-item-btn">Delete</button>
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
        print_r($row);
        ?>
    </div>

<?php } ?>



<!-- Adding New Page Modal -->
<div class="modal fade" id="add-new-header-option" tabindex="-1" role="dialog" aria-labelledby="add-new-profile" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="sign-up">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>

            <div class="modal-body">

                <h4 class="modal-header-title">Add Header Menu Option</h4>
                <div class="login-form">
                    <form id="add-new-header-menu-item-form" method="post" enctype="multipart/form-data">

                        <div class="alert alert-danger error" role="alert"></div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Page Title" name="title">
                        </div>

                        <div class="form-check col-md-6 form-group">
                            <input class="form-check-input" type="checkbox" name="dropdown" value="1">
                            <label class="form-check-label">
                                Make a Dropdown
                            </label>
                        </div>

                        <div class="form-group">
                            <select class="custom-select" name="section">
                                <option selected>Select from Available Dropdowns</option>
                                <?php $dropdowns=fetchDropdown("");
                                if(is_array($dropdowns)){
                                    for($i=0;$i<count($dropdowns);$i++){ ?>
                                        <option value="<?php echo $dropdowns[$i][1]; ?>"><?php echo ucfirst($dropdowns[$i][1]); ?></option>
                                <?php }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="custom-select" name="links">
                                <option selected>Select from Available Pages</option>
                                <option value="?page=about-us">About Us</option>
                                <option value="?page=privacy-policy">Privacy Policy</option>
                                <option value="?page=faq">Frequently Asked Questions</option>
                                <option value="?page=blog">Blog</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width pop-login">Submit</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>