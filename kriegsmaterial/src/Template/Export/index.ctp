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
    <?php /* foreach ($export as $export): ?>
        <tr>
            <td><?= h($export->Code) ?></td>  
        </tr>
    <?php endforeach; */ ?>
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
    <?php
// Lösung 1: Fehlendes Komma einfügen.  
        $is_first = true;
        foreach ($export as $exp):
            if($is_first){
                $is_first = false;
            } else {
                echo ",";
            }
	?>
        {
            "Id":"<?= h($exp->Id) ?>",
            "Code":"<?= h($exp->Code) ?>" // Vorsicht: Wenn ein " im Code wäre, gäbe es ein Problem...
        }
    <?php endforeach; ?>
    ];

    alert(exports[0].Code);
    </script>

// Lösung 2: Viel eleganter und einfacher...
<?php echo json_encode($export); ?>
</div>
