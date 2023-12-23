<!DOCTYPE html>

<html>
    <head>
        <title><?php include "php/titler.php"; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="expires" content="0">
        <link rel="stylesheet" href="http://showroom.zumlandwirt.biz/php/stylesheeter.php" />
        <script src="3rdparty/jquery-2.2.4.min.js"></script>
        <script src="js/navigation.js?v=2.7.5"></script>
        <script src="js/workload.js?v=2.7.5"></script>
      
    </head>
    <body onload="(new Navigation()).showHome();(new Workload()).updateWorkload();">

        <!-- include titleimage only if it is set at all -->
        <?php include "php/header.php" ?>
        
        <ul id="navigation">
            <li><a class="active" href="#home">Home</a></li>
            <li><a href="#food">Speisen</a></li>
            <li><a href="#drinks">Getränke</a></li>
            <li><a href="#news">Aktuelles</a></li>
            <?php include "php/workloadlink.php" ?>
            <li class="legal"><a href="#impressum">Impressum</a></li>
            <li class="legal"><a href="#privacy">Datenschutzhinweis</a></li>
        </ul>

        <div id="content">
            <div id="home" style="display:none;"><?php include "php/about.php"; ?></div>
            <div id="food" style="display:none;">
                <div id="foodcomment"><?php include "php/foodcomment.php"; ?></div>
                <div id="foods"><?php include "php/food.php"; ?></div>
            </div>
            <div id="drinks" style="display:none;">
                <div id="drinkscomment"><?php include "php/drinkscomment.php"; ?></div>
                <div id="drinks"><?php include "php/drinks.php"; ?></div>
            </div>
            <div id="news" style="display:none;"><?php include "php/news.php"; ?></div>
            <div id="impressum" style="display:none;"><?php include "php/impressum.php"; ?></div>
            <div id="privacy" style="display:none;"><?php include "php/privacy.php"; ?></div>
            <div id="workload" style="display:none;"><?php include "php/workload.php"; ?></div>
        </div>

        <p><hr>
        <div id="footer" style="text-align:right;padding-right:20px;font-style: italic;font-size:12px;">
            <!-- Wer OrderSprinter mag und die Arbeit des Entwicklers respektiert, der löscht diesen Footer nicht -->
            <?php include "php/branding.php"; ?>
        </div>

    </body>
</html>

