<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Skandale'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Laender'), ['controller' => 'Laender', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Laender'), ['controller' => 'Laender', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="skandale index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('Id') ?></th>
            <th><?= $this->Paginator->sort('Code') ?></th>
            <th><?= $this->Paginator->sort('Firma') ?></th>
            <th><?= $this->Paginator->sort('DatumAnfang') ?></th>
            <th><?= $this->Paginator->sort('DatumEnde') ?></th>
            <th><?= $this->Paginator->sort('Betrag') ?></th>
            <th><?= $this->Paginator->sort('Link') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($skandale as $skandale): ?>
        <tr>
            <td><?= $this->Number->format($skandale->Id) ?></td>
            <td>
                <?= $skandale->has('laender') ? $this->Html->link($skandale->laender->Code, ['controller' => 'Laender', 'action' => 'view', $skandale->laender->Code]) : '' ?>
            </td>
            <td><?= h($skandale->Firma) ?></td>
            <td><?= h($skandale->DatumAnfang) ?></td>
            <td><?= h($skandale->DatumEnde) ?></td>
            <td><?= $this->Number->format($skandale->Betrag) ?></td>
            <td><?= h($skandale->Link) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $skandale->Id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $skandale->Id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $skandale->Id], ['confirm' => __('Are you sure you want to delete # {0}?', $skandale->Id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
