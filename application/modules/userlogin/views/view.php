<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PJT.MBA</title>


        <?php 
            $this->dblogin = $this->load->database('db_login_tpp', TRUE);
            $path_assets = $this->dblogin->query("SELECT path_assets FROM tbl_m_assets")->row()->path_assets;
        ?>

        <link rel="shortcut icon" href="<?php echo site_url($path_assets) . '/img/'; ?>logo_PTMBA.png">
        <link href="<?php echo base_url($path_assets) . '/css-login/'; ?>bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url($path_assets) . '/css-login/'; ?>custom.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>


        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"> <strong class="">Login</strong>

                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" action="<?php echo $aksi; ?>" method="POST">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">User</label>
                                    <div class="col-sm-9">
                                        <input class="form-control"  name="username" placeholder="Username" required="" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="password" placeholder="Password" required="" type="password">
                                    </div>
                                </div>

                                <div class="form-group last">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-success btn-sm">Sign in</button>
                                    </div>
                                </div>

                                <div class="text-center text-error" style="color:red">
                                    <?php echo "</br>" . $error; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo base_url($path_assets) . '/css-login/'; ?>jquery.min.js"></script>
        <script src="<?php echo base_url($path_assets) . '/css-login/'; ?>bootstrap.min.js"></script>
    </body>
</html>
<?php ob_end_flush(); ?>