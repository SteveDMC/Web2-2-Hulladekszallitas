<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>MVC - PHP</title>
        <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT?>css/main_style.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
        <?php if($viewData['style']) echo '<link rel="stylesheet" type="text/css" href="'.$viewData['style'].'">'; ?>
        <?php if($viewData['js']) echo '<script src="'.$viewData['js'].'"></script>'; ?>
    </head>
    <body>
        <header>
            <div id="user"><em><?= $_SESSION['userlastname']." ".$_SESSION['userfirstname'] ?></em></div>
            <h1 class="header">Web-programozás II - MVC alkalmazás</h1>
        </header>
        <nav>
            <?php echo Menu::getMenu($viewData['selectedItems']); ?>
        </nav>
        <aside>
                <p>Phasellus wisi nulla...</p>
        </aside>
        <section>
            <?php if($viewData['render']) include($viewData['render']); ?>
        </section>
        <footer>&copy; NJE - GAMF - Informatika Tanszék <?= date("Y") ?></footer>
    </body>
</html>
