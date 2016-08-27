<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Brm Fortune Ranking'), ['action' => 'edit', $fortuneRanking->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Brm Fortune Ranking'), ['action' => 'delete', $fortuneRanking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fortuneRanking->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Brm Fortune Ranking'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Brm Fortune Ranking'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="brmFortuneRanking view large-9 medium-8 columns content">
    <h3><?= h($fortuneRanking->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Fortune Kind Name') ?></th>
            <td><?= h($fortuneRanking->fortune_kind_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($fortuneRanking->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Fortune Id') ?></th>
            <td><?= $this->Number->format($fortuneRanking->fortune_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Rank') ?></th>
            <td><?= $this->Number->format($fortuneRanking->rank) ?></td>
        </tr>
        <tr>
            <th><?= __('Rank Kind') ?></th>
            <td><?= $this->Number->format($fortuneRanking->rank_kind) ?></td>
        </tr>
        <tr>
            <th><?= __('Delete Flg') ?></th>
            <td><?= $this->Number->format($fortuneRanking->delete_flg) ?></td>
        </tr>
        <tr>
            <th><?= __('Date Created') ?></th>
            <td><?= h($fortuneRanking->date_created) ?></td>
        </tr>
        <tr>
            <th><?= __('Date Modified') ?></th>
            <td><?= h($fortuneRanking->date_modified) ?></td>
        </tr>
    </table>
</div>
