<h2><?= __('Edit Blog') ?></h2>
<?= $this->Form->create('', ['class' => "form-horizontal"]) ?>
	<input type="hidden" name="id_blog" value="<?= $dataBlog->id ?>">
	<div class="form-group">
		<label class="col-sm-2 control-label"><?= __('Tiêu Đề') ?></label>
		<div class="col-sm-10">
			<?= $this->Form->input('blog_header', ['class' => "form-control", 'label' => false, 'value' => $dataBlog->blog_header]) ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Url</label>
		<div class="col-sm-10">
			<?= $this->Form->input('blog_url', ['class' => "form-control", 'label' => false, 'value' => $dataBlog->blog_url]) ?>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default"><?= __('Submits') ?></button>
		</div>
	</div>
	<?= $this->Form->end() ?>
