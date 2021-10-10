<section class="container" style="padding:0 7.5px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0">Courses</h3>
                </div>
                <div class="col-sm-6">
                    <ul class="float-sm-right">
                        <li class="breadcrumb-item active"><button data-toggle="modal" data-target="#add-new-course" type="button" class="btn btn-success mb-2">Add New</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">

        <!-- Admin Course Display Div   -->
        <div class="col-lg-12 col-md-12 col-sm-12">

            <!-- Course Displaying Row -->
            <div class="row">
                <?php
                // $row = fetchTags();
                $row = fetchCategories();
                if (is_array($row)) {
                    for ($i = 0; $i < count($row); $i++) {
                        $data = displayCourse(24, $row[$i][0]);
                        if (is_array($data)) { ?>
                            <span style="margin-left:10px;font-weight:800;font-size:larger"><?php echo $row[$i][0]; ?></span>
                            <?php
                            for ($a = 0; $a < count($data); $a++) { ?>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <!-- <div class="education_block_list_layout"> -->
                                    <div class="row row-with-info">
                                        <!-- <div class="education_block_thumb n-shadow"> -->
                                        <div class="col-sm-2 d-flex align-items-center">
                                            <a href="?page=<?php if (isset($_SESSION[" type"]) && ($_SESSION["type"] == "admin" || $_SESSION["type"] == "admin-help")) {
                                                                echo 'admin-';
                                                            }
                                                            echo 'course-contents&id=' . $data[$a][0] . '"><img src="assets/img/courses/' . encryptTitle($data[$a][2]) . '/' . $data[$a][5] . '" alt="' . $data[$a][2] . '"'; ?>" class="optimumsize"></a>
                                        </div>

                                        <!-- <div class="list_layout_ecucation_caption"> -->
                                        <div class="col-sm-4">

                                            <!-- <div class="education_block_body"> -->
                                            <a href="?page=<?php if (isset($_SESSION["type"]) && ($_SESSION["type"] == "admin" || $_SESSION["type"] == "admin-help")) echo 'admin-course-contents&id=' . $data[$a][0]; ?>" style="color:#4a5682;"><?php echo $data[$a][2]; ?></a>
                                            <div class="course_rate_system">
                                                <div class="course_ratting" style="font-size:60%;">
                                                    <?php
                                                    $stars = $data[$a][7];

                                                    $j = 0;
                                                    while ($j < 5) {
                                                        if ($stars > $j) {
                                                            echo '<i class="fa fa-star filled" style="color:gold;"></i>';
                                                            $j++;
                                                        } else {
                                                            echo '<i class="fa fa-star"></i>';
                                                            $j++;
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="course_rate_system">
                                                <div class="course_reviews_info">
                                                    <strong class="high"><?php echo $stars; ?></strong>(<?php echo $data[$a][6]; ?> Views)
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-sm-2 d-flex align-items-center">
                                            <div class="path-img">
                                                <a href="#">
                                                    <img src="assets/img/user-1.jpg" class="img-fluid" style="height:30px;width:30px;border-radius:50%;" alt=""></a>
                                                <a href="#" style="color:#4a5682;"><?php echo $data[$a][4]; ?></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 d-flex align-items-center">
                                            <div class="d-flex text-right justify-content-end" style="width:100%;">
                                                <a type="button" href="?page=<?php if (isset($_SESSION["type"]) && ($_SESSION["type"] == "admin" || $_SESSION["type"] == "admin-help")) echo 'admin-course-contents&id=' . $data[$a][0]; ?>" class="btn btn-info mb-2">Update</a>
                                                &nbsp;&nbsp;&nbsp;
                                                <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#are-you-sure-<?php echo $data[$a][0]; ?>" <?php if (isset($_SESSION["type"]) && $_SESSION["type"] == "admin-help") {
                                                                                                                                                                                    echo 'disabled';
                                                                                                                                                                                } ?>>Delete</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal fade" id="are-you-sure-<?php echo $data[$a][0]; ?>" tabindex="-1" role="dialog" aria-labelledby="are-you-sure" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                                        <div class="modal-content">
                                            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>

                                            <div class="modal-body">

                                                <div class="modal-header-title">Remove <span style="font-weight:900;color:brown;"><?php echo $data[$a][2]; ?></span></div>
                                                <div class="login-form">
                                                    <form id="delete-course-form-<?php echo $data[$a][0]; ?>" method="post">

                                                        <div class="alert alert-danger error" role="alert"></div>
                                                        <div class="alert alert-success success" role="alert"></div>

                                                        <div class="form-group">
                                                            <input type="hidden" name="course-id" value="<?php echo $data[$a][0]; ?>">
                                                            <button type="button" class="btn btn-md full-width btn-danger delete-course-btn">Delete</button>
                                                            <button type="button" class="btn btn-md full-width btn-secondary mod-close" data-dismiss="modal" aria-hidden="true" style="margin-top:3px;">Cancel</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                    <?php  }
                        }
                    }
                } else { ?>

                    <!-- In the case We Have Received Error Msg string -->
                    <div class="alert alert-warning" role="alert">
                        <?php
                        print_r($row);
                        ?>
                    </div>
                <?php
                }

                ?>
            </div>

        </div>

    </div>
