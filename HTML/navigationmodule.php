<?php
    if(isset($_SESSION["userID"])){
        $navLinks = '
        <li class="nav-item">
            <a class="nav-link" href="DOMAINLOGIC/logout.dom.php">LOGOUT</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="profile.php?username='.$_SESSION["userName"].'">MY PROFILE</a>
        </li>';
    }
    else{
    $navLinks = '
    <li class="nav-item">
        <a class="nav-link" href="login.php">LOGIN</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="register.php">REGISTER</a>
    </li>';
    }
?>


<div class="jumbotron text-center" style="margin-bottom:0">
    <div class="container">
        <h1>J'aime les albums</h1>
        <p>genre beaucoup</p>
    </div>
</div>


<nav class="navbar navbar-expand-sm bg-dark navbar-dark mb-4">
    <div class="container collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <?php
                echo $navLinks;
            ?>
            <li class="nav-item">
                <a class="nav-link" href="accueil.php">ALBUMS</a>
            </li>
        </ul>
        <form method = "post" class="form-inline my-2 my-lg-0" action="search.php">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0 material-icons" type="submit">search</button>
        </form>
    </div>
</nav>
