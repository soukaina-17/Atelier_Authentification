<?php
// Démarrer une session utilisateur qui sera en mesure de pouvoir gérer les Cookies
session_start();

// Vérifier si l'utilisateur est déjà en possession d'un cookie valide (cookie authToken ayant le contenu 12345)
// Si l'utilisateur possède déjà ce cookie, il sera redirigé automatiquement vers la page home.php
// Dans le cas contraire il devra s'identifier.
if (isset($_COOKIE['authToken']) && str_starts_with($_COOKIE['authToken'], 'admin_')) {
    header('Location: page_admin.php');
    exit();
} elseif (isset($_COOKIE['authToken']) && str_starts_with($_COOKIE['authToken'], 'user_')) {
    header('Location: page_user.php');
    exit();
}

// Gérer la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification simple du username et de son password.
    // Si ok alors on initialise le cookie sur le poste de l'utilisateur
    if ($username === 'admin' && $password === 'secret') {
        $token = bin2hex(random_bytes(16));
        setcookie('authToken', 'admin', time() + 60, '/', '', false, true); // Le Cookie est initialisé et valable pendant 1 heure (3600 secondes)
        header('Location: page_admin.php'); // L'utilisateur est dirigé vers la page home.php
        exit();
    } elseif ($username === 'user' && $password === 'utilisateur') {
        $token = bin2hex(random_bytes(16));
        setcookie('authToken', 'admin', time() + 60, '/', '', false, true);
        header('Location: user.php');
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>
    </head>
<body>
    <h1>Atelier authentification par Cookie</h1>
    <h3>La page <a href="home.php">home.php</a> est inaccéssible tant que vous ne vous serez pas connecté avec le login 'admin' et mot de passe 'secret'</h3>
    <h3>La page <a href="page_admin.php">page_admin.php</a> est inaccéssible tant que vous ne vous serez pas connecté avec le login 'admin' et mot de passe 'secret'</h3>
    <form method="POST" action="">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
