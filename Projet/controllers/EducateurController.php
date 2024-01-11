<?php

class EducateurController {
    private $educateurDAO;

    public function __construct(EducateurDAO $educateurDAO) {
        $this->educateurDAO = $educateurDAO;
    }

    public function getAllEducateurs() {
        // Récupérer tous les éducateurs
        $educateurs = $this->educateurDAO->getAll();

        // Retourner les éducateurs (peut être utilisé pour affichage, etc.)
        return $educateurs;
    }

    public function getEducateurById($id) {
        // Récupérer un éducateur par son ID
        $educateur = $this->educateurDAO->getById($id);

        // Retourner l'éducateur (peut être utilisé pour affichage, etc.)
        return $educateur;
    }

    public function saveEducateur(Educateur $educateur) {
        // Enregistrer un nouveau éducateur
        $success = $this->educateurDAO->save($educateur);

        // Retourner le succès de l'opération
        return $success;
    }

    public function updateEducateur(Educateur $educateur) {
        // Mettre à jour un éducateur existant
        $success = $this->educateurDAO->update($educateur);

        // Retourner le succès de l'opération
        return $success;
    }

    public function deleteEducateur(Educateur $educateur) {
        // Supprimer un éducateur
        $success = $this->educateurDAO->delete($educateur);

        // Retourner le succès de l'opération
        return $success;
    }
}

?>