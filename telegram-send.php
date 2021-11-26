  
  //Get POST variables
  $name = isset($_POST["name"]) ? $_POST['name'] : '';
  $city = isset($_POST["city"]) ? $_POST['city'] : '';
  $spec = isset($_POST["spec"]) ? $_POST['spec'] : '';
  $email = isset($_POST["email"]) ? $_POST['email'] : '';
  $phone = isset($_POST["phone"]) ? $_POST['phone'] : '';
  $utm_source = isset($_POST["utm_source"]) ? $_POST['utm_source'] : '';
  
  $token = "";
	$chat_id = "";
          
  $tz = 'Europe/Kiev';
  $timestamp = time();
  $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
  $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
  $date = $dt->format('l jS \of F Y h:i:s A');

  setlocale(LC_TIME, 'RUS');
    
  $arr = array(
    'Заявка с сайта ' => $_SERVER['HTTP_HOST'],
    'Имя: ' => $name,
    'Город: ' => $city,
    'Специализация: ' => $spec,
    'Email: ' => $email,
    'Телефон: ' => $phone,
    'Метка: ' => $utm_source,
    'Дата и время: ' => $date,

  );
  foreach($arr as $key => $value) {
    $txt .= "<b>".$key."</b> ".$value."%0A";
  };

$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

if ($sendToTelegram) {
  return true;
} else if (!$sendToTelegram) {
  return false;
}
