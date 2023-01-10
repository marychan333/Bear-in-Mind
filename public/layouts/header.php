<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>To Do</title>
    <link href="public/css/bootstrap.css" rel="stylesheet">
    <link href="public/css/header.css" rel="stylesheet">
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap.js"></script>

    <style>

    </style>
</head>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Bear in Mind</a>
                <ul class="nav navbar-nav">
                    <li><a href="/todo.php">Home</a></li>
                </ul>
            </div>
            <div id="navbar" class="collapse navbar-collapse col-xs-12" style="float: right" >
                <ul class="nav navbar-nav">
                    <?php
                    if (!isset($_SESSION['user'])) {
                        ?>
                        <li><a href="#Register" data-toggle="modal" data-target="#register">Register</a></li>
                        <li><a href="#Register" data-toggle="modal" data-target="#login">Login</a></li>

                        <?php
                    } else {
                        ?>
                        <li><a href="home/Logout.php">Logout</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['user']['username'] ?> <img style="width: 25px;height: 25px;border-radius: 20px;" src="public/img/bear.png" /></a>
                            <ul class="dropdown-menu">
                                <li><a href="/myinfo.php">info</a></li>

                            </ul>
                        </li>
<!--                        <li class="active"><a href="#"><img style="width: 25px;height: 25px;border-radius: 20px;" src="public/img/bear.png" /></a></li>-->
                        <?php
                    }
                    ?>
                </ul>
            </div>


        </div>
    </div>
</nav>


</html>

