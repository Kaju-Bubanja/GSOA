<table class="table table-striped">
<tr>
	<th><?= $this->Paginator->sort('Code') ?></th>
    <th><?= $this->Paginator->sort('Art') ?></th>
    <th><?= $this->Paginator->sort('System') ?></th>
    <th><?= $this->Paginator->sort('Kategorie') ?></th>
    <th class="text-right" width="150px" style="padding-right: 30px"><?= $this->Paginator->sort('Betrag') ?></th>
    <th><?= $this->Paginator->sort('Datum') ?></th>
</tr>
<?php
foreach ($export as $export):
?>
	<tr>
		<td><?= h($export->Code) ?></td>
        <td><?= h($export->Art) ?></td>
        <td><?= h($export->System) ?></td>
        <td><?= __($export->Kategorie) ?></td>
        <td class="text-right" style="padding-right: 30px"><?= $this->Number->format($export->Betrag) ?> CHF</td>
        <td><?= h($export->Exportdate->format('Y.m.d')) ?></td>
	</tr>
<?php endforeach; ?>
</table>
<div class="text-center">
	<div class="paginator" id="paginator" style="margin: auto">
        <ul class="pagination text-centered">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p class="text-centered"><?= $this->Paginator->counter('Insgesamt {{count}} Einträge, zeige {{start}} bis {{end}}') ?></p>
    </div>
</div>

