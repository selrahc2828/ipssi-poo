<?php

namespace Ipssi\Evaluation;

use Ipssi\Evaluation\Emprunt;

class Adherent{
	private $nomAdherent;
	private $ListeEmprunt;

	//Constructeur de l'adherent, il possede un nom et une liste de tout ces emprunt.
	public function __construct(string $nomAdherent, array $ListeEmprunt){
		//On parcour la liste de ses emprunt
		foreach ($ListeEmprunt as $UnEmprunt) {
			//On test si l'emprunt actuel à été rendu
			if(!isset($UnEmprunt->getDateRenduEFF())){
				//Si ce n'est pas le cas, on test la date limite de restitution, elle ne doit pas être déjà passé
				if($UnEmprunt->getDateRenduTH() > new \DateTime()){
					//si elle l'est, on déclenche l'erreur PasEncoreRendu
					throw new PasEncoreRendu("Il faut rendre les anciens emprunt pour pouvoir emprunter à nouveau");
				}
			}
		}
		//Si aucune erreur n'est déclanché, on poursuit le constructeur
		$this->nomAdherent = $nomAdherent;
		$this->ListeEmprunt = $ListeEmprunt;
	}

	public function getNomAdherent(): string{
		return $this->nomAdherent;
	}

	public function getListeEmprunt(): array{
		return $this->ListeEmprunt;
	}

	//A chaque nouvel emprunt, on l'ajoute  à la liste d'emprunt de l'adherent
	public function AjoutEmprunt(Emprunt $Emprunt){
		array_push($this->ListeEmprunt, $Emprunt);
	}
}
