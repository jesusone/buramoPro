<div class="users index large-9 medium-8 columns content">
    <h3><?= __('List Coin') ?></h3>
    <table border="1px" cellpadding="0" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th><?= __('Day transaction') ?></th>
            <th><?= __('Amount') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($listCoins as $coin): ?>
            <tr>
                <td><?= h($coin->date_created) ?></td>
                <td><?= h($coin->amount) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
