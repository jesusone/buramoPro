<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Admin'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), '/user/index') ?></li>
        <li><?= $this->Html->link(__('New Users'), '/user/add') ?></li>
        <li><?= $this->Html->link(__('List Fortunes'), '/fortunes/index') ?></li>
        <li><?= $this->Html->link(__('New Fortunes'), '/fortunes/add') ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Admin') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('username') ?></th>
                <th><?= $this->Paginator->sort('user_type') ?></th>
                <th><?= $this->Paginator->sort('date_created') ?></th>
                <th><?= $this->Paginator->sort('date_modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin): ?>
            <tr>
                <td><?= $this->Number->format($admin->id) ?></td>
                <td><?= h($admin->username) ?></td>
                <td><?= h($admin->user_type) ?></td>
                <td><?= h($admin->date_created) ?></td>
                <td><?= h($admin->date_modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Admin', 'action' => 'View', $admin->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Admin', 'action' => 'Edit', $admin->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Admin', 'action' => 'delete', $admin->id] , ['confirm' => __('Are you sure you want to delete # {0}?', $admin->id)]) ?>
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
