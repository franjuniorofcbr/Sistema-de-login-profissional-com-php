<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Bem-vindo, <?= htmlspecialchars($_SESSION['user']['name']) ?>!</h2>
    <a href="/logout">Sair</a>
</body>
</html>
