<?php echo "Run Raing Weekly" ?>
 <div class="bur-ranking">
    <?php  echo $this->Form->create(null,['url' => ['action' => 'adminRunRankingFortune']]) ?>
    <?php  echo $this->Form->select('type',['week' => 'Week', 'month' => 'Month', 'year' => 'Year'],['default' => 'm']); ?>
    <?= $this->Form->button(__('Submit')) ?>
</div>