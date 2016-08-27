<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('mail_address');
        echo $this->Form->input('telephone');
        echo $this->Form->input('birthday',array('type' => 'date'));
        echo $this->Form->label('gender');
        $options=array('0'=>'Male','1'=>'Female');
        $attributes=array('legend'=>false);
        echo $this->Form->radio('gender',$options,$attributes);
        echo $this->Form->input('question_id',['options' => $mquestions]);
        echo $this->Form->input('answer');
        echo $this->Form->input('post_code');
        echo $this->Form->checkbox('mail_maga', ['hiddenField' => false]); echo 'Send mail'; echo '<br>';
        echo $this->Captcha->create('securitycode');
        ?>
        </fieldset>
        <?= $this->Form->button(__('Register')) ?>
        <?= $this->Form->end() ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    jQuery('.creload').on('click', function() {
        var mySrc = $(this).prev().attr('src');
        var glue = '?';
        if(mySrc.indexOf('?')!=-1)  {
            glue = '&';
        }
        $(this).prev().attr('src', mySrc + glue + new Date().getTime());
        return false;
    });
</script>

