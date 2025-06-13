<?php
function parametres($titre) {
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
    echo "<meta name='author' content='Les équipes de développeurs'>";
    echo "<meta name='description' content='Intranet Goelandale'>";
    echo "<meta name='keywords' content='intranet'>";
    echo "<title>$titre</title>";
    echo "<link rel='shortcut icon' href='/SAE-203/Intranet/img/goelandale.png' />";
    echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>";
}

function entete() {
    echo "<header class='bg-primary text-white text-center p-4'>";
    echo "<h1><strong>Intranet Goelandale</strong></h1>";

    if (isset($_SESSION['user'])) {
        echo "<p>Bonjour, <strong>".htmlspecialchars($_SESSION['user']['prenom'])." ".htmlspecialchars($_SESSION['user']['nom'])."</strong> | Rôle: <strong>".$_SESSION['user']['role']."</strong></p>";

        if (!empty($_SESSION['user']['photo']) && file_exists($_SESSION['user']['photo'])) {
            echo "<img src='/SAE-203/Intranet/" . $_SESSION['user']['photo'] . "' alt='Photo de profil' class='rounded-circle' height='50'>";
        } else {
            echo "<img src='/SAE-203/Intranet/img/goelandale.png' alt='Image par default' class='rounded-circle' height='50'>";
        }

        echo "<br><a href='/SAE-203/Intranet/deconnexion.php' class='btn btn-secondary mt-2'>Se déconnecter</a>";
    } else {
        echo "<p><a href='/SAE-203/Intranet/connexion.php' class='btn btn-dark'>Se connecter</a></p>";
    }

    echo "</header>";
}


