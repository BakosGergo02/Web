<?php
$servername = "mysql.omega:3306";
$username = "gerycs";
$password = "Szeptember16";
$dbname = "gerycs";

// Kapcsolat létrehozása
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die("Sikertelen kapcsolódás az adatbázishoz: " . $conn->connect_error);
}

// Funkció a titkosított adatok visszafejtésére
function decode_credentials($encoded_data) {
    // Megadott titkosítási kulcs
    $decode_key = array(5, -14, 31, -9, 3);

    // Sorok szétválasztása és visszafejtése
    $lines = explode(chr(10), $encoded_data); // 10: A sorvége karakter kódja

    $decoded_data = [];
    foreach ($lines as $line) {
        $decoded_line = '';
        $characters = str_split($line);
        foreach ($characters as $char) {
            $decoded_char = chr(ord($char) - current($decode_key));
            $decoded_line .= $decoded_char;
            $decode_key[] = array_shift($decode_key); // Visszatérés a kör elejére
        }
        $decoded_data[] = $decoded_line;
    }

    return $decoded_data;
}

// Ellenőrzi a felhasználó által megadott adatokat
function check_login($username, $password, $decoded_data) {
    foreach ($decoded_data as $line) {
        $data = explode('*', $line);
        if (count($data) === 2) {
            $stored_username = trim($data[0]);
            $stored_password = trim($data[1]);
            if ($username === $stored_username && $password === $stored_password) {
                return true; // Sikeres bejelentkezés
            }
        }
    }
    return false; // Sikertelen bejelentkezés
}

function get_color($username, $conn) {
    $sql = "SELECT Titkos FROM tabla WHERE Username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $color = $row['Titkos'];

        // Fordítsuk le a színt angolra
        $translated_color = translate_color_to_english($color);

        return $translated_color;
    }
    return false;
}

function translate_color_to_english($color) {
    switch ($color) {
        case 'piros':
            return 'red';
        case 'kek':
            return 'blue';
        // Egyéb színek fordítása
        case 'zold':
             return 'green';
        case 'sarga':
             return 'yellow';
        case 'fekete':
             return 'black';
        case 'feher':
            return 'white';
        default:
            return $color; // Ha nincs fordítás, csak visszaadjuk az eredeti színt
    }
}

// Ellenőrzi, hogy a felhasználó bejelentkezett-e
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $file_path = 'password.txt';
        $encoded_data = file_get_contents($file_path);
        $decoded_data = decode_credentials($encoded_data);

        if (check_login($username, $password, $decoded_data)) {
            // Sikeres bejelentkezés esetén beállítjuk az új háttérszín változót
            $color = get_color($username, $conn);
            header("Location: index.php?login_success=1&color=$color");
            exit;
        } else {
            header("Location: index.php?login_error=1");
            exit;
        }
    }
}

// Ha valami hiba történt
header("Location: index.php?error=1");
exit;
?>
