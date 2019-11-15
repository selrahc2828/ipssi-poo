<?php

namespace Ipssi\Evaluation;

class Oeuvre{
	private $NomOeuvre;
	private $QuantiteOeuvre;

	//Une oeuvre possede un nom et une quantité en stock
	public function __construct(string $NomOeuvre, int $QuantiteOeuvre){
		$this->NomOeuvre = $NomOeuvre;
		$this->QuantiteOeuvre = $QuantiteOeuvre;
	}

	//Lorsqu'une oeuvre est emprunté, son nombre en stock diminue de 1
	public function EmpruntOeuvre(){
		$nb_Oeuvre_Avant_Emprunt = $this->QuantiteOeuvre;
		$this->QuantiteOeuvre = $nb_Oeuvre_Avant_Emprunt-1;
	}

	//Lorsqu'une oeuvre est rendu, son nombre en stock augmente de 1
	public function RenduOeuvre(){
		$nb_Oeuvre_Avant_Rendu = $this->QuantiteOeuvre;
		$this->QuantiteOeuvre = $nb_Oeuvre_Avant_Rendu+1;
	}

	public function getNomOeuvre(): string{
		return $this->NomOeuvre;
	}

	public function getQuantiteOeuvre(): int{
		return $this->QuantiteOeuvre;
	}
}