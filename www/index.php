<?php
    $start_page="about_company"; // начальная страница
    $path_to_files="pages/"; //путь к файлам
    //массив для меню
    $menu=array ("about_company"=>"О компании",
                 "vacancies"=>"Вакансии",
                 "careers"=>"Карьерный рост",
                 "student_info"=>"Информация для студентов",
                 "leisure"=>"Досуг",
                 "contacts"=>"Контакты");

    //массив для файлов
    $files=array("about_company"=>"about_company.php",
        "vacancies"=>"vacancies.php",
        "careers"=>"careers.php",
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
    <title>ИП Черемнов</title>
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/jquery.maskedinput.js"></script>
    <script src="js/check_phone.js"></script>
    <script src="js/is.mobile.js"></script>
    <script src="js/bootstrap.file-input.js"></script>
</head>
<body>
<div class="container contentPrepare">

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
                        <li><a href="#modal" onclick="showModal()" role="link" class="link" data-toggle="modal">Отправить резюме</a></li>
                    </ul>
                </div>
            </div>
        </div>

    <div id="content">
        <? 
            include ($path_to_files.$files[$file]); 
        ?>
    </div>

    <div id="modal" class="modal hide fade width800">
            <form action="scripts/upload.php" class="sendResume" name="sendResume" id="resumeForm" method="post" enctype="multipart/form-data">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    				<h2>Отправить резюме</h2>
    			</div>
    		<div class="modal-body">
    				<table>
    					<tr>
    						<td>
    							<div class="width380">
    								<label class="label" for="name">
    					        		Ваше имя и фамилия<sup>*</sup>
    					      		</label>
    					      		<br>
    					      		<input type="text" name="name" class="input-xlarge width350" required="required">
    					      		<br>

    						      	<label class="label" for="phone">
    					        		Контактный телефон
    					      		</label>
    					      		<br>
    					      		<input type="text" name="phone" pattern="[0-9_-]{10}" class="input-xlarge width350" placeholder="+7 (___) ___ __ __" id="user_phone" title="Формат:+7 (096) 999 99 99" />
    					      		<br>
    							</div>
    						</td>
    						<td>
    							<div class="width380">
    						      	<label class="label" for="email">
    						        	Ваш E-mail  <sup>*</sup>
    						      	</label>
    						      	<br>
    						      	<input type="email" id="email" name="email" class="input-xlarge width350" required="required">
    						      	<span id="valid"></span>
    						      	<br>

    						      	<label class="label" for="type">
    						        	Категория вакансии
    						      	</label>
    						      	<br>
    						      	<select  class="selectpicker select-xlarge" style="width: 380px;" name="type">
    									<option>Младший JAVA разработчик</option>
    									<option>Старший JAVA разработчик</option>
    									<option>БОГ</option>
    								</select>
    								<br>
    							</div>
    						</td>
    					</tr>
                        <tr>
                            <td>
                                <label class="label" for="userfile">
                                    Прикрепите файл с Вашим резюме
                                </label>
                                <br>
                                <input type="file" title="Прикрепить резюме" data-filename-placement="inside" id="userfile" name="userfile" />
                            </td>
                        </tr>
    				</table>
    		    <div id="res"></div>
    		</div>
    		<div class="modal-footer">
                <p>
                    <span>
                        <sup>*</sup>
                        Поля, обязательные для заполнения
                    </span>
                </p>

         		<input class="btn btn-success" name="upload" id="submit" type="submit" value="Отправить">
      		</div>

      		</form>
    </div>

    <div class="footer">
        <div class="divLeft">
            Адрес: Калуга, ул. Гагарина, д. 4, офис 513<br>
            E-mail: cheremnov-kaluga.ru
        </div>
        <div class="divRight">
            ИП Черемнов Константин Владимирович<br>
            +7(920)615-63-89
        </div>
    </div>
</div>
</body>
</html>
