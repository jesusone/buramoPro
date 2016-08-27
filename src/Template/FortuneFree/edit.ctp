<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $brmUserFortuneFree->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $brmUserFortuneFreec->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Brm User Fortune Freec'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="brmUserFortuneFreec form large-9 medium-8 columns content">
    <?= $this->Form->create($brmUserFortuneFree) ?>
    <fieldset>
        <legend><?= __('Edit Brm User Fortune Freec') ?></legend>
        <?php
            echo $this->Form->input('user_id');
            echo $this->Form->input('fortune_id');
            echo $this->Form->input('job');
            echo $this->Form->input('content');
            echo $this->Form->input('date_created');
            echo $this->Form->input('date_modified');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
