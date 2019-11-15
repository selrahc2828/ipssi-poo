<?php

namespace Ipssi\Evaluation;

use Ipssi\Evaluation\Oeuvre;

class Emprunt{
	private $listeOeuvre;
	private $dateEmprunt;
	private $dateRenduTH;
	private $dateRenduEFF;

	//Un emprunt est constitué d'une liste d'oeuvre emprunté, d'une date d'emprunt, d'une date de rendu prévu (14 jours plus tard) et d'une date de rendu réelle (Cette derniere sert aussi a détécter si l'emprunt à été rendu ou non)
	public function __construct(
		array $listeOeuvre = array(),
		\DateTimeInterface $dateEmprunt,
		$dateRenduEFF = NULL
	){
		//On parcour la liste des oeuvres pour tester le nombre en stock de chacune
		foreach ($listeOeuvre as $uneOeuvre) {
			//ici on test si l'oeuvre est présente en stock
			if($uneOeuvre->getQuantiteOeuvre() <= 0){
				//Si ce n'est pas le cas, o déclenche l'erreur OeuvrePlusDispo
				throw new OeuvrePlusDispo('L\'oeuvre "' . $uneOeuvre->getNomOeuvre() . '" à emprunter n\'est plus disponible');
			}
		}
		foreach ($listeOeuvre as $uneOeuvre) {
			$uneOeuvre->EmpruntOeuvre();
		}
		//Dans le cas ou aucune erreur ne s'est déclenché, le constructeur se poursuit
		$this->listeOeuvre = $listeOeuvre;
		$this->dateEmprunt = $dateEmprunt;
		//Cette ligne prend automatiquement la date d'emprunt et ajoute 14 jours pour générer la date de rendu prévu
		$this->dateRenduTH = $dateEmprunt->add(new \DateInterval('P14D'));//ajout de 14 jour
		//On test si la date de rendu n'est pas avant la date d'emprunt
		if($dateRenduEFF > $dateEmprunt){
			if($dateRenduEFF != NULL) {
				foreach ($listeOeuvre as $uneOeuvre) {
					$uneOeuvre->RenduOeuvre();
				}
				$this->dateRenduEFF = $dateRenduEFF;
			}
		}else {
			//si c'est la cas, on déclenche l'erreur RenduAvantEmprunt
			throw new RenduAvantEmprunt("La date de rendu doit être posterieur à celle d'emprunt");
		}
	}

	public function getListeOeuvre(): array{
		return $this->listeOeuvre;
	}

	public function getDateEmprunt(): \DateTimeInterface{
		return $this->dateEmprunt;
	}

	public function getDateRenduTH(): \DateTimeInterface{
		return $this->dateRenduTH;
	}

	public function getDateRenduEFF(){
		return $this->dateRenduEFF;
	}

	//Fonction pour ajouter une oeuvre a la liste des oeuvre emprunté
	public function AjoutOeuvre(Oeuvre $oeuvre){
		array_push($this->listeOeuvre, $oeuvre);
	}

	//fonction pour ajouter la date de rendu de l'emprunt
	public function Rendu(\DateTimeInterface $dateRenduEFF){
		//On teste ici aussi la date de rendu
		if($dateRenduEFF > $dateEmprunt){
			foreach ($listeOeuvre as $uneOeuvre) {
				$uneOeuvre->RenduOeuvre();
			}
			$this->dateRenduEFF = $dateRenduEFF;
		}else {
			//si c'est la cas, on déclenche l'erreur RenduAvantEmprunt
			throw new RenduAvantEmprunt("La date de rendu doit être posterieur à celle d'emprunt");
		}
	}
}