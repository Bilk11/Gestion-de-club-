<?php
// Inclure le fichier de configuration
require_once('config.php');

// Charger les classes nécessaires
require_once('model/Categorie.php');
require_once('model/Licencie.php');
require_once('model/Contact.php');
require_once('model/Educateur.php');
require_once('dao/CategorieDAO.php');
require_once('dao/LicencieDAO.php');
require_once('dao/ContactDAO.php');
require_once('dao/EducateurDAO.php');

// Instancier les DAO avec une connexion
$categorieDAO = new CategorieDAO(new Connexion());
$licencieDAO = new LicencieDAO(new Connexion());
$contactDAO = new ContactDAO(new Connexion());
$educateurDAO = new EducateurDAO(new Connexion(),$categorieDAO,$contactDAO);

// Exemple de routage basique
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home'; // Page par défaut
}

// Exemple avec un paramètre pour permettre un routage plus sophistiqué
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'index'; // Action par défaut
}

// Définir les contrôleurs disponibles
$controllers = [
    'home' => 'HomeController',
    'categorie' => 'CategorieController',
    'licencie' => 'LicencieController',
    'educateur' => 'EducateurController',
    'contact' => 'ContactController'
];

// Vérifier si le contrôleur demandé existe
if (array_key_exists($page, $controllers)) {
    $controllerName = $controllers[$page];
    // Inclure le fichier du contrôleur
    require_once('controllers/' . $controllerName . '.php');
    
    // Instancier le contrôleur en passant les DAO nécessaires
    $controller = new $controllerName($categorieDAO, $licencieDAO, $contactDAO, $educateurDAO);

    // Exécuter la méthode demandée du contrôleur
    $controller->$action(isset($_GET['id']) ? $_GET['id'] : null);

} else {
    // Page non trouvée, rediriger vers une page d'erreur 404
    echo "Page non trouvée";
}
?>