<?php

/**
 * @var $coucou
 */

use Controllers\Parts\Boxes\FinishedBox;
use Controllers\Parts\ListDropDown;

?>

<?= $coucou; ?><br>

<?php (new ListDropDown())->Elements(array("a" => "b")); ?>

<?php (new FinishedBox("a", "b", "c"))->Display(); ?>


