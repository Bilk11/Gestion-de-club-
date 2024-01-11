<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des Catégories</title>
    <!-- Ajoutez ici vos liens CSS ou styles pour la mise en forme -->
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <h1>Gestion des Catégories</h1>
    <a href="index.php?page=home">Retour à la liste des catégories</a>

    <!-- Formulaire de création -->
    <h2>Créer une Catégorie</h2>
    <form action="index.php?page=categories&action=addCategory" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="codeRaccourci">Code Raccourci :</label>
        <input type="text" id="codeRaccourci" name="codeRaccourci" required><br>

        <input type="submit" name="action" value="Ajouter">
    </form>

    <!-- Formulaire de modification -->
    <h2>Modifier une Catégorie</h2>
    <form action="index.php?page=categories&action=updateCategory" method="post">
        <label for="editId">ID de la Catégorie à modifier :</label>
        <input type="text" id="editId" name="editId" required><br>

        <label for="editNom">Nouveau Nom :</label>
        <input type="text" id="editNom" name="editNom"><br>

        <label for="editCodeRaccourci">Nouveau Code Raccourci :</label>
        <input type="text" id="editCodeRaccourci" name="editCodeRaccourci"><br>

        <input type="submit" name="action" value="Modifier">
    </form>

    <!-- Liste des catégories -->
    <h2>Liste des Catégories</h2>
    <ul>
        <?php foreach ($categories as $categorie): ?>
        <li>ID: <?php echo $categorie->getId(); ?>, Nom: <?php echo $categorie->getNom(); ?>, Code Raccourci:
            <?php echo $categorie->getCodeRaccourci(); ?></li>
        <?php endforeach; ?>
    </ul>

    <?php
    // Inclure ici la logique pour traiter les formulaires d'ajout et de modification
    ?>

</body>

</html>