<?php

  require_once 'phpMailer/class.phpmailer.php';
  
  if (!empty($_POST['nome'])  && !empty($_POST['telefono']) && !empty($_POST['richiesta']) && !empty($_POST['arrivo']) && !empty($_POST['partenza']) && !empty($_POST['targa']) ) {

	  $nome=trim(stripslashes($_POST['nome']));
	  $telefono=trim(stripslashes($_POST['telefono']));
	  $email=trim(stripslashes($_POST['email']));
	  $richiesta=trim(stripslashes($_POST['richiesta']));
	  switch ($richiesta){
		 case 1:
			$richiesta="Prenotazione parcheggio";
			break;
		 case 2:
			$richiesta="Prenotazione servizio isole";
			break;
		 case 3:
			$richiesta="Informazioni generali";
			break;
	  }
	  $arrivo=Trim(stripslashes($_POST['arrivo'])); 
	  $partenza=Trim(stripslashes($_POST['partenza'])); 
	  $targa=trim(stripslashes($_POST['targa'])); 
	  $note=trim(stripslashes($_POST['note'])); 

	  //formattazione email e invio con phpMailer
	  $msg="<html>
			   <body>
					 <strong>".$nome."</strong> ha effettuato una prenotazione sul sito.<br><br>
					 Di seguito i dati:<br><br>
					 <table border=\"1\" cellspacing=\"2\" cellpadding=\"3\">
						<tr>
							<td><strong>Telefono </strong></td>
							<td>".$telefono."</td>
						</tr>
						<tr>
							<td><strong>Email </strong></td>
							<td>".$email."</td>
						</tr>
						<tr>
							<td><strong>Richiesta </strong></td>
							<td>".$richiesta."</td>
						</tr>
						<tr>
							<td><strong>Data e ora di arrivo </strong></td>
							<td>".$arrivo."</td>
						</tr>
						<tr>
							<td><strong>Data e ora di partenza </strong></td>
							<td>".$partenza."</td>
						</tr>
						 <tr>
							<td><strong>Targa </strong></td>
							<td>".$targa."</td>
						</tr>
						<tr>
							<td><strong>Note </strong></td>
							<td>".$note."</td>
						</tr>
					 </table>
			   </body>
			</html>";
	  $mail = new PHPmailer(true);
	  $mail->IsSMTP();
	  $mail->Host="smtp.parcheggioportuense.net";
	  $mail->SMTPAuth = true;
	  $mail->Username = "info@parcheggioportuense.net";
	  $mail->Password = "2aleare6";
	  try {
		  $mail->AddReplyTo($email, $nome);
		  $mail->AddAddress('parcheggioportuense@gmail.com', '');
		  //$mail->AddAddress('sberz666@gmail.com', '');
		  $mail->From='prenotazioni@parcheggioportuense.net';
		  $mail->FromName="Prenotazione sito Parcheggio Portuense";
		  $mail->Subject="Prenotazione parcheggio";
		  $mail->MsgHTML($msg);
		  if ($mail->Send()){
			 echo "<p class='bg-success'>La sua prenotazione e' stata ricevuta. Verra' contattato a breve per la conferma. Grazie.</p>";
		  }else{
			 echo "<p class='bg-warning'>Si e' verificato un problema nell'invio della sua prenotazione. E' pregato di riporovare. Grazie.</p>";
		  }
	  } catch (phpmailerException $e) {
		  echo "<p class='bg-danger'>".$e->errorMessage()."</p>"; // eventuale errore di PHPMailer
	  } catch (Exception $e){
		  echo "<p class='bg-danger'>".$e->getMessage()."</p>"; //altro errore generico
	  }
	  unset($mail);
	}else{
		echo "<p class='bg-danger'>Compilare tutti i campi con l'asterisco.</p>";
	}

?>
