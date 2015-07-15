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
    exports = [
    <?php foreach ($export as $exp): ?>
        {
            "Id":"<?= h($exp->Id) ?>",
            "Code":"<?= h($exp->Code) ?>"
        }
    <?php endforeach; ?>
    ];

    alert(exports[0].Code);
    </script>
</div>
