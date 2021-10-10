<section class="container" style="padding:0 7.5px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0">Careers</h3>
                </div>
                <div class="col-sm-6">
                    <ul class="float-sm-right">
                        <li class="breadcrumb-item active"><button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#add-new-career-option">Add New</button></li>
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
                $row = fetchCompany();
                if (is_array($row)) {
                    for ($i = 0; $i < count($row); $i++) {
                        $data = displayCareer(24, $row[$i][0]);
                        if (is_array($data)) { ?>
                            <span style="margin-left:10px;font-weight:800;font-size:larger"><?php echo $row[$i][0]; ?></span>
                            <?php
                            for ($a = 0; $a < count($data); $a++) { ?>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <!-- <div class="education_block_list_layout"> -->
                                    <div class="row row-with-info">
                                        <!-- <div class="education_block_thumb n-shadow"> -->
                                        <div class="col-sm-5 align-items-center">
                                            <div style="font-weight:900; font-size:larger;"><?php echo $data[$a][5]; ?></div>
                                            <div style="font-weight:600; font-size:medium;"><?php echo $data[$a][6]; ?></div>
                                            <p>Apply By : <?php echo $data[$a][10]; ?></p>
                                        </div>

                                        <!-- <div class="list_layout_ecucation_caption"> -->
                                        <div class="col-sm-3 d-flex align-items-center">
                                            <div><a href="<?php echo $data[$a][4]; ?>" style="font-weight:500; font-size:large; color:crimson"><?php echo $data[$a][2]; ?></a></div>
                                        </div>

                                        <div class="col-sm-4 d-flex align-items-center">
                                            <div class="d-flex text-right justify-content-end" style="width:100%;">
                                                <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#update-career-details-<?php echo $a; ?>" <?php if (isset($_SESSION["type"]) && $_SESSION["type"] == "admin-help") {
                                                                                                                                                                                echo 'disabled';
                                                                                                                                                                            } ?>>Update</button>
                                                &nbsp;&nbsp;&nbsp;
                                                <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#are-you-sure-<?php echo $data[$a][0]; ?>" <?php if (isset($_SESSION["type"]) && $_SESSION["type"] == "admin-help") {
                                                                                                                                                                                    echo 'disabled';
                                                                                                                                                                                } ?>>Delete</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!--=============== Updating Modal ==================-->
                                <div class="modal fade" id="update-career-details-<?php echo $a; ?>" tabindex="-1" role="dialog" aria-labelledby="update-header-menu" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                                        <div class="modal-content">
                                            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>

                                            <div class="modal-body">

                                                <div class="modal-header-title"><?php echo $data[$a][5]; ?></div>
                                                <div class="login-form">
                                                    <form id="update-header-form-<?php echo $a; ?>" method="post">

                                                        <div class="alert alert-danger error" role="alert"></div>
                                                        <div class="alert alert-success success" role="alert"></div>

                                                        <div class="form-group">
                                                            <label>About Company</label>
                                                            <input type="text" class="form-control" placeholder="Comapny Name" name="company-name" value="<?php echo $data[$a][2]; ?>">
                                                            <textarea class="form-control quiz-options" placeholder="Comapny Description" name="company-description"><?php echo $data[$a][3]; ?></textarea>
                                                            <input type="url" class="form-control" placeholder="Comapany Website" name="company-url" value="<?php echo $data[$a][4]; ?>">
                                                            <input type="email" class="form-control" placeholder="Comapany Email" name="company-email" value="<?php echo $data[$a][12]; ?>">
                                                        </div>


                                                        <div class="form-group">
                                                            <label>About Job</label>
                                                            <?php

                                                            $jobTitles = fetchJobTitle();
                                                            if (is_array($jobTitles)) {
                                                                $titles = [];
                                                                foreach ($jobTitles as $titlerow) {
                                                                    $titles[] = $titlerow[0];
                                                                }
                                                            ?>
                                                                <input list="job-titles" class="form-control" placeholder="Job Title" name="job-title" value="<?php echo $data[$a][5]; ?>">
                                                                <datalist id="job-titles">

                                                                    <?php
                                                                    if (is_array($titles)) {
                                                                        for ($h = 0; $h < count($titles); $h++) { ?>
                                                                            <option value="<?php echo $titles[$h]; ?>"><?php echo ucfirst($titles[$h]); ?></option>
                                                                    <?php }
                                                                    } ?>
                                                                </datalist>
                                                            <?php

                                                            } else { ?>
                                                                <input type="text" class="form-control" placeholder="Job Title" name="job-title" value="<?php echo $data[$a][5]; ?>">
                                                            <?php                            }
                                                            ?>
                                                            <?php

                                                            $jobTypes = fetchJobType();
                                                            if (is_array($jobTypes)) {
                                                                $types = [];
                                                                foreach ($jobTypes as $jobrow) {
                                                                    $types[] = $jobrow[0];
                                                                }
                                                            ?>
                                                                <input list="job-types" class="form-control" name="job-type" placeholder="Job Type" value="<?php echo $data[$a][6]; ?>">
                                                                <datalist id="job-types">

                                                                    <?php
                                                                    if (is_array($types)) {
                                                                        for ($e = 0; $e < count($types); $e++) { ?>
                                                                            <option value="<?php echo $types[$e]; ?>"><?php echo ucfirst($types[$e]); ?></option>
                                                                    <?php }
                                                                    } ?>
                                                                </datalist>
                                                            <?php
                                                            } else { ?>
                                                                <input type="text" class="form-control" placeholder="Job Type" name="job-type" value="<?php echo $data[$a][6]; ?>">
                                                            <?php  }
                                                            ?>


                                                            <?php $descriptions = explode(" !@#$%^&*() ", $data[$a][7]);
                                                            for ($c = 1; $c <= count($descriptions); $c++) { ?>
                                                                <textarea class="form-control quiz-options" name="job-description-<?php echo $c; ?>" placeholder="Job-Description-<?php echo $c; ?>"><?php echo $descriptions[$c - 1]; ?></textarea>
                                                                <?php if ($c == count($descriptions)) { ?>
                                                                    <img src="assets/img/add-element.gif" width="40px" height="40px" style="cursor:pointer;margin-left:40px;" class="adding-new-job-description">
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Price Range &#8377;</label>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="number" min="0" class="form-control" placeholder="Minimum Pay" name="pay-min" value="<?php echo $data[$a][8]; ?>">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="number" min="0" class="form-control" placeholder="Maximum Pay" name="pay-max" value="<?php echo $data[$a][9]; ?>">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Apply By</label>
                                                            <input type="date" name="apply-by" class="form-control" placeholder="To be Applied By?" value="<?php echo $data[$a][10]; ?>">
                                                        </div>

                                                        <input type="hidden" name="career-id" value="<?php echo $data[$a][0]; ?>">

                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-md full-width btn-success update-career-submit">Save Changes</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Deleting Modal -->
                                <div class="modal fade" id="are-you-sure-<?php echo $data[$a][0]; ?>" tabindex="-1" role="dialog" aria-labelledby="are-you-sure" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                                        <div class="modal-content">
                                            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>

                                            <div class="modal-body">

                                                <div class="modal-header-title">Remove <span style="font-weight:900;color:brown;"><?php echo $data[$a][5]; ?></span> Job</div>
                                                <div class="login-form">
                                                    <form id="delete-course-form-<?php echo $data[$a][0]; ?>" method="post">

                                                        <div class="alert alert-danger error" role="alert"></div>
                                                        <div class="alert alert-success success" role="alert"></div>

                                                        <div class="form-group">    
                                                            <input type="hidden" name="career-id" value="<?php echo $data[$a][0]; ?>">
                                                            <button type="button" class="btn btn-md full-width btn-danger delete-career-btn">Delete</button>
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


<!-- Adding New Page Modal -->
<div class="modal fade" id="add-new-career-option" tabindex="-1" role="dialog" aria-labelledby="add-new-profile" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="sign-up">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>

            <div class="modal-body">

                <h4 class="modal-header-title">Add Career</h4>
                <div class="login-form">
                    <form id="add-new-career-form" method="post" enctype="multipart/form-data">

                        <div class="alert alert-danger error" role="alert"></div>

                        <div class="form-group">
                            <label>About Company</label>
                            <input type="text" class="form-control" placeholder="Comapny Name" name="company-name">
                            <textarea class="form-control quiz-options" placeholder="Comapny Description" name="company-description"></textarea>
                            <input type="url" class="form-control" placeholder="Comapany Website" name="company-url">
                            <input type="email" class="form-control" placeholder="Comapany Email" name="company-email">
                        </div>


                        <div class="form-group">
                            <label>About Job</label>
                            <?php

                            $jobTitles = fetchJobTitle();
                            if (is_array($jobTitles)) {
                                $titles = [];
                                foreach ($jobTitles as $titlerow) {
                                    $titles[] = $titlerow[0];
                                }
                            ?>
                                <input list="job-titles" class="form-control" placeholder="Job Title" name="job-title">
                                <datalist id="job-titles">

                                    <?php
                                    if (is_array($titles)) {
                                        for ($g = 0; $g < count($titles); $g++) { ?>
                                            <option value="<?php echo $titles[$g]; ?>"><?php echo ucfirst($titles[$g]); ?></option>
                                    <?php }
                                    } ?>
                                </datalist>
                            <?php

                            } else { ?>
                                <input type="text" class="form-control" placeholder="Job Title" name="job-title">
                            <?php                            }
                            ?>
                            <?php

                            $jobTypes = fetchJobType();
                            if (is_array($jobTypes)) {
                                $types = [];
                                foreach ($jobTypes as $jobrow) {
                                    $types[] = $jobrow[0];
                                }
                            ?>
                                <input list="job-types" class="form-control" name="job-type" placeholder="Job Type">
                                <datalist id="job-types">

                                    <?php
                                    if (is_array($types)) {
                                        for ($e = 0; $e < count($types); $e++) { ?>
                                            <option value="<?php echo $types[$e]; ?>"><?php echo ucfirst($types[$e]); ?></option>
                                    <?php }
                                    } ?>
                                </datalist>
                            <?php
                            } else { ?>
                                <input type="text" class="form-control" placeholder="Job Type" name="job-type">
                            <?php  }
                            ?>

                            <textarea class="form-control quiz-options" name="job-description-1" placeholder="You can Add Job Roles Here"></textarea>
                            <img src="assets/img/add-element.gif" width="40px" height="40px" style="cursor:pointer;" class="adding-job-description">
                        </div>

                        <div class="form-group">
                            <label>Price Range &#8377;</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="number" min="0" class="form-control" placeholder="Minimum Pay" name="pay-min">
                                </div>
                                <div class="col-md-6">
                                    <input type="number" min="0" class="form-control" placeholder="Maximum Pay" name="pay-max">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Apply By</label>
                            <input type="date" name="apply-by" class="form-control" placeholder="To be Applied By?">
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