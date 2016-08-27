        <h1><?= __('Welcome Fortunes') ?></h1>
        <p><?= __('Please enter your username and password') ?></p>
<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>

        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
        <?php echo $this->Form->checkbox('remember_me'); ?> Remember Me

<?= $this->Form->button(__('Login')); ?>
<?= $this->Form->end() ?>
</div>
