<div class="form-group">
	<label>
		<select class="custom-select">
			<option selected="">Sélectionner une valeur</option>

			<?php foreach ($variables as $key => $value): ?>
			<option value=<?= $key; ?>><?= $value; ?></option>
			<?php endforeach; ?>

		</select>
	</label>
</div>