Необходимо создать файл send_order.php на сервере

<?php
$to = "olimp-aqua@mail.ru";
$subject = "Новый заказ с сайта Olimp-Aqua";

$firstname = htmlspecialchars($_POST['firstname']);
$lastname  = htmlspecialchars($_POST['lastname']);
$email     = htmlspecialchars($_POST['email']);
$phone     = htmlspecialchars($_POST['phone']);
$address   = htmlspecialchars($_POST['address']);
$payment   = htmlspecialchars($_POST['payment']);
$delivery  = htmlspecialchars($_POST['delivery']);
$cartData  = json_decode($_POST['cart-data'], true);

$deliveryMap = [
  "moscow" => "Москва — от 1000 ₽",
  "mo"     => "Московская область (за МКАД) — по согласованию",
  "russia" => "Россия — 1000 ₽ до ТК (Москва, СДЭК / Деловые Линии / ПЭК)",
  "pickup" => "Самовывоз — Бесплатно (41-й км МКАД, Славянский мир, пав. B6/7, В6/8)"
];
$deliveryText = $deliveryMap[$delivery] ?? "Не выбран";

$message = "
<html>
<head>
<meta charset='UTF-8'>
<style>
  body{font-family:Arial,sans-serif;color:#333}
  h2{color:#2a7ae2}
  table{border-collapse:collapse;width:100%;margin-top:10px}
  table,th,td{border:1px solid #ddd}
  th,td{padding:8px;text-align:left}
  th{background-color:#f5f5f5}
  .total{font-weight:bold;font-size:16px}
  .info{margin-bottom:15px}
</style>
</head>
<body>
  <h2>Новый заказ</h2>
  <div class='info'>
    <p><strong>Имя:</strong> $firstname</p>
    <p><strong>Фамилия:</strong> $lastname</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Телефон:</strong> $phone</p>
    <p><strong>Адрес:</strong> $address</p>
    <p><strong>Доставка:</strong> $deliveryText</p>
    <p><strong>Оплата:</strong> $payment</p>
  </div>

  <h3>Корзина:</h3>
  <table>
    <tr>
      <th>Товар / Услуга</th>
      <th>Кол-во</th>
      <th>Цена за шт.</th>
      <th>Сумма</th>
    </tr>";
$total = 0;
foreach ($cartData as $item) {
  if ($item['id'] == 999) {
    $message .= "
    <tr>
      <td>{$item['name']}</td>
      <td>{$item['qty']}</td>
      <td colspan='2'><strong>По согласованию</strong></td>
    </tr>";
  } else {
    $lineTotal = $item['qty'] * $item['price'];
    $total += $lineTotal;
    $message .= "
    <tr>
      <td>{$item['name']}</td>
      <td>{$item['qty']}</td>
      <td>{$item['price']} ₽</td>
      <td><strong>$lineTotal ₽</strong></td>
    </tr>";
  }
}
$message .= "
    <tr>
      <td colspan='3' class='total'>Итого (без учёта доставки)</td>
      <td class='total'>$total ₽</td>
    </tr>
  </table>
</body>
</html>
";

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html;charset=UTF-8\r\n";
$headers .= "From: no-reply@olimp-aqua.ru";

echo mail($to, $subject, $message, $headers) ? "success" : "error";
?>
