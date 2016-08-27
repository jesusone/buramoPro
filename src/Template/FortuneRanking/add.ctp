<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Brm Fortune Ranking'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="brmFortuneRanking form large-9 medium-8 columns content">
    <?= $this->Form->create($fortuneRanking) ?>
    <fieldset>
        <legend><?= __('Add Brm Fortune Ranking') ?></legend>
        <?php
            echo $this->Form->input('fortune_id');
            echo $this->Form->input('rank');
            echo $this->Form->input('rank_kind');
            echo $this->Form->input('fortune_kind_name');
            echo $this->Form->input('delete_flg');
            echo $this->Form->input('date_created');
            echo $this->Form->input('date_modified');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
