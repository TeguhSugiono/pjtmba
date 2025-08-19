<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="custom.css">
  </head>
  <body>
    
<div class="container">
  <div class="row">
      <div class="col-md-4 col-md-offset-4">
          <div class="panel panel-default">
              <div class="panel-heading"> <strong class="">Login</strong>

              </div>
              <div class="panel-body">
                  <form class="form-horizontal" role="form">
                      <div class="form-group">
                          <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                          <div class="col-sm-9">
                              <input class="form-control" id="inputEmail3" placeholder="Email" required="" type="email">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                          <div class="col-sm-9">
                              <input class="form-control" id="inputPassword3" placeholder="Password" required="" type="password">
                          </div>
                      </div>
                      
                      <div class="form-group last">
                          <div class="col-sm-offset-3 col-sm-9">
                              <button type="submit" class="btn btn-success btn-sm">Sign in</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>

    <script src="jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
  </body>
</html>