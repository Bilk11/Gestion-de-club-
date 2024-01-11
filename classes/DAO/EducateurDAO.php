<?php

class EducateurDAO {
    private $connexion;
    private $categorieDAO;
    private $contactDAO;

    public function __construct(Connexion $connexion, CategorieDAO $categorieDAO, ContactDAO $contactDAO) {
        $this->connexion = $connexion;
        $this->categorieDAO = $categorieDAO;
        $this->contactDAO = $contactDAO;
    }

    public function save(Educateur $educateur) {
        try {
            $sql = "INSERT INTO educateurs (numero_licence, nom, prenom, categorie_id, contact_id, email, mot_de_passe, is_admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connexion->pdo->prepare($sql);
            $stmt->execute([
                $educateur->getNumeroLicence(),
                $educateur->getNom(),
                $educateur->getPrenom(),
                $educateur->getCategorie()->getId(),
                $educateur->getContact()->getId(),
                $educateur->getEmail(),
                $educateur->getMotDePasse(),
                $educateur->isAdmin() ? 1 : 0
            ]);
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs d'insertion ici
            return false;
        }
    }

    public function update(Educateur $educateur) {
        try {
            $sql = "UPDATE educateurs SET numero_licence = ?, nom = ?, prenom = ?, categorie_id = ?, contact_id = ?, email = ?, mot_de_passe = ?, is_admin = ? WHERE id_educateur = ?";
            $stmt = $this->connexion->pdo->prepare($sql);
            $stmt->execute([
                $educateur->getNumeroLicence(),
                $educateur->getNom(),
                $educateur->getPrenom(),
                $educateur->getCategorie()->getId(),
                $educateur->getContact()->getId(),
                $educateur->getEmail(),
                $educateur->getMotDePasse(),
                $educateur->isAdmin() ? 1 : 0,
                $educateur->getId()
            ]);
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs de mise à jour ici
            return false;
        }
    }

    public function delete(Educateur $educateur) {
        try {
            $sql = "DELETE FROM educateurs WHERE id_educateur = ?";
            $stmt = $this->connexion->pdo->prepare($sql);
            $stmt->execute([$educateur->getId()]);
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs de suppression ici
            return false;
        }
    }

    public function getAll() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM educateurs");
            $educateurs = [];

            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $educateur = new Educateur(
                        $row['id_educateur'],
                        $row['numero_licence'],
                        $row['nom'],
                        $row['prenom'],
                        $this->categorieDAO->getById($row['categorie_id']),
                        $this->contactDAO->getById($row['contact_id']),
                        $row['email'],
                        $row['mot_de_passe'],
                        $row['is_admin'] == 1
                    );

                    $educateurs[] = $educateur;
                }
            }

            return $educateurs;
        } catch (PDOException $e) {
            // Gérer les erreurs de récupération ici
            return [];
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM educateurs WHERE id_educateur = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $educateur = new Educateur(
                    $row['id_educateur'],
                    $row['numero_licence'],
                    $row['nom'],
                    $row['prenom'],
                    $this->getCategorieDAO()->getById($row['categorie_id']),
                    $this->getContactDAO()->getById($row['contact_id']),
                    $row['email'],
                    $row['mot_de_passe'],
                    $row['is_admin'] == 1
                );
                return $educateur;
            } else {
                return null; // Ajustez le comportement en fonction de votre application
            }
        } catch (PDOException $e) {
            // Gérer les erreurs de récupération ici
            return null;
        }
    }

    private function getCategorieDAO() {
        return new CategorieDAO($this->connexion);
    }

    private function getContactDAO() {
        return new ContactDAO($this->connexion);
    }
}

?>