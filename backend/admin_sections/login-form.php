<body>
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row main-content bg-success text-center">
            <div class="col-md-4 text-center company__info">
                <span class="company__logo">
                    <img src="assets/img/logo_name.png" alt="IIC MSIT Name" class="img-fluid my-4">
                    <img src="assets/img/logo.png" alt="IIC MSIT LOGO" class="img-fluid my-4">
                </span>
            </div>
            <div class="col-md-8 login_form ">
                <div class="container-fluid">
                    <div class="row">
                        <h2>Admin Panel Log In</h2>
                    </div>
                    <div class="row">
                        <form class="form-group" id="login-form">
                            <div class="alert alert-warning error" type="alert"></div>
                            <div class="row">
                                <input type="text" name="username" id="username" class="form__input" placeholder="Username">
                            </div>
                            <div class="row">
                                <!-- <span class="fa fa-lock"></span> -->
                                <input type="password" name="password" id="password" class="form__input" placeholder="Password">
                            </div>
                            <div class="row">
                                <input type="submit" value="Submit" class="login-btn">
                            </div>
                        </form>
                        <button type="button" class="login-btn ml-3" data-toggle="modal" data-target="#exampleModal">
                            Forget Password ?
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="username-verification">
                        <div class="alert alert-warning warning" role="alert"></div>
                        <div class="alert alert-success success" role="alert"></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-9">
                                    <input type="text" id="username" name="username" placeholder="Username Here" class="form-control" />
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>