<?php
    $start_page="about_company"; // начальная страница
    $path_to_files="pages/"; //путь к файлам
    //массив для меню
    $menu=array ("about_company"=>"О компании",
                 "vacancies"=>"Вакансии",
                 "teach"=>"Обучение",
                 "student_info"=>"Информация для студентов",
                 "leisure"=>"Досуг",
                 "contacts"=>"Контакты",
                 "send_resume"=>"Отправить резюме");

    //массив для файлов
    $files=array("about_company"=>"about_company.php",
        "vacancies"=>"vacancies.php",
        "teach"=>"teach.php",
        "student_info"=>"student_info.php",
        "leisure"=>"leisure.php",
        "contacts"=>"contacts.php",
        "send_resume"=>"send_resume.php", 
        "error"=>"404.php");

    // определили страницу по умолчанию или присваиваем значения $_GET['page'] 
    if (!isset($_GET['page'])) {
        $file=$start_page;
    }
    else 
        $file=$_GET['page'];

    // если не существует ключа $file значит пользыватель ошибся, определяем значения при ошибке
    if (!array_key_exists($file,$files)) {
        $file="error"; 
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My title</title>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
</head>
<body>
<div class="container contMarg50">
    <!--<h1><a href="#">Bootstrap site11</a></h1>-->

    <!-- Панель навигации -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav">
                    <?php
                        foreach ($menu as $key => $value) {
                            if ($key==$file) {
                                echo "<li class='active'><a href=''>$value</a></li>";
                            } else {
                                 echo "<li><a href=\"index.php?page=".$key."\">".$value."</a></li>";
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <div id="content">
        <? 
            include ($path_to_files.$files[$file]); 
        ?>
    </div>


    <div class="footer">
        <p>
            ИП Черемнов Константин Владимирович<br>
            +7(920)615-63-89
        </p>
    </div>
</div>
<script src="http://code.jquery-1.10.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/script.js"></script>
</body>
</html>
