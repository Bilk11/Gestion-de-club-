<?php

class Licencie {
    public $numeroLicence;
    public $nom;
    public $prenom;
    public $contact;

    public function __construct($numeroLicence, $nom, $prenom, $contact) {
        $this->numeroLicence = $numeroLicence;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->contact = $contact;
    }

    public function getNomComplet() {
        return $this->prenom . ' ' . $this->nom;
    }
}
