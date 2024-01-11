<?php

// LicencieController.php
class LicencieController {
    private $licencieDAO;

    public function __construct(LicencieDAO $licencieDAO) {
        $this->licencieDAO = $licencieDAO;
    }

    public function getAllLicencies() {
        // Récupérer tous les licenciés
        $licencies = $this->licencieDAO->getAll();

        // Retourner les licenciés (peut être utilisé pour affichage, etc.)
        return $licencies;
    }

    public function getLicencieById($id) {
        // Récupérer un licencié par son ID
        $licencie = $this->licencieDAO->getById($id);

        // Retourner le licencié (peut être utilisé pour affichage, etc.)
        return $licencie;
    }

    public function saveLicencie(Licencie $licencie) {
        // Enregistrer un nouveau licencié
        $success = $this->licencieDAO->save($licencie);

        // Retourner le succès de l'opération
        return $success;
    }

    public function updateLicencie(Licencie $licencie) {
        // Mettre à jour un licencié existant
        $success = $this->licencieDAO->update($licencie);

        // Retourner le succès de l'opération
        return $success;
    }

    public function deleteLicencie(Licencie $licencie) {
        // Supprimer un licencié
        $success = $this->licencieDAO->delete($licencie);

        // Retourner le succès de l'opération
        return $success;
    }
}
?>