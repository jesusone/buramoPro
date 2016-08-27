<div class="bur-fortune-telling bur-fortune-telling-add ">
    <?= $this->Form->create($freeFortune) ?>
        <?php
     $this->Form->create($freeFortune) ?>
    <fieldset>
        <legend><?= __('Add Brm User Fortune Free') ?></legend>
        <?php
            echo $this->Form->hidden('user_id',['value'=> $users['id']]);
            echo $this->Form->input('username',['value'=> $users['username']]);
            echo $this->Form->input('job');
            echo $this->Form->textarea('content');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

</div>