function navigation() {

    function isActive($page) {
        return strpos($_SERVER['REQUEST_URI'], $page) !== false ? 'active text-white' : '';
    }

    if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin') {
        echo "<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>";
        echo "<div class='container-fluid'>";
        echo "<a class='navbar-brand' href='/SAE-203/Intranet/accueil.php'>Accueil</a>";
        echo "<button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav'>";
        echo "<span class='navbar-toggler-icon'></span></button>";
        echo "<div class='collapse navbar-collapse' id='navbarNav'>";
        echo "<ul class='navbar-nav'>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('annuaires.php')."' href='/SAE-203/Intranet/annuaires.php'>Notre équipe</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('clients.php')."' href='/SAE-203/Intranet/clients.php'>Nos clients</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('partenaires.php')."' href='/SAE-203/Intranet/partenaires.php'>Nos partenaires</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('gestionnaire.php')."' href='/SAE-203/Intranet/gestionnaire.php'>Gestionnaire</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('monprofil.php')."' href='/SAE-203/Intranet/monprofil.php'>Mon profil</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('wiki.php')."' href='/SAE-203/Intranet/wiki.php'>Wiki</a></li>";
        echo "</ul></div></div></nav>";

    } elseif (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'salaries') {
        echo "<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>";
        echo "<div class='container-fluid'>";
        echo "<a class='navbar-brand' href='/SAE-203/Intranet/accueil.php'>Accueil</a>";
        echo "<button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav'>";
        echo "<span class='navbar-toggler-icon'></span></button>";
        echo "<div class='collapse navbar-collapse' id='navbarNav'>";
        echo "<ul class='navbar-nav'>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('annuaires.php')."' href='/SAE-203/Intranet/annuaires.php'>Notre équipe</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('clients.php')."' href='/SAE-203/Intranet/clients.php'>Nos clients</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('partenaires.php')."' href='/SAE-203/Intranet/partenaires.php'>Nos partenaires</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('gestionnaire.php')."' href='/SAE-203/Intranet/gestionnaire.php'>Gestionnaire</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('monprofil.php')."' href='/SAE-203/Intranet/monprofil.php'>Mon profil</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('wiki.php')."' href='/SAE-203/Intranet/wiki.php'>Wiki</a></li>";
        echo "</ul></div></div></nav>";

    } elseif (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'managers') {
        echo "<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>";
        echo "<div class='container-fluid'>";
        echo "<a class='navbar-brand' href='/SAE-203/Intranet/accueil.php'>Accueil</a>";
        echo "<button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav'>";
        echo "<span class='navbar-toggler-icon'></span></button>";
        echo "<div class='collapse navbar-collapse' id='navbarNav'>";
        echo "<ul class='navbar-nav'>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('annuaires.php')."' href='/SAE-203/Intranet/annuaires.php'>Notre équipe</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('clients.php')."' href='/SAE-203/Intranet/clients.php'>Nos clients</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('partenaires.php')."' href='/SAE-203/Intranet/partenaires.php'>Nos partenaires</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('gestionnaire.php')."' href='/SAE-203/Intranet/gestionnaire.php'>Gestionnaire</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('monprofil.php')."' href='/SAE-203/Intranet/monprofil.php'>Mon profil</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('wiki.php')."' href='/SAE-203/Intranet/wiki.php'>Wiki</a></li>";
        echo "</ul></div></div></nav>";

    } elseif (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'direction') {
        echo "<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>";
        echo "<div class='container-fluid'>";
        echo "<a class='navbar-brand' href='/SAE-203/Intranet/accueil.php'>Accueil</a>";
        echo "<button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav'>";
        echo "<span class='navbar-toggler-icon'></span></button>";
        echo "<div class='collapse navbar-collapse' id='navbarNav'>";
        echo "<ul class='navbar-nav'>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('annuaires.php')."' href='/SAE-203/Intranet/annuaires.php'>Notre équipe</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('clients.php')."' href='/SAE-203/Intranet/clients.php'>Nos clients</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('partenaires.php')."' href='/SAE-203/Intranet/partenaires.php'>Nos partenaires</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('gestionnaire.php')."' href='/SAE-203/Intranet/gestionnaire.php'>Gestionnaire</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('monprofil.php')."' href='/SAE-203/Intranet/monprofil.php'>Mon profil</a></li>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('wiki.php')."' href='/SAE-203/Intranet/wiki.php'>Wiki</a></li>";
        echo "</ul></div></div></nav>";

    } else {
        echo "<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>";
        echo "<div class='container-fluid'>";
        echo "<a class='navbar-brand' href='/SAE-203/Intranet/accueil.php'>Accueil</a>";
        echo "<button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav'>";
        echo "<span class='navbar-toggler-icon'></span></button>";
        echo "<div class='collapse navbar-collapse' id='navbarNav'>";
        echo "<ul class='navbar-nav'>";
        echo "<li class='nav-item'><a class='nav-link ".isActive('wiki.php')."' href='/SAE-203/Intranet/wiki.php'>Wiki</a></li>";
        echo "</ul></div></div></nav>";
    }
}

function pieddepage() {
    echo "<footer class='bg-dark text-white text-center p-3 mt-auto'>";
    echo "<p>Dev Goelandale | Email: goelandale@proton.me | 1AFI - G2</p>";
    echo "<p>".date('d/m/Y H:i')." &copy; ".date('Y')." | Adresse IP: ".$_SERVER['REMOTE_ADDR']."</p>";
    echo "</footer>";
}

function getClientById($id) {
    global $liste_clients;

    foreach ($liste_clients as $client) {
        if ($client['id'] == $id) {
            return $client;
        }
    }
    return false;
}


$liste_users = json_decode(file_get_contents(__DIR__ . '/../data/utilisateurs.json'), true);
$liste_partenaires = json_decode(file_get_contents(__DIR__ . '/../data/partenaires.json'), true);
$nb_users = count($liste_users);
$liste_clients = json_decode(file_get_contents(__DIR__ . '/../data/clients.json'), true);


function creerDossierPartage($login) {
    // On s'assure que le dossier "utilisateurs" existe
    $baseDir = DIR . '/../ftp-root/utilisateurs/';
    if (!file_exists($baseDir)) {
        mkdir($baseDir, 0775, true);
    }

    $userDir = $baseDir . $login;
    // On ne crée que le dossier de l'utilisateur, les sous-dossiers sont optionnels
    if (!file_exists($userDir)) {
        mkdir($userDir, 0775, true);
    }
}

?>