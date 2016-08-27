
<div class="bur-fortune-telling">
    <h2 class="subject"><?= __('お試し占い一覧') ?></h2>
    <div class="bur-fortune-add">
        <p><?= __('皆様から寄せられたお試し占いの投稿から一部をお選びし、無料でお答えします。') ?></p>
        <p><?= __('試しにお試し占いをしてみたい！という方はエキサイト電話占いのアカウントが必要です。') ?><?= $this->Html->link(__(' お試し占い(無料)を投稿する'), ['action' => 'add']) ?></p>
    </div>
    <div class="bur-freec-data-lists">
        <?php if(!empty($frees)):?>
            <?php foreach ($frees as $free): ?>
                <div class="bur-freec-item">
                    <div class="bur-freec-content-wrapper clearfix">
                        <h3 class="bur-free-job"><?= $free->job ?></h3>
                        <div class="bur-freec-content">
                            <?= h($this->Text->excerpt($free->content, 'method', 50,'...'))?><?= $this->Html->link(__('続きを読む'), ['action' => 'view', $free->id]) ?>
                        </div>
                        <div class="for-comment-info">
                            <ul class="for-info-wrapper">
                                <li class="for-name"><?= $free->user->full_name;?></li>
                                <li class="for-name"><?php
                                     $age  =    $this->FavoriteUser->getAgeForUser($free->user->birthday->format('Y-m-d'));
                                    echo $age;
                                    ?> <?= __('代')?></li>
                                <li class="for-day-comments"><?= $free->date_created->format('Y.m.d')?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="bur-freec-fortune">
                        <div class="bur-freec-fortune-header clearfix">
                            <div class="bur-freec-fortune-avatar">
                                <?= $this->Html->image($free->fortune->avatar, [
                                "alt" => __('待機中'),
                                'url' => ['controller' => 'Users','action' => 'FortuneDetail', $free->fortune->id]
                                ]); ?>
                            </div>
                            <div class="bur-answer-title">
                                <p> <?= $free->answer_title; ?><?= $this->Html->link(__('続きを読む'), ['action' => 'view', $free->id]) ?></p>
                            </div>
                        </div>
                        <div class="bur-fortune-footer">
                            <span><?= __('回答した占い師・');?>&nbsp;</span>
                            <span><?= $this->Html->link($free->fortune->nickname, ['controller'=>'Users', 'action' => 'FortuneDetail', $free->fortune_id]) ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php if(!empty($frees)) : ?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
    <?php endif; ?>
</div>
