<?php

use Controllers\Pages\Parts\Boxes\CurrentBox;
use Controllers\Pages\Parts\Boxes\FinishedBox;
use Controllers\Pages\Parts\Boxes\UrgentBox;
use Controllers\Pages\Parts\ListDropDown;

/**
 * @var string $coucou Text accueil
 */

?>

<?= $coucou; ?><br>

<?php (new ListDropDown())->Elements(array("a" => "b")); ?>

<?php (new FinishedBox("a", "b", "c"))->Display(); ?>
<?php (new CurrentBox("a", "b", "c"))->Display(); ?>
<?php (new UrgentBox("a", "b", "c"))->Display(); ?>


