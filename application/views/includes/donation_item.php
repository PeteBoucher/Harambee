<?php foreach ($donations as $donation): ?>
	<li><?= number_format($donation->Amount, 2) ?> <?= $donation->Currency ?></li>
<?php endforeach; ?>
