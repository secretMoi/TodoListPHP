<?php

use Controllers\Pages\Parts\FinishedBox;
use Controllers\Pages\Parts\ListDropDown;

?>

<?= $coucou; ?><br>

<?php (new ListDropDown())->Elements(array("a" => "b")); ?>

<?php (new FinishedBox("a", "b", "c"))->Display(); ?>


