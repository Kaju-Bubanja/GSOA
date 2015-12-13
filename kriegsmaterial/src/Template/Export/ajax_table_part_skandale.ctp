<?php
use Cake\Routing\Router
?>
<table class="table table-striped">
<tr>
	<th>Land</th>
    <th><?= $this->Paginator->sort('Link') ?></th>
    <th><?= $this->Paginator->sort('Firma') ?></th>
    <th><?= $this->Paginator->sort('Von') ?></th>
    <th><?= $this->Paginator->sort('Bis') ?></th>
    <th><?= $this->Paginator->sort('Betrag') ?></th>
</tr>
<?php
foreach ($skandale as $skandal):
?>
	<tr>
		<td><?= h($skandal['laender']['Land']) ?></td>
        <td><a class='skandalLink' href="<?= Router::fullBaseUrl("http://kriegsmaterial.ch/kriegsmaterialwiki/index.php/") . str_replace(" ", "_", $skandal->Link) ?>" ><?= $skandal->Link ?></a></td>
        <td><?= h($skandal->Firma) ?></td>
        <td><?= $skandal->DatumAnfang ? h($skandal->DatumAnfang->format('Y')) : "" ?></td>
        <td><?= $skandal->DatumEnde ? h($skandal->DatumEnde->format('Y')) : "" ?></td>
        <td><?= $skandal->Betrag > 0 ? $this->Number->format($skandal->Betrag) . " CHF" : "" ?></td>
	</tr>
<?php endforeach; ?>
</table>

<div class="text-center">
	<div class="paginator" id="paginator">
	        <ul class="pagination">
	            <?= $this->Paginator->prev('< ' . __('previous')) ?>
	            <?= $this->Paginator->numbers() ?>
	            <?= $this->Paginator->next(__('next') . ' >') ?>
	        </ul>
	        <p><?= $this->Paginator->counter('Insgesamt {{count}} Einträge, zeige {{start}} bis {{end}}') ?></p>
	    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body" id="myModalBody">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
      </div>
    </div>
  </div>
</div>


