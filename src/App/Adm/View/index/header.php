<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?=$title?></title>

    <link rel="stylesheet" href="<?=STATIC_URL?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=STATIC_URL?>font-awesome/css/font-awesome.css" />

    <!-- Data Tables -->
    <link rel="stylesheet" href="<?=STATIC_URL?>css/plugins/dataTables/dataTables.bootstrap.css" />

    <!-- Datepicker -->
    <link rel="stylesheet" href="<?=STATIC_URL?>css/plugins/datapicker/datepicker3.css" />

    <!-- iCheck -->
    <link rel="stylesheet" href="<?=STATIC_URL?>css/plugins/iCheck/custom.css" />

    <!-- Fancybox -->
    <link href="<?=STATIC_URL?>js/plugins/fancybox/jquery.fancybox.css" rel="stylesheet">

    <link rel="stylesheet" href="<?=STATIC_URL?>css/animate.css" />
    <link rel="stylesheet" href="<?=STATIC_URL?>css/style.css" />
    <link rel="stylesheet" href="<?=STATIC_URL?>style/main.css" />
</head>
<body>
    <!-- DIV GERAL -->
    <div id="wrapper">
        <!-- MENU LATERAL -->
        <?php if (isset($menuSide)) : ?>
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <?php foreach ($menuSide as $type => $content) : ?>
                        <?php if ($type === "header") : ?>
                            <li class="nav-header">
                                <div class="dropdown profile-element">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                        <span class="clear">
                                            <span class="block m-t-xs"><strong class="font-bold"><?=$content["user-name"]?></strong></span>
                                            <span class="text-muted text-xs block"><?=$content["user-office"]?> <b class="caret"></b></span>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                        <li><a href="<?=ADM_URL?>meu-perfil">Meu Perfil</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?=ADM_URL?>alterar-senha">Alterar Senha</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?=SITE_URL?>login/logout">Logout</a></li>
                                    </ul>
                                </div>
                                <div class="logo-element">
                                    EA
                                </div>
                            </li>
                        <?php else: ?>
                            <?php foreach ($content as $title => $subContent) : ?>
                            <li <?php if (is_array($subContent) && array_key_exists("scd-level%in", $subContent)) { echo 'class="active"'; } ?>>
                                <?php if (!is_array($subContent)) : ?>
                                    <a href="<?=$subContent?>"><i class="fa fa-th-large"></i> <span class="nav-label"><?=$title?></span> <?php if (is_array($subContent)) { echo '<span class="fa arrow"></span>'; } ?></a>
                                <?php else : ?>
                                    <a href="<?=$subContent["url"]?>"><i class="fa <?=$subContent["class-icon"]?>"></i> <span class="nav-label"><?=$title?></span> <span class="fa arrow"></span></a>
                                    <?php foreach ($subContent as $key => $value) : ?>
                                        <?php if (strstr($key, "scd-level")) : ?>
                                            <ul class="nav nav-second-level collapse <?php if (strstr($key, "%in")) { echo "in"; } ?>">
                                                <?php foreach ($value as $titleMenuScdLevel => $linkMenuScdLevel) : ?>
                                                    <li <?php if (strstr($titleMenuScdLevel, "%active")) { echo 'class="active"'; } ?>>
                                                        <a href="<?=$linkMenuScdLevel?>"><?php echo str_replace("%active", "", $titleMenuScdLevel); ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>
        <?php endif; ?>

        <!-- WRAPPER DA PÁGINA -->

        <div id="page-wrapper" class="gray-bg">

            <!-- PRIMEIRA LINHA DO CORPO -->
            <div class="row border-bottom">

                <!-- MENU TOPO -->
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <ul class="nav navbar-top-links navbar-right">
                        <?php if (isset($menuTop)) : ?>
                            <li>
                                <span class="m-r-sm text-muted welcome-message">Bem-vindo, <?=$menuTop["user-name"]?>!</span>
                            </li>
                        <?php endif;?>
                        <li>
                            <a href="<?=SITE_URL?>login/logout">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>

            <!-- FIM MENU TOPO -->
            </div>

            <!-- INICIO BREADCRUMB -->
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?=$moduleTitle?></h2>
                    <?php if (isset($breadcrumbs)) : ?>
                        <ol class="breadcrumb">
                            <?php foreach ($breadcrumbs as $bcTitle => $bcUrl) : ?>
                            <li <?php if (strstr($bcTitle, "%active")) { echo 'class="active"'; } ?>>
                                <?php if (!is_null($bcUrl)) : ?>
                                    <a href="<?=$bcUrl?>"><?=$bcTitle?></a>
                                <?php else: ?>
                                    <strong><?=str_replace("%active", "", $bcTitle)?></strong>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; ?>
                        </ol>
                    <?php endif; ?>
                </div>
            </div>

            <!-- INICIO CONTENT -->
            <div class="wrapper wrapper-content animated fadeInRight">
            