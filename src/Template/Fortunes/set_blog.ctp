<h2><?= __('Hello Your Blog') ?></h2>
<?= $this->Form->create('', ['class' => "form-horizontal"]) ?>
	<div class="form-group">
		<label class="col-sm-2 control-label"><?= __('Tiêu đề') ?></label>
		<div class="col-sm-10">
			<?= $this->Form->input('blog_header', ['class' => "form-control", 'label' => false]) ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label"><?= __('Url') ?></label>
		<div class="col-sm-10">
			<?= $this->Form->input('blog_url', ['class' => "form-control", 'label' => false]) ?>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default"><?= __('Submits') ?></button>
		</div>
	</div>
	<?= $this->Form->end() ?>
