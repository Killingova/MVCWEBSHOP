<?php
/* Autoloader
// Registriert eine anonyme Funktion als Autoloader. Diese Funktion wird automatisch aufgerufen,
// wenn eine Klasse verwendet wird, die noch nicht definiert ist.*/
spl_autoload_register(function ($class) {
    // Ein Array mit Verzeichnisnamen, in denen nach Klassendefinitionen gesucht werden soll.
    $paths = ['controllers', 'models', 'core'];
    // Durchläuft die Verzeichnisse in $paths.
    foreach ($paths as $path) {
        // Erstellt den Pfad zur Klassendatei basierend auf dem aktuellen Verzeichnis,
        // dem Verzeichnisnamen und dem Klassennamen. __DIR__ ist eine magische Konstante,
        // die den absoluten Pfad des Skripts enthält, in dem sie aufgerufen wird.
        $file = __DIR__ . "/$path/$class.php";
        // Überprüft, ob die Datei existiert.
        if (file_exists($file)) {
            // Lädt die Datei, wenn sie existiert. Dies definiert die Klasse,
            // sodass sie verwendet werden kann.
            require_once $file;
        }
    }
});
/*// Konfigurationen laden
// Lädt die Konfigurationsdatei. Dies ist nützlich, um Konfigurationsoptionen zentral zu verwalten,
// wie Datenbankverbindungsdaten, API-Schlüssel usw. __DIR__ wird wieder verwendet,
// um den absoluten Pfad sicherzustellen.*/
require_once('C:/xampp/htdocs/Webshop/config/config.php');