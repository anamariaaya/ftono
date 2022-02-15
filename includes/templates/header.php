<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmtono</title>

    <link rel="stylesheet" href="build/css/app.css">
    <script src="https://kit.fontawesome.com/39b0748f0d.js" crossorigin="anonymous"></script>

</head>
<body>
    <header class="header">
       <div class="topbar">
        <div class="header-left">
            <a href="/">
                <img class="logo" src="build/img/logo.svg">
            </a>
            <a href="javascript: history.go(-1)">
                <i class="fas fa-arrow-left go-back <?php echo $inicio ? 'no-display' : '' ;?>"></i>
            </a>

            <div class="search-bar">
                <img class="search-btn" src="build/img/search-bar.svg">
            </div>
        </div>
 
        <div class="login-header">
            <a class="login-btn" href="/users.php">Log in</a>
            <a class="signup-btn" href="/users.php">Sign up</a>
        </div>
       </div>

       <nav class="menu">
            <a href="/">
                <img class="menu-btn <?php echo $inicio ? 'active' : '' ;?>" src="build/img/home.svg">
            </a>
            <a href="/search.php">
                <img class="menu-btn" src="build/img/search.svg">
            </a>
            <a href="">
                <img class="menu-btn" src="build/img/cart.svg">
            </a>
            <a href="">
                <img class="menu-btn" src="build/img/bell.svg">
            </a>
            <div class="dropdown-btn">
                <img class="menu-btn" id="menu-btn" src="build/img/more.svg">
            <div>
            
            <div class="menu-dropdown no-display">
                <a href="">Help</a>
                <a href="">FAQ</a>
            </div>
       </nav>
       
    </header>