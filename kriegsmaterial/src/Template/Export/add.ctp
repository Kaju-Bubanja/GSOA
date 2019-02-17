<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Export'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="export form large-10 medium-9 columns">
    <?= $this->Form->create($export) ?>
    <fieldset>
        <legend><?= __('Add Export') ?></legend>
        <?php
            echo $this->Form->input('Code');
            echo $this->Form->input('Art');
            echo $this->Form->input('System');
            echo $this->Form->input('Kategorie');
            echo $this->Form->input('Year');
            echo $this->Form->input('Betrag');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
