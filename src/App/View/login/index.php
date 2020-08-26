<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?=$header["title"]?></title>

    <link href="<?=STATIC_URL?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?=STATIC_URL?>css/animate.css" rel="stylesheet">
    <link href="<?=STATIC_URL?>css/style.css" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div><h1 class="logo-name">EA</h1></div>
            <h3>EngeAgro Brasil</h3>
            <p>Sistema de gerenciamento de produtos.</p>
            <?php if (isset($_SESSION["error"])) : ?>
                <div class="alert <?=$_SESSION["error"]["type"]?>">
                    <?=$_SESSION["error"]["msg"]?>
                </div>
            <?php unset($_SESSION["error"]); endif;?>
            <form method="post" class="m-t" role="form" action="<?=$action?>">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php if (isset($_SESSION["data"]["email"])) { echo $_SESSION["data"]["email"]; } ?>" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Senha" />
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Entrar</button>
            </form>
            <!--<p class="m-t"> <small>&copy; </small> </p>-->
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?=STATIC_URL?>js/jquery-1.10.2.js"></script>
    <script src="<?=STATIC_URL?>js/bootstrap.min.js"></script>
</body>
</html>
