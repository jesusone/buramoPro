<h2><?= __('List Blog') ?></h2>
<p><?= __('The list blog class adds borders to a table') ?>:</p>
<table class="table table-bordered">
	<thead>
		<tr>
			<th><?= __('STT') ?></th>
			<th><?= __('Blog-Head') ?></th>
			<th><?= __('Blog-Url') ?></th>
			<th><?= __('Created') ?></th>
			<th><?= __('Edit') ?></th>
			<th><?= __('Delete') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php if(!empty($listBlog)): ?>
		<?php foreach($listBlog as $index => $blog): ?>
			<tr>
				<td><?= $index+1 ?></td>
				<td><?= $blog->blog_header ?></td>
				<td><?= $blog->blog_url ?></td>
				<td><?= date('Y-m-d', strtotime($blog->date_created)) ?></td>
				<td><?= $this->Html->link('Edit', ['action' => 'editBlog', $blog->id]) ?></td>
				<td><?= $this->Html->link('Delete', ['action' => 'deleteBlog', $blog->id]) ?></td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
	</tbody>
</table>