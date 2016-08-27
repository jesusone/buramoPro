<h2><?= __('Add Url Root') ?></h2>
<?= $this->Form->create('', ['class' => "form-horizontal"]) ?>
<div class="form-group">
    <label class="col-sm-2 control-label"><?= __('Header Root') ?></label>
    <div class="col-sm-10">
        <?= $this->Form->input('blog_header_root', ['class' => "form-control", 'label' => false]) ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label"><?= __('Url Root') ?></label>
    <div class="col-sm-10">
        <?= $this->Form->input('blog_url_root', ['class' => "form-control", 'label' => false]) ?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default"><?= __('Submits') ?></button>
    </div>
</div>
<?= $this->Form->end() ?>
