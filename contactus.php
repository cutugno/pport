<?php 
$nome = Trim(stripslashes($_POST['nome'])); 
$telefono = Trim(stripslashes($_POST['telefono'])); 
$email = Trim(stripslashes($_POST['email'])); 
$richiesta = Trim(stripslashes($_POST['richiesta'])); 
switch ($richiesta) {
	case 1:
		$richiesta="Prenotazione parcheggio";
		break;
	case 2:
		$richiesta="Prenotazione Servizio Isole";
		break;
	case 3: 
		$richiesta="Informazioni Generali";
		break;
}
$arrivo = Trim(stripslashes($_POST['arrivo'])); 
$partenza = Trim(stripslashes($_POST['partenza'])); 
$targa = Trim(stripslashes($_POST['targa'])); 
$note = Trim(stripslashes($_POST['note'])); 
 
$to = 'YOUR@EMAIL.COM';//your email address
$subject = 'the subject'; //subject email
$testo="<strong>Richiesta di prenotazione:</strong><br>
	<strong>Nome</strong>: $nome<br>
	<strong>Telefono</strong>: $telefono<br>
	<strong>Richiesta</strong>: $richiesta<br>
	<strong>Data di arrivo</strong>: $arrivo<br>
	<strong>Data di partenza</strong>: $partenza<br>
	<strong>Targa</strong>: $targa<br>
	<strong>Note</strong>: $note";
	
$headers = 'From: '.$email. "\r\n";

if (!empty($_POST['nome'])  && !empty($_POST['telefono']) && !empty($_POST['richiesta']) && !empty($_POST['arrivo']) && !empty($_POST['partenza']) && !empty($_POST['targa']) ) {
 
  // detect & prevent header injections
  $test = "/(content-type|bcc:|cc:|to:)/i";
  foreach ( $_POST as $key => $val ) {
    if ( preg_match( $test, $val ) ) {
      exit ("non ci provare");
    }
  }
  
  //send email
  echo mail($to, $subject, $testo, $headers) ? "<p class='bg-success'>La sua prenotazione è stata inviata</p>" : "<p class='bg-warning'>Il server di posta non permette l'invio di email</p>";
} else {
  echo "<p class='bg-danger'>Devi compilare tutti i campi contrassegnati con l'asterisco</p>";
}

?>
