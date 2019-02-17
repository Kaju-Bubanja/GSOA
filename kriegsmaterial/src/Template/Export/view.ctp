<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Export'), ['action' => 'edit', $export->Id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Export'), ['action' => 'delete', $export->Id], ['confirm' => __('Are you sure you want to delete # {0}?', $export->Id)]) ?> </li>
        <li><?= $this->Html->link(__('List Export'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Export'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="export view large-10 medium-9 columns">
    <h2><?= h($export->Id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Code') ?></h6>
            <p><?= h($export->Code) ?></p>
            <h6 class="subheader"><?= __('Art') ?></h6>
            <p><?= h($export->Art) ?></p>
            <h6 class="subheader"><?= __('System') ?></h6>
            <p><?= h($export->System) ?></p>
            <h6 class="subheader"><?= __('Kategorie') ?></h6>
            <p><?= h($export->Kategorie) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($export->Id) ?></p>
            <h6 class="subheader"><?= __('Betrag') ?></h6>
            <p><?= $this->Number->format($export->Betrag) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Year') ?></h6>
            <?= $this->Text->autoParagraph(h($export->Year)) ?>
        </div>
    </div>
</div>
