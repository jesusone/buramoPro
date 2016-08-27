<div class="users index large-9 medium-8 columns content">
    <h3><?= __('List Comment') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th width="80%"><?= __('Text') ?></th>
            <th><?= __('Fortune') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($listComments as $comment): ?>
            <tr>
                <td><?= __(json_decode(str_replace('\n', '<br>', json_encode($comment->comment_content))));?>
                    <div class="for-comment-info">
                        <ul class="for-info-wrapper">
                            <li class="for-name"><?=  $comment->user->full_name; ?></li>
                            <li class="for-name">
                                <?php  $age  =    $this->FavoriteUser->getAgeForUser($comment->user->birthday->format('Y-m-d'));
                                 echo $age; ?> <?= __('代')?>
                            </li>
                            <li class="for-day-comments"><?= $comment->date_created->format('Y.m.d')?></li>
                        </ul>
                    </div>
                </td>
                <td><?=  $this->Html->image($comment['fortune']['avatar'], ["alt" => "fortune avatar"]) ?></td>
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
