<?php
// Definiert die Klasse App, die als zentraler Einstiegspunkt der Anwendung dient.
class App {
    // Standard-Controller, der verwendet wird, wenn kein spezifischer Controller in der URL angegeben ist.
    protected $controller = 'HomeController';
    // Standardmethode des Controllers, die aufgerufen wird, wenn keine spezifische Methode in der URL angegeben ist.
    protected $method = 'index';
    // Ein Array, das die Parameter aus der URL speichert, die an die Controller-Methode übergeben werden.
    protected $params = [];

    // Der Konstruktor wird automatisch aufgerufen, wenn eine Instanz der App-Klasse erstellt wird.
    public function __construct() {
        // Zerlegt die URL in ihre Komponenten.
        $url = $this->parseUrl();

        // Überprüft, ob ein Controller existiert, der dem ersten Teil der URL entspricht.
        // Verwendet DIRECTORY_SEPARATOR für die korrekte Pfadtrennung auf allen Betriebssystemen.
        if (file_exists('..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR. ucfirst($url[0]) . '.php')) {
            // Setzt den Controller, wenn eine entsprechende Datei gefunden wird.
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        // Bindet die Controller-Datei ein. Der Pfad wird unter Verwendung von DIRECTORY_SEPARATOR zusammengesetzt,
        // um Kompatibilität mit verschiedenen Betriebssystemen sicherzustellen.
        require_once '..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'controllers'.DIRECTORY_SEPARATOR. $this->controller . '.php';
        // Instanziiert den Controller.
        $this->controller = new $this->controller;

        // Überprüft, ob der zweite Teil der URL einer Methode im Controller entspricht.
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                // Setzt die Methode, wenn sie im Controller existiert.
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Alle verbleibenden Teile der URL werden als Parameter betrachtet.
        // Diese werden als Array neu indiziert, um eventuelle Lücken nach dem Unset zu entfernen.
        $this->params = $url ? array_values($url) : [];
        // Ruft die angegebene Methode des Controllers auf und übergibt die Parameter.
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Eine private Methode, die die URL zerlegt und als Array zurückgibt.
    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return []; // Leeres Array als Standardwert zurückgeben
    }
}
