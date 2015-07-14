<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $laender->Code],
                ['confirm' => __('Are you sure you want to delete # {0}?', $laender->Code)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Laender'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="laender form large-10 medium-9 columns">
    <?= $this->Form->create($laender) ?>
    <fieldset>
        <legend><?= __('Edit Laender') ?></legend>
        <?php
            echo $this->Form->input('Kontinent');
            echo $this->Form->input('Land');
            echo $this->Form->input('LandFranz');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
