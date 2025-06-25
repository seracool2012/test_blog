<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Colectează datele din formular
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : 'N/A';
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : 'N/A';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : 'N/A';
    $service = isset($_POST['service']) ? htmlspecialchars($_POST['service']) : 'N/A';
    $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : 'N/A';

    // Formatează datele pentru a fi salvate
    $data = "Data programarii: " . date("Y-m-d H:i:s") . "\n" .
            "Nume: " . $name . "\n" .
            "Telefon: " . $phone . "\n" .
            "Email: " . $email . "\n" .
            "Tip terapie: " . $service . "\n" .
            "Mesaj: " . $message . "\n" .
            "------------------------------------\n\n";

    // Definește numele fișierului unde vei salva programările
    $file = 'programari.txt';

    // Salvează datele în fișier
    // FILE_APPEND adaugă datele la sfârșitul fișierului, nu le suprascrie
    // LOCK_EX previne scrierea concurentă
    if (file_put_contents($file, $data, FILE_APPEND | LOCK_EX) !== false) {
        // Redirecționează utilizatorul înapoi la pagina principală cu un mesaj de succes
        header("Location: index.html?status=success");
        exit();
    } else {
        // Redirecționează utilizatorul înapoi la pagina principală cu un mesaj de eroare
        header("Location: index.html?status=error");
        exit();
    }
} else {
    // Dacă cineva încearcă să acceseze direct acest fișier, îl redirecționăm
    header("Location: index.html");
    exit();
}
?>
