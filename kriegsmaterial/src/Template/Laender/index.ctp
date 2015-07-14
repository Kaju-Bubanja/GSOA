<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Laender'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="laender index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('Code') ?></th>
            <th><?= $this->Paginator->sort('Kontinent') ?></th>
            <th><?= $this->Paginator->sort('Land') ?></th>
            <th><?= $this->Paginator->sort('LandFranz') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($laender as $laender): ?>
        <tr>
            <td><?= h($laender->Code) ?></td>
            <td><?= h($laender->Kontinent) ?></td>
            <td><?= h($laender->Land) ?></td>
            <td><?= h($laender->LandFranz) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $laender->Code]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $laender->Code]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $laender->Code], ['confirm' => __('Are you sure you want to delete # {0}?', $laender->Code)]) ?>
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
