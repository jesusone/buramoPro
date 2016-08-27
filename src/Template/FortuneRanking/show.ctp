<div class="brmFortuneRanking index large-9 medium-8 columns content">
    <h3><?= __('Top 20 Fortunes In Week') ?></h3>
    <table cellpadding="0" cellspacing="0" border="1">
        <thead>
            <tr>
                <th><?= _('rank') ?></th>
                <th><?= _('fortune name') ?></th>
                <th><?= _('price ') ?></th>
                <th><?= _('number of fortunes ') ?></th>
                <th><?= _('number of comments ') ?></th>
                <th><?= _('start time') ?></th>
                <th><?= _('experience history') ?></th>
                <th><?= _('avatar') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fortuneRankingInWeek as $index => $fortuneRanking): ?>
            <tr>
                <td><?= $this->Html->image('fortunes/rank'.(strval($fortuneRanking->rank)).'.gif');?></td>
                <td><?= $fortuneRanking->fortunes['name'] ?></td>
                <td><?= $this->Number->format($fortuneRanking->fortunes['price']) ?></td>
                <td><?= $this->FavoriteUser->countHistory($fortuneRanking->fortune_id) ?></td>
                <td><?= $this->FavoriteUser->countFortuneComment($fortuneRanking->fortune_id) ?></td>
                <td><?= $fortuneRanking->fortunes['start_time'] ?></td>
                <td><?= $fortuneRanking->fortunes['experience_history'] ?></td>
                <td><?= $this->Html->image($fortuneRanking->fortunes['avatar'], [
                        "alt" => __('待機中'),
                        'url' => ['controller' => 'User','action' => 'FortuneDetail', $fortuneRanking->fortune_id]
                    ]);?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3><?= __('Top 20 Fortunes In Month') ?></h3>
    <table cellpadding="0" cellspacing="0" border="1">
        <thead>
        <tr>
            <th><?= _('rank') ?></th>
            <th><?= _('fortune name') ?></th>
            <th><?= _('price ') ?></th>
            <th><?= _('number of fortunes ') ?></th>
            <th><?= _('number of comments ') ?></th>
            <th><?= _('start time') ?></th>
            <th><?= _('experience history') ?></th>
            <th><?= _('avatar') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($fortuneRankingInMonth as $index => $fortuneRanking): ?>
            <tr>
                <td><?= $this->Html->image('fortunes/rank'.(strval($fortuneRanking->rank)).'.gif');?></td>
                <td><?= $fortuneRanking->fortunes['name'] ?></td>
                <td><?= $this->Number->format($fortuneRanking->fortunes['price']) ?></td>
                <td><?= $this->FavoriteUser->countHistory($fortuneRanking->fortune_id) ?></td>
                <td><?= $this->FavoriteUser->countFortuneComment($fortuneRanking->fortune_id) ?></td>
                <td><?= $fortuneRanking->fortunes['start_time'] ?></td>
                <td><?= $fortuneRanking->fortunes['experience_history'] ?></td>
                <td><?= $this->Html->image($fortuneRanking->fortunes['avatar'], [
                        "alt" => __('待機中'),
                        'url' => ['controller' => 'User','action' => 'FortuneDetail', $fortuneRanking->fortune_id]
                    ]);?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h3><?= __('Top 3 Fortunes By Phone') ?></h3>
    <table cellpadding="0" cellspacing="0" border="1">
        <thead>
        <tr>
            <th><?= _('rank') ?></th>
            <th><?= _('fortune name') ?></th>
            <th><?= _('price ') ?></th>
            <th><?= _('number of fortunes ') ?></th>
            <th><?= _('number of comments ') ?></th>
            <th><?= _('start time') ?></th>
            <th><?= _('experience history') ?></th>
            <th><?= _('avatar') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($fortuneRankingByPhone as $index => $fortuneRanking): ?>
            <tr>
                <td><?= $this->Html->image('fortunes/rank'.(strval($fortuneRanking->rank)).'.gif');?></td>
                <td><?= $fortuneRanking->fortunes['name'] ?></td>
                <td><?= $this->Number->format($fortuneRanking->fortunes['price']) ?></td>
                <td><?= $this->FavoriteUser->countHistory($fortuneRanking->fortune_id) ?></td>
                <td><?= $this->FavoriteUser->countFortuneComment($fortuneRanking->fortune_id) ?></td>
                <td><?= $fortuneRanking->fortunes['start_time'] ?></td>
                <td><?= $fortuneRanking->fortunes['experience_history'] ?></td>
                <td><?= $this->Html->image($fortuneRanking->fortunes['avatar'], [
                        "alt" => __('待機中'),
                        'url' => ['controller' => 'User','action' => 'FortuneDetail', $fortuneRanking->fortune_id]
                    ]);?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h3><?= __('Top 3 Fortunes By Message') ?></h3>
    <table cellpadding="0" cellspacing="0" border="1">
        <thead>
        <tr>
            <th><?= _('rank') ?></th>
            <th><?= _('fortune name') ?></th>
            <th><?= _('price ') ?></th>
            <th><?= _('number of fortunes ') ?></th>
            <th><?= _('number of comments ') ?></th>
            <th><?= _('start time') ?></th>
            <th><?= _('experience history') ?></th>
            <th><?= _('avatar') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($fortuneRankingByMessage as $index => $fortuneRanking): ?>
            <tr>
                <td><?= $this->Html->image('fortunes/rank'.(strval($fortuneRanking->rank)).'.gif');?></td>
                <td><?= $fortuneRanking->fortunes['name'] ?></td>
                <td><?= $this->Number->format($fortuneRanking->fortunes['price']) ?></td>
                <td><?= $this->FavoriteUser->countHistory($fortuneRanking->fortune_id) ?></td>
                <td><?= $this->FavoriteUser->countFortuneComment($fortuneRanking->fortune_id) ?></td>
                <td><?= $fortuneRanking->fortunes['start_time'] ?></td>
                <td><?= $fortuneRanking->fortunes['experience_history'] ?></td>
                <td><?= $this->Html->image($fortuneRanking->fortunes['avatar'], [
                        "alt" => __('待機中'),
                        'url' => ['controller' => 'User','action' => 'FortuneDetail', $fortuneRanking->fortune_id]
                    ]);?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h3><?= __('Top 3 Fortunes By Comment') ?></h3>
    <table cellpadding="0" cellspacing="0" border="1">
        <thead>
        <tr>
            <th><?= _('rank') ?></th>
            <th><?= _('fortune name') ?></th>
            <th><?= _('price ') ?></th>
            <th><?= _('number of fortunes ') ?></th>
            <th><?= _('number of comments ') ?></th>
            <th><?= _('start time') ?></th>
            <th><?= _('experience history') ?></th>
            <th><?= _('avatar') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($fortuneRankingByComment as $index => $fortuneRanking): ?>
            <tr>
                <td><?= $this->Html->image('fortunes/rank'.(strval($fortuneRanking->rank)).'.gif');?></td>
                <td><?= $fortuneRanking->fortunes['name'] ?></td>
                <td><?= $this->Number->format($fortuneRanking->fortunes['price']) ?></td>
                <td><?= $this->FavoriteUser->countHistory($fortuneRanking->fortune_id) ?></td>
                <td><?= $this->FavoriteUser->countFortuneComment($fortuneRanking->fortune_id) ?></td>
                <td><?= $fortuneRanking->fortunes['start_time'] ?></td>
                <td><?= $fortuneRanking->fortunes['experience_history'] ?></td>
                <td><?= $this->Html->image($fortuneRanking->fortunes['avatar'], [
                        "alt" => __('待機中'),
                        'url' => ['controller' => 'User','action' => 'FortuneDetail', $fortuneRanking->fortune_id]
                    ]);?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h3><?= __('Top 3 Latest Fortunes ') ?></h3>
    <table cellpadding="0" cellspacing="0" border="1">
        <thead>
        <tr>
            <th><?= _('rank') ?></th>
            <th><?= _('fortune name') ?></th>
            <th><?= _('price ') ?></th>
            <th><?= _('number of fortunes ') ?></th>
            <th><?= _('number of comments ') ?></th>
            <th><?= _('start time') ?></th>
            <th><?= _('experience history') ?></th>
            <th><?= _('avatar') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($fortuneLatest as $index => $fortuneRanking): ?>
            <tr>
                <td><?= $this->Html->image('fortunes/rank'.(strval($fortuneRanking->rank)).'.gif');?></td>
                <td><?= $fortuneRanking->fortunes['name'] ?></td>
                <td><?= $this->Number->format($fortuneRanking->fortunes['price']) ?></td>
                <td><?= $this->FavoriteUser->countHistory($fortuneRanking->fortune_id) ?></td>
                <td><?= $this->FavoriteUser->countFortuneComment($fortuneRanking->fortune_id) ?></td>
                <td><?= $fortuneRanking->fortunes['start_time'] ?></td>
                <td><?= $fortuneRanking->fortunes['experience_history'] ?></td>
                <td><?= $this->Html->image($fortuneRanking->fortunes['avatar'], [
                        "alt" => __('待機中'),
                        'url' => ['controller' => 'User','action' => 'FortuneDetail', $fortuneRanking->fortune_id]
                    ]);?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
