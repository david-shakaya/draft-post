$subject = "тема письма"; 

$message ="Текст сообщения"; 
// текст сообщения, здесь вы можете вставлять таблицы, рисунки, заголовки, оформление цветом и т.п.

$filename = "file.doc";
// название файла

$filepath = "files/file.doc";
// месторасположение файла


//исьмо с вложением состоит из нескольких частей, которые разделяются разделителем

$boundary = "--".md5(uniqid(time())); 
// генерируем разделитель

$mailheaders = "MIME-Version: 1.0;\r\n"; 
$mailheaders .="Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n"; 
// разделитель указывается в заголовке в параметре boundary 

$mailheaders .= "From: $user_email <$user_email>\r\n"; 
$mailheaders .= "Reply-To: $user_email\r\n"; 

$multipart = "--$boundary\r\n"; 
$multipart .= "Content-Type: text/html; charset=windows-1251\r\n";
$multipart .= "Content-Transfer-Encoding: base64\r\n";    
$multipart .= \r\n;
$multipart .= chunk_split(base64_encode(iconv("utf8", "windows-1251", $message)));
// первая часть само сообщение
 
// Закачиваем файл 
	$fp = fopen($filepath,"r"); 
		if (!$fp) 
		{ 
			print "Не удается открыть файл22"; 
			exit(); 
		} 
$file = fread($fp, filesize($filepath)); 
fclose($fp); 
// чтение файла


$message_part = "\r\n--$boundary\r\n"; 
$message_part .= "Content-Type: application/octet-stream; name=\"$filename\"\r\n";  
$message_part .= "Content-Transfer-Encoding: base64\r\n"; 
$message_part .= "Content-Disposition: attachment; filename=\"$filename\"\r\n"; 
$message_part .= \r\n;
$message_part .= chunk_split(base64_encode($file));
$message_part .= "\r\n--$boundary--\r\n";
// второй частью прикрепляем файл, можно прикрепить два и более файла

$multipart .= $message_part;

mail($to,$subject,$multipart,$mailheaders);
// отправляем письмо 

//удаляем файлы через 60 сек.
if (time_nanosleep(5, 0)) {
		unlink($filepath);
}
// удаление файла





//С другого ресурса ссілка https://www.youtube.com/watch?v=gu7wjOvwFis
	
	
<meta charset="utf-8"> 
<?php
$urok="Урок 22";
error_reporting( E_ERROR );   //Отключение предупреждений и нотайсов (warning и notice) на сайте
// создание переменных из полей формы		
if (isset($_POST['name1']))			{$name1			= $_POST['name1'];		if ($name1 == '')	{unset($name1);}}
if (isset($_POST['email1']))		{$email1		= $_POST['email1'];		if ($email1 == '')	{unset($email1);}}
if (isset($_POST['text']))			{$text			= $_POST['text'];		if ($text == '')	{unset($text);}}
if (isset($_POST['sab']))			{$sab			= $_POST['sab'];		if ($sab == '')		{unset($sab);}}
//стирание треугольных скобок из полей формы
/* комментарий */
if (isset($name1) ) {
$name1=stripslashes($name1);
$name1=htmlspecialchars($name1);
}
if (isset($email1) ) {
$email1=stripslashes($email1);
$email1=htmlspecialchars($email1);
}
if (isset($text) ) {
$text=stripslashes($text);
$text=htmlspecialchars($text);
}
// адрес почты куда придет письмо
$address="24navo@gmail.com";
// текст письма 
$note_text="Тема : $urok \r\nИмя : $name1 \r\n Email : $email1 \r\n Дополнительная информация : $text";

if (isset($name1)  &&  isset ($sab) ) {
mail($address,$urok,$note_text,"Content-type:text/plain; windows-1251"); 
// сообщение после отправки формы
    
echo "<p style='color:green;'>Уважаемый(ая) <b style='color:red;'>$name1</b> Ваше письмо отправленно успешно. <br> Спасибо. <br>Вам скоро ответят на почту <b style='color:red;'> $email1</b>.</p>";
}

?>
