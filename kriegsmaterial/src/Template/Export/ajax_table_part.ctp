<table width="100%">
<tr>
	<th><?= $this->Paginator->sort('Code') ?></th>
    <th><?= $this->Paginator->sort('Art') ?></th>
    <th><?= $this->Paginator->sort('System') ?></th>
    <th><?= $this->Paginator->sort('Kategorie') ?></th>
    <th><?= $this->Paginator->sort('Betrag') ?></th>
    <th><?= $this->Paginator->sort('Exportdate') ?></th>
</tr>
<?php
foreach ($export as $export):
?>
	<tr>
		<td><?= h($export->Code) ?></td>
        <td><?= h($export->Art) ?></td>
        <td><?= h($export->System) ?></td>
        <td><?= h($export->Kategorie) ?></td>
        <td><?= $this->Number->format($export->Betrag) ?></td>
        <td><?= h($export->Exportdate->format('Y.m.d')) ?></td>
	</tr>
<?php endforeach; ?>
</table>

<div class="paginator" id="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>

