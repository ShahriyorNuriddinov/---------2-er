<?php
$to = "olimp-aqua@mail.ru";
$subject = "Заявка на обратный звонок";

$phone = htmlspecialchars($_POST['callback_phone']);

$message = "
<html>
<head><meta charset='UTF-8'></head>
<body>
  <h2>Запрос звонка</h2>
  <p><strong>Телефон:</strong> $phone</p>
</body>
</html>
";

$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: no-reply@olimp-aqua.ru";

if (mail($to, $subject, $message, $headers)) {
    echo "success";
} else {
    echo "error";
}
?>
