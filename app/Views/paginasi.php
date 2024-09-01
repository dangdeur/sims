<?php
$pager->setSurroundCount(2);
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
	<ul class="pagination">
		<?php if ($pager->hasPreviousPage()) : ?>
			<li>
				<a class="btn btn-primary" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
					<span aria-hidden="true"><?= lang('Pager.first') ?></span>
				</a>
			</li>&nbsp;
			<li>
				<a class="btn btn-primary" href="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang('Pager.previous') ?>">
					<span aria-hidden="true"><?= lang('Pager.previous') ?></span>
				</a>
			</li>&nbsp;
		<?php endif ?>

		<?php foreach ($pager->links() as $link) : ?>
			<li <?= $link['active'] ? 'class="active"' : '' ?>>
				<a href="<?= $link['uri'] ?>" class="btn btn-success">
					<?= $link['title'] ?>
				</a>
			</li>&nbsp;
		<?php endforeach ?>

		<?php if ($pager->hasNextPage()) : ?>
			<li>
				<a class="btn btn-danger" href="<?= $pager->getNextPage() ?>" aria-label="<?= lang('Pager.next') ?>">
					<span aria-hidden="true"><?= lang('Pager.next') ?></span>
				</a>
			</li>&nbsp;
			<li>
				<a class="btn btn-danger" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
					<span aria-hidden="true"><?= lang('Pager.last') ?></span>
				</a>
			</li>&nbsp;
		<?php endif ?>
	</ul>
</nav>