</div>

<!-- Add New Course Modal -->
<div class="modal fade" id="add-new-course" tabindex="-1" role="dialog" aria-labelledby="add-new-profile" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>

            <div class="modal-body">

                <h4 class="modal-header-title">Add Course</h4>
                <div class="login-form">
                    <form id="add-course" method="post" enctype="multipart/form-data">

                        <div class="alert alert-danger error" role="alert"></div>

                        <div class="form-group">
                            <label>Course Title</label>
                            <input type="text" class="form-control" name="course-title" placeholder="Course Title" form="add-course">
                        </div>
                        <div class="form-group cold-md-12">
                            <label>Instructor Name</label>
                            <input list="instructors" class="form-control" name="instructor-name" form="add-course">
                            <datalist id="instructors">
                                <?php $names = fetchAllUsers();

                                if (is_array($names)) {
                                    for ($i = 0; $i < count($names); $i++) { ?>
                                        <option value="<?php echo $names[$i][0]; ?>"><?php echo $names[$i][0]; ?></option>
                                <?php  }
                                }
                                ?>
                                <!--  Options From Database of Admin Names Instructor Names User Names -->

                            </datalist>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Course Category</label>
                            <?php

                            $featuredcategory = fetchFeaturedCategory();
                            if (is_array($featuredcategory)) {
                                $categories = [];
                                foreach ($featuredcategory as $categoryrow) {
                                    $categories[] = $categoryrow[1];
                                }
                            ?>
                                <input list="categories" class="form-control" name="course-category" form="add-course">
                                <datalist id="categories">

                                    <?php
                                    if (is_array($categories)) {
                                        for ($i = 0; $i < count($categories); $i++) { ?>
                                            <option value="<?php echo $categories[$i]; ?>"><?php echo ucfirst($categories[$i]); ?></option>
                                <?php }
                                    }
                                }
                                ?>
                                </datalist>

                        </div>

                        <div class="form-group col-md-12">
                            <label>Course Tag</label>
                            <input list="coursetags" class="form-control" name="course-tag" form="add-course">
                            <datalist id="coursetags">
                                <!-- Options From Database -->
                                <?php $coursetag = fetchTags();
                                if (is_array($coursetag)) {
                                    for ($l = 0; $l < count($coursetag); $l++) { ?>
                                        <option value="<?php echo ucfirst($coursetag[$l][0]); ?>"><?php echo ucfirst($coursetag[$l][0]); ?></option>
                                <?php  }
                                }
                                ?>

                            </datalist>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Course Image</label>
                            <fieldset style="border:1px solid #c5c5c5; padding:3px; border-radius:5px; cursor:pointer;">
                                <input type="file" style="cursor:pointer;" class="form-control-file" name="course-image" form="add-course">
                            </fieldset>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12">
                                <button type="submit" class="btn btn-md full-width btn-success mod-close" id="add-course-submit" value="Save Course">Save Course</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>