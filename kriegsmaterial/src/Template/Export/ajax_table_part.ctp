<table class="table table-striped">
<tr>
	<th>Land</th>
    <th>Art</th>
    <th>System</th>
    <th>Kategorie</th>
    <th class="text-right" width="180px" style="padding-right: 30px">Betrag</th>
    <th>Datum</th>
</tr>
<?php
foreach ($export as $export):
?>
	<tr>
		<td><?= h($export['laender']['Land']); ?></td>
        <td><?= h($export->Art) ?></td>
        <td><?= __($export->System) ?></td>
        <td><? echo __($export->Kategorie);
        		if($export->Art != "Kriegsmaterial"){ 
			?> 
        		&nbsp&nbsp<a href="http://www.seco.admin.ch/themen/00513/00600/00608/00613/index.html?lang=de" target="_blank"><small>Güterlisten des SECO</small>
        	<? } ?>
        </a></td>
        <td class="text-right" style="padding-right: 30px"><?= $this->Number->format($export->Betrag) ?> CHF</td>
        <td><?= h($export->Exportdate->format('d.m.Y')) ?></td>
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

