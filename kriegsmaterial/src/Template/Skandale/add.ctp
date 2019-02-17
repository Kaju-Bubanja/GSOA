<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Skandale'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Laender'), ['controller' => 'Laender', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Laender'), ['controller' => 'Laender', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="skandale form large-10 medium-9 columns">
    <?= $this->Form->create($skandale) ?>
    <fieldset>
        <legend><?= __('Add Skandale') ?></legend>
        <?php
            echo $this->Form->input('Code', ['options' => $laender]);
            echo $this->Form->input('Firma');
            echo $this->Form->input('DatumAnfang', ['empty' => true, 'default' => '']);
            echo $this->Form->input('DatumEnde', ['empty' => true, 'default' => '']);
            echo $this->Form->input('Betrag');
            echo $this->Form->input('Link');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
