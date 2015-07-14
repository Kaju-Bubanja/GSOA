<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Laender'), ['action' => 'edit', $laender->Code]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Laender'), ['action' => 'delete', $laender->Code], ['confirm' => __('Are you sure you want to delete # {0}?', $laender->Code)]) ?> </li>
        <li><?= $this->Html->link(__('List Laender'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Laender'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="laender view large-10 medium-9 columns">
    <h2><?= h($laender->Code) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Code') ?></h6>
            <p><?= h($laender->Code) ?></p>
            <h6 class="subheader"><?= __('Kontinent') ?></h6>
            <p><?= h($laender->Kontinent) ?></p>
            <h6 class="subheader"><?= __('Land') ?></h6>
            <p><?= h($laender->Land) ?></p>
            <h6 class="subheader"><?= __('LandFranz') ?></h6>
            <p><?= h($laender->LandFranz) ?></p>
        </div>
    </div>
</div>
