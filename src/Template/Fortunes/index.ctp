<h2><?= __('Hello index') ?></h2>
<div class="">
    <h3><?= __('Fortunes') ?></h3>
    <table border="1">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('username') ?></th>
                <th><?= $this->Paginator->sort('mail_address') ?></th>
                <th><?= $this->Paginator->sort('date_created') ?></th>
                <th><?= $this->Paginator->sort('date_modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fortunes as $fortune): ?>
            <tr>
                <td><?= $this->Number->format($fortune->id) ?></td>
                <td><?= h($fortune->username) ?></td>
                <td><?= h($fortune->mail_address) ?></td>
                <td><?= h($fortune->date_created) ?></td>
                <td><?= h($fortune->date_modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $fortune->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fortune->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $fortune->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fortune->id)]) ?>
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
