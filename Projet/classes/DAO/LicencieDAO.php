<?php

class LicencieDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    // Méthode pour enregistrer le licencie dans la base de données
    public function save(Licencie $licencie) {
        try {
            $sql = "INSERT INTO licencies (numero_licence, nom, prenom, categorie_id, contact_id) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->connexion->pdo->prepare($sql);
            $stmt->execute([$licencie->getNumeroLicence(), $licencie->getNom(), $licencie->getPrenom(), $licencie->getCategorie()->getId(), $licencie->getContact()->getId()]);
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs d'insertion ici
            return false;
        }
    }

    // Méthode pour mettre à jour le licencie dans la base de données
    public function update(Licencie $licencie) {
        try {
            $sql = "UPDATE licencies SET numero_licence = ?, nom = ?, prenom = ?, categorie_id = ?, contact_id = ? WHERE id_licencie = ?";
            $stmt = $this->connexion->pdo->prepare($sql);
            $stmt->execute([$licencie->getNumeroLicence(), $licencie->getNom(), $licencie->getPrenom(), $licencie->getCategorie()->getId(), $licencie->getContact()->getId(), $licencie->getId()]);
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs de mise à jour ici
            return false;
        }
    }

    // Méthode pour supprimer le licencie de la base de données
    public function delete(Licencie $licencie) {
        try {
            $sql = "DELETE FROM licencies WHERE id_licencie = ?";
            $stmt = $this->connexion->pdo->prepare($sql);
            $stmt->execute([$licencie->getId()]);
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs de suppression ici
            return false;
        }
    }

    // Méthode pour récupérer tous les licencies de la base de données
    public function getAll() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM licencies");
            $licencies = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Utilisez les relations pour récupérer la catégorie et le contact
                $categorieDAO = new CategorieDAO($this->connexion);
                $categorie = $categorieDAO->getById($row['categorie_id']);

                $contactDAO = new ContactDAO($this->connexion);
                $contact = $contactDAO->getById($row['contact_id']);

                $licencie = new Licencie(
                    $row['id_licencie'],
                    $row['numero_licence'],
                    $row['nom'],
                    $row['prenom'],
                    $categorie, // Utilisez l'objet Catégorie récupéré
                    $contact // Utilisez l'objet Contact récupéré
                );

                $licencies[] = $licencie;
            }

            return $licencies;
        } catch (PDOException $e) {
            // Gérer les erreurs de récupération ici
            return [];
        }
    }
    

    public function getById($id) {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM licencies WHERE id_licencie = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $licencie = new Licencie(
                    $row['id_licencie'],
                    $row['numero_licence'],
                    $row['nom'],
                    $row['prenom'],
                    $row['categorie'],
                    $row['contact']
                );
                return $licencie;
            } else {
                return null; // Ajustez le comportement en fonction de votre application
            }
        } catch (PDOException $e) {
            // Gérer les erreurs de récupération ici
            return null;
        }
    }

}

?>