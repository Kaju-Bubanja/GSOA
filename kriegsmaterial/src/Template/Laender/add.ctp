<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Laender'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="laender form large-10 medium-9 columns">
    <?= $this->Form->create($laender) ?>
    <fieldset>
        <legend><?= __('Add Laender') ?></legend>
        <?php
            echo $this->Form->input('Kontinent');
            echo $this->Form->input('Land');
            echo $this->Form->input('LandFranz');
            echo $this->Form->input('latitude');
            echo $this->Form->input('longitude');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
