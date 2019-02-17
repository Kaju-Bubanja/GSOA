<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Skandale'), ['action' => 'edit', $skandale->Id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Skandale'), ['action' => 'delete', $skandale->Id], ['confirm' => __('Are you sure you want to delete # {0}?', $skandale->Id)]) ?> </li>
        <li><?= $this->Html->link(__('List Skandale'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Skandale'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Laender'), ['controller' => 'Laender', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Laender'), ['controller' => 'Laender', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="skandale view large-10 medium-9 columns">
    <h2><?= h($skandale->Id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Laender') ?></h6>
            <p><?= $skandale->has('laender') ? $this->Html->link($skandale->laender->Code, ['controller' => 'Laender', 'action' => 'view', $skandale->laender->Code]) : '' ?></p>
            <h6 class="subheader"><?= __('Firma') ?></h6>
            <p><?= h($skandale->Firma) ?></p>
            <h6 class="subheader"><?= __('Link') ?></h6>
            <p><?= h($skandale->Link) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($skandale->Id) ?></p>
            <h6 class="subheader"><?= __('Betrag') ?></h6>
            <p><?= $this->Number->format($skandale->Betrag) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('DatumAnfang') ?></h6>
            <p><?= h($skandale->DatumAnfang) ?></p>
            <h6 class="subheader"><?= __('DatumEnde') ?></h6>
            <p><?= h($skandale->DatumEnde) ?></p>
        </div>
    </div>
</div>
