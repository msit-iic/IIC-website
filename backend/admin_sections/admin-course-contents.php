<!-- Admin's Interface For Course Contents -->

<?php
if (isset($_GET["id"])) {
    // When we have 
    $id = $_GET["id"];

?>

    <section class="container" style="padding:0 7.5px;">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3 class="m-0"><?php $coursetitle = fetchCourseTitle($id);
                                        echo $coursetitle." Contents";
                                        ?></h3>
                    </div>
                    <div class="col-sm-6">
                        <ul class="float-sm-right">
                            <li class="breadcrumb-item active"><button data-toggle="modal" data-target="#add-new-course-content" type="button" class="btn btn-success mb-2">Add New</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    if ($coursetitle != "Course Content Empty") {
        $tableTitle = encryptTitle($coursetitle);
        $row = displayCourseContent($tableTitle);
        if (is_array($row)) {
            for ($i = 0; $i < count($row); $i++) { ?>
                <div class="container">
                    <div class="row row-with-info d-flex align-items-center">
                        <div class="col-sm-8">
                            <div class="m-0" style="font-size:larger;"><?php echo $row[$i][1]; ?></div>
                        </div>

                        <div class="col-sm-4 text-right">
                            <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#update-course-contents-modal-<?php echo $i; ?>">Update</button>
                            <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#are-you-sure-<?php echo $i; ?>" <?php if (count($row) == 1 || (isset($_SESSION["type"]) && $_SESSION["type"] == "admin-help")) {
                                                                                                                                                    echo 'disabled';
                                                                                                                                                } ?>>Delete</button>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="update-course-contents-modal-<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="update-admin-details" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl login-pop-form" role="document">
                        <div class="modal-content">
                            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>

                            <div class="modal-body">

                                <div class="modal-header-title"><?php echo $row[$i][1]; ?></div>
                                <div class="login-form">
                                    <form method="post" class="update-course-content" id="update-course-content-<?php echo $i; ?>" enctype="multipart/form-data">

                                        <div class="alert alert-danger error" role="alert"></div>

                                        <div class="form-group">
                                            <label>Page Title</label>
                                            <input type="text" class="form-control content-heading" name="content-heading" placeholder="Course Title" value="<?php echo $row[$i][1]; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="content-text">Editor to Design Page</label>
                                            <textarea class="content-text" name="content-text"><?php echo $row[$i][2]; ?></textarea>
                                        </div>
                                        <input type="hidden" name="course-id" class="course-id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="content-id" class="content-id" value="<?php echo $row[$i][0]; ?>">
                                        <div class="row">
                                            <div class="form-group col-lg-12 col-md-12">
                                                <button type="submit" class="btn btn-md full-width btn-success mod-close update-course-content-submit" value="Save Changes">Save Changes</button>
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

                                <div class="modal-header-title">Remove <span style="font-weight:900;color:brown;"><?php echo $row[$i][1]; ?></span> Page from <?php echo $coursetitle; ?> Course</div>
                                <div class="login-form">
                                    <form id="delete-modal-form-<?php echo $i; ?>" method="post">
                                        <div class="form-group">
                                            <input type="hidden" name="content-id" value="<?php echo $row[$i][0]; ?>">
                                            <input type="hidden" name="course-id" value="<?php echo $id; ?>">
                                            <button type="button" class="btn btn-md full-width btn-danger delete-course-content-btn">Delete</button>
                                            <button type="button" class="btn btn-md full-width btn-secondary mod-close" data-dismiss="modal" aria-hidden="true" style="margin-top:3px;">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            <?php    }
        } else { ?>
            <div class="alert alert-info" role="alert"><?php echo $tableTitle; ?></div>
        <?php }
        ?>



    <?php  } else { ?>
        <div class="alert alert-info" role="alert"><?php echo $coursetitle; ?></div>

    <?php }
    ?>


    <?php // displayCourseContent($id); 
    ?>
<?php } else {
    include_once("views/error.php");
}
?>

<!-- Add New Course Modal -->
<div class="modal fade" id="add-new-course-content" tabindex="-1" role="dialog" aria-labelledby="add-new-profile" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form modal-xl" role="document">
        <div class="modal-content">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>

            <div class="modal-body">

                <h4 class="modal-header-title">Add Course Content</h4>
                <div class="login-form">
                    <form method="post" class="add-course-content" id="add-course-content-<?php echo $id; ?>" enctype="multipart/form-data">

                        <div class="alert alert-danger error" role="alert"></div>

                        <div class="form-group">
                            <label>Page Title</label>
                            <input type="text" class="form-control content-heading" name="content-heading" placeholder="Course Title">
                        </div>

                        <div class="form-group">
                            <label for="content-text">Editor to Design Page</label>
                            <textarea class="content-text" name="content-text"></textarea>
                        </div>
                        <input type="hidden" name="course-id" class="course-id" value="<?php echo $id; ?>">
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12">
                                <button type="submit" class="btn btn-md full-width btn-success mod-close add-course-content-submit" value="Save Content">Save Content</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>