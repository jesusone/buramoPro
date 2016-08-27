<div class="bur-fortune-telling bur-fortune-telling-view ">
    <h2 class="subject"><?= __('お試し占い一覧') ?></h2>
    <div class="bur-fortune-add">
        <p><?= __('皆様から寄せられたお試し占いの投稿から一部をお選びし、無料でお答えします。') ?></p>
        <p><?= __('試しにお試し占いをしてみたい！という方はエキサイト電話占いのアカウントが必要です。') ?><?= $this->Html->link(__(' お試し占い(無料)を投稿する'), ['action' => 'add']) ?></p>
    </div>
</div>
<div class="bur-freec-data-view row">
    <div class="bur-freec-detail col-md-9">
        <h3 class="free-question-heading heading"><?= h($brmUserFortuneFree->job) ?></h3>
        <div class="question-content">
            <?= h($brmUserFortuneFree->content) ?>
        </div>
        <h3 class="free-answer-heading heading"><?= h($brmUserFortuneFree->answer_title) ?></h3>
        <div class="answer-content">
            <?= h($brmUserFortuneFree->answer_contents) ?>
       </div>
    </div>
    <div class="bur-freec-fortune-deatail col-md-3">
        <div class="bur-freec-fortune-profile">
            <h3 class="hedding"><?= __('回答した占い師');?></h3>
            <div class="avatar">
                <?= $this->Html->image($brmUserFortuneFree->fortune->avatar, [
                "alt" => __('待機中'),
                'url' => ['controller' => 'User','action' => 'FortuneDetail', $brmUserFortuneFree->fortune->id]
                ]); ?>
            </div>
            <div class="action">
                <ul>
                    <li><a href="#" class="sta staOut"><?=  __('退席中') ?></a></li>
                    <li><?= $this->Html->link(__(' メール相談受付中'), ['action' => 'add']) ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="bro-list-freec">
    <h2 class="subject"><?= __('お試し占い一覧') ?></h2>
    <div class="list-view-all">
        <?php foreach($listViews as $item) :  ?>
        <div class="item">
           <p><?= $this->Html->link($item->job, ['action' => 'view',$item->id]) ?></p>
        </div>
        <?php endforeach; ?>
    </div>

</div>
