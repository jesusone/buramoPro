<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Brm Fortune Ranking'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="brmFortuneRanking index large-9 medium-8 columns content">
    <h3><?= __('Brm Fortune Ranking') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('fortune_id') ?></th>
                <th><?= $this->Paginator->sort('rank') ?></th>
                <th><?= $this->Paginator->sort('rank_kind') ?></th>
                <th><?= $this->Paginator->sort('fortune_kind_name') ?></th>
                <th><?= $this->Paginator->sort('delete_flg') ?></th>
                <th><?= $this->Paginator->sort('date_created') ?></th>
                <th><?= $this->Paginator->sort('date_modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fortuneRanking as $fortuneRanking): ?>
            <tr>
                <td><?= $this->Number->format($fortuneRanking->id) ?></td>
                <td><?= $this->Number->format($fortuneRanking->fortune_id) ?></td>
                <td><?= $this->Number->format($fortuneRanking->rank) ?></td>
                <td><?= $this->Number->format($fortuneRanking->rank_kind) ?></td>
                <td><?= h($fortuneRanking->fortune_kind_name) ?></td>
                <td><?= $this->Number->format($fortuneRanking->delete_flg) ?></td>
                <td><?= h($fortuneRanking->date_created) ?></td>
                <td><?= h($fortuneRanking->date_modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $fortuneRanking->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fortuneRanking->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $fortuneRanking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fortuneRanking->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
