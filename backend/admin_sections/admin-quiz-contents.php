<?php
// CRUD Operations to Quiz Contents

?>

<!-- Admin's Interface For quiz Contents -->

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
                        <h3 class="m-0"><?php $quiztitle = fetchQuizTitle($id);
                                        echo ucfirst($quiztitle) . " Questions";
                                        ?></h3>
                    </div>
                    <div class="col-sm-6">
                        <ul class="float-sm-right">
                            <li class="breadcrumb-item active"><button data-toggle="modal" data-target="#add-new-quiz-content" type="button" class="btn btn-success mb-2">Add New</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    if ($quiztitle != "Quiz Content Empty") {
        $tableTitle = encryptTitle($quiztitle);
        $row = displayQuizContent($tableTitle);
        if (is_array($row)) {
            for ($i = 0; $i < count($row); $i++) { ?>
                <div class="container">
                    <div class="row row-with-info d-flex align-items-center">
                        <div class="col-sm-8">
                            <div class="m-0" style="font-size:larger;"><?php echo $row[$i][2]; ?></div>
                        </div>

                        <div class="col-sm-4 text-right">
                            <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#update-quiz-contents-modal-<?php echo $i; ?>">Update</button>
                            <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#are-you-sure-<?php echo $i; ?>" <?php if (count($row) == 1 || (isset($_SESSION["type"]) && $_SESSION["type"] == "admin-help")) {
                                                                                                                                                    echo 'disabled';
                                                                                                                                                } ?>>Delete</button>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="update-quiz-contents-modal-<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="update-admin-details" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                        <div class="modal-content">
                            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>

                            <div class="modal-body">

                                <div class="login-form">
                                    <form method="post" class="update-quiz-content" id="update-quiz-content-<?php echo $i; ?>" enctype="multipart/form-data">

                                        <div class="alert alert-danger error" role="alert"></div>

                                        <div class="form-group row">
                                            <div class="col-md-6 offset-md-3">
                                                <label>Time Alloted</label>(In Seconds)
                                                <input type="number" class="form-control content-heading" name="quiz-time" value="<?php echo $row[$i][1]; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Question</label>
                                            <input type="text" class="form-control content-heading" name="quiz-question" placeholder="Question Here" value="<?php echo $row[$i][2]; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Options</label>
                                            <?php $options = explode(" !@#$%^&*() ", $row[$i][3]);
                                            for ($c = 1; $c <= count($options); $c++) { ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="quiz-answer" id="quiz-option-<?php echo $c; ?>" value="<?php echo $c; ?>" <?php if ($row[$i][4] == $c) {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?>>
                                                    <label class="form-check-label" style="width:100%;" for="quiz-option-<?php echo $c; ?>">
                                                        <textarea class="form-control quiz-options" name="quiz-option-<?php echo $c; ?>" placeholder="Option-<?php echo $c; ?>" ><?php echo $options[$c - 1]; ?></textarea>
                                                    </label>
                                                </div>
                                                <?php if ($c == count($options)) { ?>
                                                    <img src="assets/img/add-element.gif" width="40px" height="40px" style="cursor:pointer;margin-left:40px;" class="adding-new-option">
                                                <?php } ?>
                                            <?php } ?>
                                        </div>

                                        <input type="hidden" name="quiz-id" class="quiz-id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="q-content-id" class="content-id" value="<?php echo $row[$i][0]; ?>">
                                        <div class="row">
                                            <div class="form-group col-lg-12 col-md-12">
                                                <button type="submit" class="btn btn-md full-width btn-success mod-close update-quiz-content-submit" value="Save Changes">Save Changes</button>
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

                                <div class="modal-header-title">Remove <span style="font-weight:900;color:brown;"><?php echo $row[$i][2]; ?></span> Question from <?php echo $quiztitle; ?> Quiz</div>
                                <div class="login-form">
                                    <form id="delete-modal-form-<?php echo $i; ?>" method="post">
                                        <div class="form-group">
                                            <input type="hidden" name="q-content-id" value="<?php echo $row[$i][0]; ?>">
                                            <input type="hidden" name="quiz-id" value="<?php echo $id; ?>">
                                            <button type="button" class="btn btn-md full-width btn-danger delete-quiz-content-btn">Delete</button>
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
            <div class="alert alert-info" role="alert"><?php echo $row; ?></div>
        <?php }
        ?>



    <?php  } else { ?>
        <div class="alert alert-info" role="alert"><?php echo $quiztitle; ?></div>

    <?php }
    ?>


    <?php // displayquizContent($id); 
    ?>
<?php } else {
    include_once("views/error.php");
}
?>

<!-- Add New quiz Modal -->
<div class="modal fade" id="add-new-quiz-content" tabindex="-1" role="dialog" aria-labelledby="add-new-profile" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>

            <div class="modal-body">

                <h4 class="modal-header-title">Add quiz Content</h4>
                <div class="login-form">
                    <form method="post" class="add-quiz-content" id="add-quiz-content-<?php echo $id; ?>" enctype="multipart/form-data">

                        <div class="alert alert-danger error" role="alert"></div>

                        <div class="form-group">
                            <label>Question</label>
                            <input type="text" class="form-control" name="quiz-question" placeholder="Question Here">
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-3">
                                <label>Time Alloted</label>(In Seconds)
                                <input type="number" class="form-control" name="quiz-time">
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Options</label>
                            <!-- <input type="text" class="form-control" name="quiz-option-1" placeholder="Option-1"> -->
                            <textarea class="form-control" name="quiz-option-1" placeholder="Option-1"></textarea>
                            <img src="assets/img/add-element.gif" width="40px" height="40px" style="cursor:pointer;" class="adding-option">
                        </div>

                        <div class="form-group">
                            <label>Answer</label>
                            <select class="form-control answer-select" name="quiz-answer">
                                <option value="Answer Option Here">Answer Option Here</option>
                                <option value="1">Option 1</option>
                            </select>
                        </div>

                        <input type="hidden" name="quiz-id" class="quiz-id" value="<?php echo $id; ?>">
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12">
                                <button type="submit" class="btn btn-md full-width btn-success mod-close add-quiz-content-submit" value="Save Question">Save Question</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>