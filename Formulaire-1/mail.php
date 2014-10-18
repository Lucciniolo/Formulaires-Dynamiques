<?php 
require('/var/www/vhosts/default/htdocs/formulaire/PHPMailer/class.phpmailer.php');
require('/var/www/vhosts/default/htdocs/admin/bd.php');





// include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtp.reduire-sa-facture.net"; // SMTP server
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "auth.smtp.1and1.fr";      // sets the SMTP server
$mail->Port       = 587;                   // set the SMTP port f
$mail->Username   = "formulaire@reduire-sa-facture.net";  
$mail->Password   = "wish789A";            // 

//$mail->AddReplyTo("lesecoconseils@gmail.com","Les ecoconseils");


$page1 = $formValues->ecoFormPage1->ecoFormSection1;
$page2 = $formValues->ecoFormPage2->ecoFormSection2;
$page3 = $formValues->ecoFormPage3->ecoFormSection3;


$mail->Subject    = '[Ecoconseils] Nouveau formulaire rempli par ' . $page3->nom->firstName . ' ' . $page3->nom->lastName ;

$mail->Body     = 'Bonjour, Un nouveau questionnaire vient d\'etre rempli. Voici les informations saisies :  


proprietaire ? ' . $page2->proprietaire . '         

---- Les energies ----

Montant de sa facture energetique annuelle : ' . $page1->montant . ' 

Energie pour chauffage : ' . $page1->energiechauffage . '

Age du systeme de chauffage : ' . $page1->agechauffage . '

---- La maison ----

Surface habitable : ' . $page2->surface . '

Proprietaire : ' . $page2->proprietaire . '

Type de fenetre : ' . $page2->fenetre . ' 

Projet d\'agrandissement : ' . $page2->agrandissement . '

---- Coordonnees ----

nom : ' . $page3->nom->firstName . '
prenom : ' . $page3->nom->lastName . '

adresse : 
' . $page3->adresse->addressLine1 . '
' . $page3->adresse->addressLine2 . '
' . $page3->adresse->zip . ' ' . $page3->adresse->city . '
' . $page3->adresse->state . ' ' . $page3->adresse->country . '

Numero de telephone : ' . $page3->telephone . '

email : ' . $page3->email . '


';


// $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

   $requete=sprintf("select * from email where id=1");
   $result=mysql_query($requete);
   
 while ($row = mysql_fetch_assoc($result)) {
$address = $row['mail'];

}
$mail->AddAddress($address, "Reduire sa facture");
$mail->SetFrom($address, "Reduire sa facture");

// $mail->AddAttachment("images/phpmailer.gif");      // attachment
// $mail->AddAttachment("images/phpmailer_mini.gif"); // attachment


if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>