<?php
	
	$nom = "pas de nom";
	if (isset($_POST['nom']) && !empty($_POST['nom'])) {
		$nom = $_POST['nom'];
	}
	
	$email = "inconnu@no-mail.fr";
	if (isset($_POST['email']) && !empty($_POST['email']))
	{
		$email = $_POST['email'];
	}
	
	$subject = "Aucun objet";
	if (isset($_POST['subject']) && !empty($_POST['subject']))
	{
		$subject = $_POST['subject'];
    }
    
    $message = "Aucun message";
	if (isset($_POST['message']) && !empty($_POST['message']))
	{
		$message = $_POST['message'];
	}
	
	/**
		* Import des classes PHPMailer dans l’espace de nommage
		* Ces instructions doivent être placées en début de script
	*/
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'lib/PHPMailer-master/src/PHPMailer.php';
	require 'lib/PHPMailer-master/src/Exception.php';
	/**
		* Instanciation de la variable
	*/
	$mail = new PHPMailer();
	/**
		* Tentative d’envoi de mail
	*/
	try {
		// Ajout des attributs
		$mail->From = $email;
		$mail->FromName = $nom;
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->CharSet = "UTF-8";
		// Ajout des méthodes
		$mail->AddAddress("formation@cefii.fr", "Agnès");		
		$envoiOK = $mail->Send();
	}
	/**
		* Traitement de l’exception levée en cas d’erreur
	*/
	catch (Exception $e) {
		echo 'Message non envoyé';
		echo 'Erreur: ' . $mail->ErrorInfo;
	}
	
	if ($envoiOK) {
		echo "<p class='alert alert-success my-2 text-center'>Votre mail a bien été envoyé. Nous vous ferons réponse dans les meilleurs délais</p>";
	}
	else {
		echo "<p class='alert alert-danger my-2 text-center'>Problème lors de l'envoi du mail. Veuillez contacter l'administrateur du site.</p>";
	}
	
	// echo "<pre>";
    // var_dump($mail);
    

	
	
	
	
	
	
	
	
	
	
	
	
	


