<?php

const VALID_COLORS = ['saddlebrown' => 'Hellbraun', 'lightgray' => 'Hellgrau', 'rosybrown' => 'Rosenbraun', 'red' => 'Rot', 'yellow' => 'Gelb'];

// Freitext
if (empty($_POST['name'])) { // equivalent to !isset($var) || $var == false, according to php documentation
    echo "Name muss angegeben werden.";
    return;
}

// Kontinuierlicher Wert
if (!isset($_POST['height']) || !is_numeric($_POST['height']) || (int)$_POST['height'] <= 0) {
    echo "Grösse muss eine positive Ganzzahl sein.";
    return;
}

// Diskreter Wert
if (empty($_POST['color']) || !in_array($_POST['color'], array_keys(VALID_COLORS), true)) {
    echo "Es muss eine der angezeigten Farben ausgewählt werden.";
    return;
}

$name = $_POST['name'];
$height = $_POST['height'];
$color = $_POST['color'];
$colorGerman = VALID_COLORS[$color];

?>

<div>
    <header>
        <h2>Pilz hinzugefügt</h2>
        <h3><?php echo $name ?></h3>
    </header>
    <div>
        <p>Grösse: <?php echo $height ?></p>
        <p>Farbe: <?php echo $colorGerman ?></p>
    </div>
</div>

<a href="index.html">Zurück zum Hauptseite</a>