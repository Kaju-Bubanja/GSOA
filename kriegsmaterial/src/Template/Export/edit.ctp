<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $export->Id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $export->Id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Export'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="export form large-10 medium-9 columns">
    <?= $this->Form->create($export) ?>
    <fieldset>
        <legend><?= __('Edit Export') ?></legend>
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
