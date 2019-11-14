<?php

require_once('vendor/autoload.php');

$climate = new League\CLImate\CLImate;

class Diviseur {
    public function division(int $index, int $diviseur)
    {
        $valeurs = [17, 12, 15, 38, 29, 157, 89, -22, 0, 5];

        return $valeurs[$index] / $diviseur;
    }
}

$input = $climate->input("Entrez l’indice de l’entier à diviser : ");
$index = $input->prompt();

$input = $climate->input("Entrez le diviseur : ");
$diviseur = $input->prompt();

$climate->output("Le résultat de la division est : " . (new Diviseur())->division($index, $diviseur));

