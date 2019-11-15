<?php

require_once('vendor/autoload.php');

use Ipssi\Evaluation\Oeuvre;
use Ipssi\Evaluation\Emprunt;
use Ipssi\Evaluation\Adherent;

$climate = new League\CLImate\CLImate;

//Création d'une liste d'oeuvre
$ListeOeuvre1 = [
	new Oeuvre("Nom Oeuvre1", 1),
	new Oeuvre("Nom Oeuvre2", 2),
	new Oeuvre("Nom Oeuvre3", 3),
	new Oeuvre("Nom Oeuvre4", 4),
	new Oeuvre("Nom Oeuvre5", 5)
];

//Création d'une liste d'oeuvre
$ListeOeuvre2 = [
	new Oeuvre("Nom Oeuvre6", 6),
	new Oeuvre("Nom Oeuvre7", 7),
	new Oeuvre("Nom Oeuvre8", 8),
	new Oeuvre("Nom Oeuvre9", 9),
	new Oeuvre("Nom Oeuvre10", 10)
];

//Création d'une liste d'oeuvre
$ListeOeuvre3 = [
	new Oeuvre("Nom Oeuvre11", 11),
	new Oeuvre("Nom Oeuvre12", 12),
	new Oeuvre("Nom Oeuvre13", 13),
	new Oeuvre("Nom Oeuvre14", 14),
	new Oeuvre("Nom Oeuvre15", 15)
];

//Création d'une liste d'emprunt avec chacun sa liste d'oeuvre
$ListeEmprunt = [
	new Emprunt($ListeOeuvre1, new \DateTime("2019-06-12"), new \DateTime("2019-06-26"), new \DateTime("2019-06-21")),
	new Emprunt($ListeOeuvre2, new \DateTime("2019-09-22"), new \DateTime("2019-10-06"), new \DateTime("2019-09-04")),
	new Emprunt($ListeOeuvre3, new \DateTime("2019-03-01"), new \DateTime("2019-03-15"))
];

//Création d'un adhérent et sa liste d'emprunt
$Adherent = new Adherent(
	"Nom Test", 
	$ListeEmprunt);



var_dump($Adherent);