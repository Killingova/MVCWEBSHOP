<?php
// Definiert die Basisklasse Controller, von der alle spezifischen Controller erben sollen.
class Controller {
    // Eine Methode zum Laden von Modellen. Modelle sind Klassen, die für die Datenlogik und den Datenzugriff zuständig sind.
    public function model($model) {
        // Baut den Pfad zum Modell unter Verwendung von DIRECTORY_SEPARATOR, um die Kompatibilität zwischen verschiedenen Betriebssystemen sicherzustellen.
        // Der Pfad setzt sich zusammen aus dem Verzeichnis 'models' innerhalb des 'app'-Verzeichnisses und dem Namen des Modells.
        require_once '..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR . $model . '.php';
        // Instanziiert und gibt das Modell zurück, sodass es in dem aufrufenden Controller verwendet werden kann.
        return new $model();
    }

    // Eine Methode zum Laden von Ansichten. Ansichten sind PHP-Dateien, die den HTML-Code für die Benutzeroberfläche enthalten.
    public function view($view, $data = []) {
        // Der Pfad zur Ansicht wird zusammengesetzt, wobei Punkte ('.') im Ansichtsnamen durch Verzeichnistrennzeichen ersetzt werden,
        // um eine hierarchische Struktur innerhalb des 'views'-Verzeichnisses zu ermöglichen.
        // DIRECTORY_SEPARATOR wird auch hier verwendet, um Plattformübergreifende Kompatibilität zu gewährleisten.
        require_once '..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $view) . '.php';
        // Diese Methode gibt keinen Wert zurück, da ihr Hauptzweck das Einbinden der entsprechenden Ansichtsdatei ist,
        // wobei $data verwendet werden kann, um dynamische Daten an die Ansicht zu übergeben.
    }
}
