<?php
const VALID_COLORS = ['Hellbraun', 'Hellgrau', 'Rosenbraun', 'Rot', 'Gelb'];

// Freitext
// empty($var) is equivalent to !isset($var) || $var == false, according to php documentation
if (empty($_POST['name']) || strlen($_POST['name']) > 100) {
    echo 'Name ist ungültig.';
    return;
}

// Kontinuierlicher Wert
if (!isset($_POST['height']) || !is_numeric($_POST['height']) || (int)$_POST['height'] <= 0) {
    echo 'Grösse muss eine positive Ganzzahl sein.';
    return;
}

// Diskreter Wert
if (empty($_POST['color']) || !in_array($_POST['color'], VALID_COLORS, true)) {
    echo 'Es muss eine der angezeigten Farben ausgewählt werden.';
    return;
}

function printMushroom($name, $height, $colorGerman) {
    echo "<div>
        <header>
            <h3>$name</h3>
        </header>
        <div>
            <p>Grösse: $height</p>
            <p>Farbe: $colorGerman</p>
        </div>
    </div>";
}

$name = $_POST['name'];
$height = $_POST['height'];
$color = $_POST['color'];

$conn = mysqli_connect('127.0.0.1', 'root', '', 'mushrooms');
if (!$conn) {
    echo '<p>Error bei der Datenbankverbindung.</p>';
    return;
}

$insert = mysqli_prepare($conn, 'INSERT INTO mushroom (name, height, color) values (?, ?, ?);');
mysqli_stmt_bind_param($insert, 'sis', $name, $height, $color);
$insertResult = mysqli_stmt_execute($insert);
if (!$insertResult) {
    echo '<p>Konnte Pilz nicht hinzufügen.</p>';
    return;
}

// gets the id of the mushroom that was just added. We need to explicitly get that for further use due to
// auto-increment but we get the advantage that we don't need to increment and manage the ids ourselves.
$addedId = mysqli_stmt_insert_id($insert);

const COOKIE_KEY = 'my_mushrooms';
const MAX_COOKIE_TIME = 2147483647; // prevent the cookie from expiring so that it persists between browser sessions.

if (!empty($_COOKIE[COOKIE_KEY])) {
    // Split cookie string by comma and convert them all to ints. Those are the IDs of the users (browsers) mushrooms.
    $userMushroomIds = array_map('intval', explode(',', $_COOKIE[COOKIE_KEY]));
} else {
    $userMushroomIds = [];
}
$userMushroomIds[] = $addedId; // add id of newly added mushroom to list.
setcookie(COOKIE_KEY, implode(',', $userMushroomIds), MAX_COOKIE_TIME); // write the new list back to the cookie.
?>

<div>
    <h2>Pilz hinzugefügt</h2>
    <?php printMushroom($name, $height, $color); ?>
</div>
<a href="index.html">Zurück zum Hauptseite</a>
<div>
    <h2>Deine Pilze</h2>
<?php
// unfortunately, we can't bind arrays, so we need to build a query with the same amount of question marks as variables.
$query = 'SELECT name, height, color FROM mushroom WHERE id in (' . str_repeat('?,', count($userMushroomIds) - 1) . '?)';
$select = mysqli_prepare($conn, $query);

// bind all the ids from the users cookie to the query, one per question mark. we also need to generate one 'i' per id.
// makes use of the spread operator (...) also called argument unpacking: https://wiki.php.net/rfc/argument_unpacking
mysqli_stmt_bind_param($select, str_repeat('i', count($userMushroomIds)), ...$userMushroomIds);

mysqli_stmt_execute($select);
$res = mysqli_stmt_get_result($select);

if ($res) {
    // display all mushrooms that were stored in the users cookie including the newly added one.
    while($row = mysqli_fetch_assoc($res)) {
        printMushroom($row['name'], $row['height'], $row['color']);
    }
} else {
    echo '<p>Gespeicherte Pilze konnten nicht aus der Datenbank geladen werden.</p>';
}
?>
</div>
