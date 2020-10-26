<?php
/**
 * @var string $type type de l'alert
 * @var string $message Message de l'alert
 */
?>

<div class="alert alert-<?= $type ?> alert-dismissible fade show" role="alert">
	<?= $message ?>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	</button>
</div>
