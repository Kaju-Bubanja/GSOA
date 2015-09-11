<?php
use Cake\Routing\Router
?>
<table width="100%">
<tr>
	<th><?= $this->Paginator->sort('Code') ?></th>
    <th><?= $this->Paginator->sort('Firma') ?></th>
    <th><?= $this->Paginator->sort('Von') ?></th>
    <th><?= $this->Paginator->sort('Bis') ?></th>
    <th><?= $this->Paginator->sort('Betrag') ?></th>
    <th><?= $this->Paginator->sort('Link') ?></th>
</tr>
<?php
foreach ($skandale as $skandal):
?>
	<tr>
		<td><?= h($skandal->Code) ?></td>
        <td><?= h($skandal->Firma) ?></td>
        <td><?= h($skandal->DatumAnfang) ?></td>
        <td><?= h($skandal->DatumEnde) ?></td>
        <td><?= $this->Number->format($skandal->Betrag) ?></td>
        <td><a href="<?= Router::fullBaseUrl("//5.196.178.165/index.php/") . str_replace(" ", "_", $skandal->Link) ?>" ><?= $skandal->Link ?></a></td>
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

