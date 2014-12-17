<? 
function complete_mail() { 
        // $_POST['title'] содержит данные из поля "Тема", trim() - убираем все лишние пробелы и переносы строк, htmlspecialchars() - преобразует специальные символы в HTML сущности, будем считать для того, чтобы простейшие попытки взломать наш сайт обломались, ну и  substr($_POST['title'], 0, 1000) - урезаем текст до 1000 символов. Для переменных $_POST['mess'], $_POST['name'], $_POST['tel'], $_POST['email'] все аналогично 
        $_POST['type'] =  substr(htmlspecialchars(trim($_POST['type'])), 0, 100); 
        $_POST['name'] =  substr(htmlspecialchars(trim($_POST['name'])), 0, 50); 
        $_POST['phone'] =  substr(htmlspecialchars(trim($_POST['phone'])), 0, 18); 
        $_POST['email'] =  substr(htmlspecialchars(trim($_POST['email'])), 0, 50); 
        // если не заполнено поле "Имя" - показываем ошибку 0 
        if (empty($_POST['name'])) 
             output_err(0); 
        // если неправильно заполнено поле email - показываем ошибку 1 
        if(!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $_POST['email'])) 
             output_err(1); 
        //если не заполнено поле "вакинсия" - показываем ошибку 2 
        if(empty($_POST['type'])) 
             output_err(2); 
        $mess = ' 
<b>Имя отправителя:</b>'.$_POST['name'].'<br /> 
<b>Контактный телефон:</b>'.$_POST['phone'].'<br /> 
<b>Контактный email:</b>'.$_POST['email'].'<br /> 
<b>Выбранный тип вакансии:</b>'.$_POST['type'];

        // подключаем файл класса для отправки почты 
        require 'class.phpmailer.php'; 

        $mail = new PHPMailer(); 
        $mail->CharSet = "UTF-8";
        $mail->From = 'test@test.ru';      // от кого 
        $mail->FromName = 'www.php-mail.ru';   // от кого 
        $mail->AddAddress('to@yandex.ru', 'Имя'); // кому - адрес, Имя 
        $mail->IsHTML(true);        // выставляем формат письма HTML 
        $mail->Subject = "Резюме";  // тема письма 

        // если был файл, то прикрепляем его к письму 
        if(isset($_FILES['userfile'])) { 


                if($_FILES['userfile']['error'] == 0){ 
                   $mail->AddAttachment($_FILES['userfile']['tmp_name'], $_FILES['userfile']['name']); 
                } 
        } 

        $mail->Body = $mess; 

        // отправляем наше письмо 
        if (!$mail->Send()) die ('Mailer Error: '.$mail->ErrorInfo); 
        header("Refresh: 2; URL=http://".$_SERVER['SERVER_NAME']);
        echo 'Спасибо! Ваше письмо отправлено.'; 
} 

function output_err($num) 
{ 
    $err[0] = 'ОШИБКА! Не введено имя.'; 
    $err[1] = 'ОШИБКА! Неверно введен e-mail.';  
    $err[2] = 'ОШИБКА! Неверно указана вакансия.';
    $err[3] = 'ОШИБКА! Вы загружаете запрещенный тип файла.';
    header("Refresh: 3; URL=http://".$_SERVER['SERVER_NAME']);
    echo '<p>'.$err[$num].'</p>'; 
    exit(); 
} 

//Проверка разрешения файла
function checkFile() 
{   
     //Список разрешенных файлов
    $whitelist = array(".doc", ".docx", ".odt", ".txt", ".pdf");  
    //Проверяем разрешение файла
    foreach  ($whitelist as  $item) {
        if (preg_match("/$item\$/i",$_FILES['userfile']['name'])) {
            output_err(3); 
        } 
    }
}



if (!empty($_POST['upload'])) complete_mail(); 
else header("Refresh: 1; URL=http://".$_SERVER['SERVER_NAME']); 
?> 