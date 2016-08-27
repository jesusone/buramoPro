<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('kanji_name');
            echo $this->Form->input('kana_name');
            echo $this->Form->input('full_name');
            echo $this->Form->input('mail_address');
            echo $this->Form->input('address');
            echo $this->Form->input('telephone');
            echo $this->Form->input('birthday',array('type' => 'date'));
            echo $this->Form->input('gender', ['options' => ['1' => 'Male', '2' => 'Female'] ]);
            echo $this->Form->input('mail_maga', ['options' => ['0' => 'NO', '1' => 'YES'] ]);
            //echo $this->Form->input('question_id', ['options' => ['1' => 'What is your mother name?', '2' => 'What is your father name?', '3' => 'What is your hometown?'] ]);
            echo $this->Form->input('question_id',['options' => $mquestions]);
            echo $this->Form->input('answer');
            echo $this->Form->input('post_code');
            echo $this->Form->input('current_password');
            if ($this->Form->isFieldError('current_password')) {
                echo $this->Form->error('current_password');
            }
        ?>
    </fieldset>
    <?= $this->Form->button(__('Update')) ?>
    <?= $this->Form->end() ?>
</div>
