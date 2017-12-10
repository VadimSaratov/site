<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Главная</title>
        <script src="/template/js/jquery-3.2.1.min.js"></script>
        <link href="/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="/template/css/style.css" rel="stylesheet">
    </head><!--/head-->


    <body>
        <header id="header"><!--header-->
            <div class="header-middle"><!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2">

                                <a href="/"><img src="/template/images/home/logo.png" alt="" /></a>

                        </div>
                        <div class="col-sm-10">
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li><a href="/">Главная</a></li>
                                    <li><a href="/contacts/">Контакты</a></li>
                                </ul>
                            </div>
                            <div class="pull-right">
                                <ul class="nav navbar-nav">
                                    <?php if (User::isGuest()):?>
                                    <li><a href="/login/"><i class="fa fa-lock"></i> Вход</a></li>
                                    <li><a href="/register/"><i class="fa fa-lock"></i> Регистрация</a></li>
                                    <?php else:?>
                                    <li><a href="/account/"><i class="fa fa-user"></i> Аккаунт</a></li>
                                    <li><a href="/logout/"><i class="fa fa-unlock"></i> Выход</a></li>
                                    <?php endif;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-middle-->
        </header><!--/header-->