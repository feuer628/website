$('document').ready(function(){

    $('input[type=file]').bootstrapFileInput();
	/*//По событие, проверяется валидность поля E-MAIL
	$('#email').blur(function() {
         if($(this).val() != '') {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            if(pattern.test($(this).val())){
                $(this).css({'border' : '1px solid #569b44'});
            } else {
                $(this).css({'border' : '1px solid #ff0000'});
                $('#valid').text('Введенный email некорректный');
            }
        } else {
            $(this).css({'border' : '1px solid #ff0000'});
            $('#valid').text('Поле email не должно быть пустым');
        }
    });*/

	//Действия при сабмите формы
    $('#resumeForm').submit(function() {
    	//Проверка на корректность загружаемого файла-резюме
    	if (checkUploadFile() != true)
    		return false;
        
    });

    //Проверка загружаемого файла
    function checkUploadFile() {
    	var imgType = Array('doc', 'docx', 'odt', 'txt', 'pdf');
        var file_text_val = $('#userfile').val();
        if (file_text_val == '') {
           alert('Выберите файл резюме!');
           return false;
        } else if (textPoz(imgType,file_text_val) != true) {
           alert('Для загрузки разрешаются только файлы с расширением doc, docx, odt, pdf и txt !');
           return false;
        } else {
           $('#submit').hide();            
           $('#res').html("Идет загрузка файла");
           return true;
        } 
    }

    //Проверить тип загружаемого файла
    function textPoz(a,b) {
         var c = b.toLowerCase();
         var ar = c.split('.')
         var e = ar[(ar.length - 1)];
         for(var i = 0; i < a.length; i++) {
            if (e == a[i]) {
                return true;
            } 
         } 
    }

    function handleResponse(mes) {
            $('#upload').show();
            if (mes.errors != null) {
                $('#res').html("Возникли ошибки во время загрузки файла: " + mes.errors);
            }    
            else {
                $('#res').html("Файл " + mes.name + " загружен");    
            }    
        }

    //Показать модальное окно, активировав плагин
	function showModal() {
        $('#modal').modal();
	}
    
});
