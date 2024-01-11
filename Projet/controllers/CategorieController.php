<?php

class CategorieController {
    private $categorieDAO;

    public function __construct(CategorieDAO $categorieDAO) {
        $this->categorieDAO = $categorieDAO;
    }

    public function getAllCategories() {
        // Récupérer toutes les catégories
        $categories = $this->categorieDAO->getAll();

        // Retourner les catégories (peut être utilisé pour affichage, etc.)
        return $categories;
    }

    public function getCategoryById($id) {
        // Récupérer une catégorie par son ID
        $categorie = $this->categorieDAO->getById($id);

        // Retourner la catégorie (peut être utilisée pour affichage, etc.)
        return $categorie;
    }

    public function saveCategory(Categorie $categorie) {
        // Enregistrer une nouvelle catégorie
        $success = $this->categorieDAO->save($categorie);

        // Retourner le succès de l'opération
        return $success;
    }

    public function updateCategory(Categorie $categorie) {
        // Mettre à jour une catégorie existante
        $success = $this->categorieDAO->update($categorie);

        // Retourner le succès de l'opération
        return $success;
    }

    public function deleteCategory(Categorie $categorie) {
        // Supprimer une catégorie
        $success = $this->categorieDAO->delete($categorie);

        // Retourner le succès de l'opération
        return $success;
    }
}

?>