<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Export'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="export index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('Id') ?></th>
            <th><?= $this->Paginator->sort('Code') ?></th>
            <th><?= $this->Paginator->sort('Art') ?></th>
            <th><?= $this->Paginator->sort('System') ?></th>
            <th><?= $this->Paginator->sort('Kategorie') ?></th>
            <th><?= $this->Paginator->sort('Betrag') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
   <?php foreach ($export as $export): ?>
        <tr>
            <td><?= $this->Number->format($export->Id) ?></td>
            <td><?= h($export->Code) ?></td>
            <td><?= h($export->Art) ?></td>
            <td><?= h($export->System) ?></td>
            <td><?= h($export->Kategorie) ?></td>
            <td><?= $this->Number->format($export->Betrag) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $export->Id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $export->Id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $export->Id], ['confirm' => __('Are you sure you want to delete # {0}?', $export->Id)]) ?>
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
    <script>
</div>
