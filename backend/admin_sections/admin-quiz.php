<?php 
// CRUD Operations to Quizzes

?>

<section class="container" style="padding:0 7.5px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0">Quizzes</h3>
                </div>
                <div class="col-sm-6">
                    <ul class="float-sm-right">
                        <li class="breadcrumb-item active"><button data-toggle="modal" data-target="#add-new-quiz" type="button" class="btn btn-success mb-2">Add New</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">

        <!-- Admin Course Display Div   -->
        <div class="col-lg-12 col-md-10 col-sm-12">

            <!-- Course Displaying Row -->
            <div class="row">
                <?php
                // $row = fetchTags();
                $row = fetchCategories();
                if (is_array($row)) {
                    for ($i = 0; $i < count($row); $i++) {
                        $data = displayQuiz(24, $row[$i][0]);
                        if (is_array($data)) { ?>
                            <span style="margin-left:10px;font-weight:800;font-size:larger"><?php echo $row[$i][0]; ?></span>
                            <?php
                            for ($a = 0; $a < count($data); $a++) { ?>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <!-- <div class="education_block_list_layout"> -->
                                    <div class="row row-with-info">
                                        <!-- <div class="education_block_thumb n-shadow"> -->
      
                                        <!-- <div class="list_layout_ecucation_caption"> -->
                                        <div class="col-6">

                                            <!-- <div class="education_block_body"> -->
                                            <a href="?page=<?php if (isset($_SESSION["type"]) && ($_SESSION["type"] == "admin" || $_SESSION["type"] == "admin-help")) echo 'admin-quiz-contents&id=' . $data[$a][0]; ?>" style="color:#4a5682;"><?php echo $data[$a][3]; ?></a>
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
                                                    <strong class="high"><?php echo $stars; ?></strong>(<?php echo $data[$a][6]; ?> Attempts)
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-2 d-flex align-items-center">
                                            <div class="path-img">
                                                <a href="#">
                                                    <img src="assets/img/user-1.jpg" class="img-fluid" style="height:30px;width:30px;border-radius:50%;" alt=""></a>
                                                <a href="#" style="color:#4a5682;"><?php echo $data[$a][2]; ?></a>
                                            </div>
                                        </div>
                                        <div class="col-4 d-flex align-items-center">
                                            <div class="d-flex text-right justify-content-end" style="width:100%;">
                                                <a type="button" href="?page=<?php if (isset($_SESSION["type"]) && ($_SESSION["type"] == "admin" || $_SESSION["type"] == "admin-help")) echo 'admin-quiz-contents&id=' . $data[$a][0]; ?>" class="btn btn-info mb-2">Update</a>
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

                                                <div class="modal-header-title">Remove <span style="font-weight:900;color:brown;"><?php echo $data[$a][3]; ?></span> Quiz</div>
                                                <div class="login-form">
                                                    <form id="delete-quiz-form-<?php echo $data[$a][0]; ?>" method="post">

                                                        <div class="alert alert-danger error" role="alert"></div>
                                                        <div class="alert alert-success success" role="alert"></div>

                                                        <div class="form-group">
                                                            <input type="hidden" name="quiz-id" value="<?php echo $data[$a][0]; ?>">
                                                            <button type="button" class="btn btn-md full-width btn-danger delete-quiz-btn">Delete</button>
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
<div class="modal fade" id="add-new-quiz" tabindex="-1" role="dialog" aria-labelledby="add-new-quiz" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>

            <div class="modal-body">

                <h4 class="modal-header-title">Add Quiz</h4>
                <div class="login-form">
                    <form id="add-quiz" method="post" enctype="multipart/form-data">

                        <div class="alert alert-danger error" role="alert"></div>

                        <div class="form-group">
                            <label>Quiz Title</label>
                            <input type="text" class="form-control" name="quiz-title" placeholder="Quiz Title" form="add-quiz">
                        </div>
                        
                        <div class="form-group cold-md-12">
                            <label>Author Name</label>
                            <input list="authors" class="form-control" name="author-name" form="add-quiz">
                            <datalist id="authors">
                                <?php $names = fetchAllUsers();

                                if (is_array($names)) {
                                    for ($s = 0; $s < count($names); $s++) { ?>
                                        <option value="<?php echo $names[$s][0]; ?>"><?php echo $names[$s][0]; ?></option>
                                <?php  }
                                }
                                ?>
                                <!--  Options From Database of Admin Names Instructor Names User Names -->

                            </datalist>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Quiz Category</label>
                            <?php

                            $featuredcategory = fetchFeaturedCategory();
                            if (is_array($featuredcategory)) {
                                $categories = [];
                                foreach ($featuredcategory as $categoryrow) {
                                    $categories[] = $categoryrow[1];
                                }
                            ?>
                                <input list="categories" class="form-control" name="quiz-category" form="add-quiz">
                                <datalist id="categories">

                                    <?php
                                    if (is_array($categories)) {
                                        for ($t = 0; $t < count($categories); $t++) { ?>
                                            <option value="<?php echo $categories[$t]; ?>"><?php echo ucfirst($categories[$t]); ?></option>
                                <?php }
                                    }
                                }
                                ?>
                                </datalist>

                        </div>

                        <div class="form-group col-md-12">
                            <label>Quiz Tag</label>
                            <input list="quiztags" class="form-control" name="quiz-tag" form="add-quiz">
                            <datalist id="quiztags">
                                <!-- Options From Database -->
                                <?php $quiztag = fetchQTags();
                                if (is_array($quiztag)) {
                                    for ($l = 0; $l < count($quiztag); $l++) { ?>
                                        <option value="<?php echo ucfirst($quiztag[$l][0]); ?>"><?php echo ucfirst($quiztag[$l][0]); ?></option>
                                <?php  }
                                }
                                ?>

                            </datalist>
                        </div>


                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12">
                                <button type="submit" class="btn btn-md full-width btn-success mod-close" id="add-quiz-submit" value="Save Quiz">Save Quiz</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>