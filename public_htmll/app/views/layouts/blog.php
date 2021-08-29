<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
    <?php \fw\core\base\View::getMeta() ?>
<!--    <link href="/blog/css/bootstrap.css" rel='stylesheet' type='text/css' />-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link href="/blog/css/style.css?q=1" rel='stylesheet' type='text/css' />

    <!----webfonts---->
    <link href='https://fonts.googleapis.com/css?family=Oswald:100,400,300,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,300italic' rel='stylesheet' type='text/css'>
    <!----//webfonts---->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
    <!--end slider -->
    <!--script-->

    <!--/script-->
    <!---->

</head>
<body>
<!---header---->
<div class="header">
    <div class="container">
        <div class="logo">
            <a href="/land"><img src="/logo.svg"  style="height: 70px;margin-top: 40px;" title="" /></a>
        </div>
        <div class="top-menu">
            <div class="search">
                <form>
                    <input type="text" placeholder="">
                    <input type="submit" value=""/>
                </form>
            </div>

            <span class="menu"> </span>

        </div>
        <div class="clearfix"></div>
        <div class="top-menu2 text-center">
            <ul>
                <li <?=$this->route['action'] == 'obrnadzor' ? 'class="active"': ''?>><a href="/obrnadzor">ObrNadzor</a></li>
                <li <?=$this->route['action'] == 'minobr' ? 'class="active"': ''?>><a href="/minobr">MinObr</a></li>
                <li <?=$this->route['action'] == 'obrros' ? 'class="active"': ''?>><a href="/obrros">ObrRos</a></li>
                <li <?=$this->route['action'] == 'vk' ? 'class="active"': ''?>><a href="/vk">VK</a></li>
                <li <?=$this->route['action'] == 'vsu' ? 'class="active"': ''?>><a href="/vsu">UchProg</a></li>
                <li <?=$this->route['action'] == 'dgis' ? 'class="active"': ''?>><a href="/dgis">2GIS</a></li>
                <li <?=$this->route['action'] == 'dgisschools' ? 'class="active"': ''?>><a href="/dgisschools">2GIS.Schools</a></li>
                <li <?=$this->route['action'] == 'dgiskinders' ? 'class="active"': ''?>><a href="/dgiskinders">2GIS.Kinders</a></li>
                <li <?=$this->route['action'] == 'dgisvuz' ? 'class="active"': ''?>><a href="/dgisvuz">2GIS.University</a></li>
                <li <?=$this->route['action'] == 'dgisall' ? 'class="active"': ''?>><a href="/dgisall">2GIS.UNION</a></li>
                <div class="clearfix"> </div>
            </ul>
        </div>
    </div>
</div>
<!--/header-->
<div class="content">
    <div class="container-fluid p-0">
        <div class="content-grids">
            <div class="col-md-12 content-main">
                <div class="content-grid">

                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?=$_SESSION['error']; unset($_SESSION['error'])?>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?=$_SESSION['success']; unset($_SESSION['success'])?>
                        </div>
                    <?php endif; ?>

                    <?=$content;?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!---->
<div class="footer" style="font-size: 70%;">
    <div class="container">
<!--        <p>Copyrights © 2015 Blog All rights reserved | Template by <a href="http://w3layouts.com/">W3layouts</a></p>-->
        <div class="row">
            <div class="col-12 col-md-5 pt-4">© 2008–2021. Все права защищены. <a href="#">Государственная корпорация по атомной энергии «Росатом»</a>
                <br>
                При использовании материалов ссылка на сайт <a href="#">www.rosatom.ru</a> обязательна</div>
            <div class="col-12 col-md-3">
                <p>Следите за нами:</p>
                <a class="d-block" href="#"><img src="/images/f.svg" alt="" width="100%"></a>
            </div>
            <div class="col-12 col-md-4">
                <p>&nbsp;</p>
                <a href="#" class="mr-2"><img src="/images/i.svg" alt=""></a>
                <a href="#" class="mr-2"><img src="/images/v.svg" alt=""></a>
                <a href="#" class="mr-2"><img src="/images/fb.svg" alt=""></a>

                <a href="#"><img src="/images/fm.svg" alt=""></a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/blog/js/move-top.js"></script>
<script type="text/javascript" src="/blog/js/easing.js"></script>

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">

<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script type="text/javascript">
    $(document).ready(function($) {
        $(".scroll").click(function(event){
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
        });
    });

    $("span.menu").click(function(){
        $(".top-menu ul").slideToggle("slow" , function(){
        });
    });
</script>
<?php
foreach($scripts as $script){
    echo $script;
}
?>

<style>
    div.dataTables_wrapper div.dataTables_filter label {
        display: flex;
    }
    div.dataTables_wrapper div.dataTables_filter input {
        width: 100%;
    }
</style>
</body>
</html>