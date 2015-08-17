<h1> Felhasználóhoz tartozó naptárak</h1>

<ul>
    <?php foreach($calendarList as $calendar) : ?>
        <li><?= $calendar->getSummary() ?></li>
    <?php endforeach ?>
</ul>

<a href="removeToken.php">Token törlése. Új felhasználó naptárainak megtekintése</a>