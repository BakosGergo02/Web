<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #6a6a6a; /* új háttérszín */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .container h2 {
            margin-top: 0;
            text-align: center; /* középre igazítás */
        }
        .container form {
            display: flex;
            flex-direction: column;
            align-items: center; /* középre igazítás */
        }
        .container form label {
            margin-bottom: 5px;
        }
        .container form input {
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            width: 300px; /* szélesség beállítása */
        }
        .container form input[type="submit"] {
            background-color: #007bff; /* új szín */
            color: #fff;
            border: none;
            cursor: pointer;
            width: auto; /* alapértelmezett szélesség */
            padding: 10px 20px; /* nagyobb padding */
        }
        .container form input[type="submit"]:hover {
            background-color: #0056b3; /* új hover szín */
        }
    </style>
</head>
<body <?php if (isset($_GET['color'])) echo "style='background-color: ".$_GET['color'].";'"; ?>>
<div class="container">
    <h2>Bejelentkezés</h2>
    <?php
    // Az üzenetek megjelenítése
    if (isset($_GET['login_error'])) {
        echo "<script>alert('Hibás felhasználónév vagy jelszó!');</script>";
    }
    ?>
    <form action="process_login.php" method="post">
        <label for="username">Felhasználónév:</label>
        <input type="text" id="username" name="username" placeholder="Felhasználónév" required>
        <label for="password">Jelszó:</label>
        <input type="password" id="password" name="password" placeholder="Jelszó" required>
        <input type="submit" value="Bejelentkezés">
    </form>
</div>
</body>
</html>
