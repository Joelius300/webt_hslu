<?php

const VALID_COLORS = ['saddlebrown', 'lightgray', 'rosybrown', 'red', 'yellow'];

// Freitext
if (empty($_POST['name'])) { // equivalent to !isset($var) || $var == false, according to php documentation
    echo "Name muss angegeben werden.";
}

// Kontinuierlicher Wert
if (!isset($_POST['height']) || !is_numeric($_POST['height']) || (int)$_POST['height'] <= 0) {
    echo "Grösse muss eine positive Ganzzahl sein.";
}

// Diskreter Wert
if (empty($_POST['color']) || !in_array($_POST['color'], VALID_COLORS, true)) {
    echo "Es muss eine der angezeigten Farben ausgewählt werden.";
}
// Die Client-Validierung, wo auf bekannte Pilze hingewiesen wird, ist nur eine Hilfestellung
// ohne Folgen auf Sicherheit o.Ä., und kann auf dem Server vernachlässigt werden.

$name = $_POST['name'];
$height = $_POST['height'];
$color = $_POST['color'];

// TODO map the color to a german word to display

?>

<div class="w3-card">
    <header class="w3-container">
        <h3><?php echo $name ?></h3>
    </header>
    <div class="w3-container">
        <p>Grösse: <?php echo $height ?></p>
        <p>Farbe: <?php echo $color ?></p>
    </div>
</div>

<a href="index.html">Zurück zum Hauptseite</a>