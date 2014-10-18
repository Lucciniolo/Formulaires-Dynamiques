<?php

// unclue le framework PHP
if(file_exists('../php/JFormer.php')) {
    require_once('../php/JFormer.php');
}
else if(file_exists('../../php/JFormer.php')) {
    require_once('../../php/JFormer.php');
}



// On crée un objet jFormer, qui est le formulaire
$jFormer = new JFormer('ecoForm', array(
    'title' => '<h2>Un expert vous rappellera gratuitement pour vous donner des conseils afin de réduire votre consommation d’énergie</h2>',
    'submitButtonText' => 'Soumettre',
    'submitProcessingButtonText' => 'En cours ...',
    'pageNavigator' => array(
        'label' => 'prefixLabels',
    ),
));

// Creation de la première page, les energies
$jFormPage1 = new JFormPage($jFormer->id.'Page1', array('title' => '<h3>Les énergies</h3>'));

$jFormSection1 = new JFormSection($jFormer->id.'Section1');
$jFormSection1->addJFormComponentArray(array(new JFormComponentSingleLineText('montant', 'Quel est le montant de votre facture énergétique annuelle ?', array('validationOptions' => array('required'))),));


$jFormSection1->addJFormComponentArray(array(
    new JFormComponentMultipleChoice('energiechauffage', 'Au moyen de quelle énergie vous chauffez vous ?',
        array(
            array('label' => 'électricité', 'value' => 'electricite'),
            array('label' => 'gaz propane', 'value' => 'gaz propane'),
            array('label' => 'fioul', 'value' => 'fioul'),
            array('label' => 'gaz de ville', 'value' => 'gaz de ville'),
            array('label' => 'bois', 'value' => 'bois')            
        ),
        array(
            'multipleChoiceType' => 'radio',
        )
    ),
));
$jFormSection1->addJFormComponentArray(array(
   new JFormComponentDropDown('agechauffage', 'Quel est l’âge de votre système de chauffage ?',
    array(
        array(
            'value' => '',
            'label' => ' - Choisir un âge - ',
            'disabled' => true,
            'selected' => true
        ),
        array(
            'value' => 'moins de 5 ans',
            'label' => 'moins de 5 ans'
        ),
        array(
            'value' => 'de 5 ans a 15 ans',
            'label' => 'de 5 ans à 15 ans'
        ),
        array(
            'value' => 'plus de 15 ans',
            'label' => 'plus de 15 ans'
        ),
    ),
    array(
        'tip' => '<p>Le chauffage représente une grosse part des dépenses en énergies.</p>',
    )
   )
));


$jFormSectionImg1 = new JFormSection($jFormer->id.'SectionImg1');
$jFormSectionImg1-> addJFormComponentArray(array(
		new JFormComponentHtml('

  <img src="../../../images/ampoule.jpg" / class="img-mod"> 
  <h6>Utiliser des ampoules basse consommation </h6> 
  <p> Cela a diminué de 10 % ma facture d"éléctricité.</p>
'
           )
));

$jFormer->addJFormPage($jFormPage1->addJFormSection($jFormSection1));
$jFormPage1->addJFormSection($jFormSectionImg1);


// Create the second page
$jFormPage2 = new JFormPage($jFormer->id.'Page2', array('title' => '<h3>La maison</h3>'));
$jFormSection2 = new JFormSection($jFormer->id.'Section2');
$jFormSection2->addJFormComponentArray(array(new JFormComponentSingleLineText('surface', 'Quelle est la surface habitable ?', array()),));

$jFormSection2->addJFormComponentArray(array(
    new JFormComponentMultipleChoice('proprietaire', 'êtes vous propriétaire de votre habitation ?',
        array(
            array('label' => 'Je suis propriétaire.', 'value' => 'Oui'),
            array('label' => 'Je suis locataire.', 'value' => 'Non'),
        ),
        array(
	        'validationOptions' => array('required'),
	        'multipleChoiceType' => 'radio',
        )
    ),
    new JFormComponentMultipleChoice('fenetre', 'Quel type de fenêtre possédez-vous ?',
        array(
            array('label' => 'Simple vitrage', 'value' => 'Simple vitrage'),
            array('label' => 'Double vitrage', 'value' => 'Double vitrage'),
            array('label' => 'Triple vitrage', 'value' => 'Triple vitrage'),
        ),
        array(
            'multipleChoiceType' => 'radio',
        )
    ),
));

$jFormSection2->addJFormComponentArray(array(
    new JFormComponentMultipleChoice('agrandissement', 'Avez-vous un projet d’agrandissement ?',
        array(
            array('label' => 'Oui', 'value' => 'Oui'),
            array('label' => 'Non', 'value' => 'Non'),
            array('label' => 'Je ne sais pas.', 'value' => 'Non'),
        ),
        array(
	     //   'validationOptions' => array('required'),
	        'multipleChoiceType' => 'radio',
        )
    ),
));

$jFormSectionImg2 = new JFormSection($jFormer->id.'SectionImg2');
$jFormSectionImg2-> addJFormComponentArray(array(
		new JFormComponentHtml('

  <img src="../../../images/ampoule.jpg" / class="img-mod"> 
  <h6>Utiliser des ampoules basse consommation </h6> 
  <p> Cela a diminué de 10 % ma facture d"éléctricité.</p>
'
           )
));
                                      
$jFormer->addJFormPage($jFormPage2->addJFormSection($jFormSection2));
$jFormPage2->addJFormSection($jFormSectionImg2);


// Create the third page
$jFormPage3 = new JFormPage($jFormer->id.'Page3', array('title' => '<h3>Coordonnées</h3>'));
$jFormSection3 = new JFormSection($jFormer->id.'Section3');

$jFormSection3->addJFormComponentArray(array(
	new JFormComponentName('nom', 'Vos nom et prénom :', array('middleInitialHidden' => true,'validationOptions' => array('required') ))
));

$jFormSection3->addJFormComponentArray(array(
    new JFormComponentAddress('adresse', 'Merci de saisir votre adresse :', array('selectedCountry' => 'FR', 'validationOptions' => array('required'))) 
));
$jFormSection3->addJFormComponentArray(array(
    new JFormComponentSingleLineText('telephone', 'Votre numéro de téléphone', array('validationOptions' => array('phone', 'required'),)),
));

$jFormSection3->addJFormComponentArray(array(
	new JFormComponentSingleLineText('email', 'Votre email', array('validationOptions' => array('email', 'required'), )),
));

$jFormSectionImg3 = new JFormSection($jFormer->id.'SectionImg3');
$jFormSectionImg3-> addJFormComponentArray(array(
		new JFormComponentHtml('

  <img src="../../../images/ampoule.jpg" / class="img-mod"> 
  <h6>Utiliser des ampoules basse consommation </h6> 
  <p> Cela a diminué de 10 % ma facture d"éléctricité.</p>
'
           )
));


$jFormer->addJFormPage($jFormPage3->addJFormSection($jFormSection3));
$jFormPage3->addJFormSection($jFormSectionImg3);

	 
//= "Test";

// Declare the function to handle the form submission
function onSubmit($formValues) {
    $response = array(
        'successJs' => '
            ecoFormObject.setupControl();
        ',
       'successPageHtml' => ' <h2>  Merci d\'avoir rempli notre formulaire.</h2>
       <p> Un conseiller vous contactera dans les plus brefs délais.</p>', // Tabneau contenant les valeurs serialisées
    );
    
 include '/var/www/vhosts/default/htdocs/formulaire/1/mail.php';
	
	    
	    
	    
	     return $response;
}
// Handle any request that comes to the form
$jFormer->processRequest();



?>
