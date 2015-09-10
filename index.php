<!DOCTYPE html>
<html class="ui-mobile">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1" >
    <title>Transport Me</title>
    <link rel="stylesheet" href="css/jquery.mobile-1.4.2.css" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" />
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>

<body>
<section class="intro">
    <div class="intro-body">
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-md-offset-2">
                    <div id="logo">
                        <h3 class="text-center" style="color: #000000;">
                            Welcome to Transport Me!</h3>
                        <br /><br />
                        <img alt="140x140" src="img/logo.png" class="img-rounded">
                    </div>
                    <form id="logins" method='POST' action='check.php'>
                        <div class="form-group col-lg-12">
                            <input type="email" class="form-control input-control" placeholder="Email" id="inputEmail3" name="username">
                        </div>
                        <div class="form-group col-lg-12">
                            <input type="password" class="form-control" placeholder="Password" id="inputPassword3" name="password">
                        </div>
                        <div class="form-group col-md-6 col-md-offset-3">
                            <input type = "submit" class="btn btn-success btn_login" value = "Sign in" name = "submit" id = "log">
                        </div>
                    </form>
                    <div class="form-group col-md-6 col-md-offset-3">
                        <input type="button" class="btn btn-success btn_reg" value="Sign Up" onClick = "parent.location='register.php'" >
                    </div>
                    <br />
                    <div class="form-group col-md-6 col-md-offset-3">
                        <img src="img/fb_login.png" height="29px"/>
                        <img src="img/gplus_signin.png" height="29px"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
