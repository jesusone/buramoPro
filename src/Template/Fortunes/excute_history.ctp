<div class="container">
  <h2><?= __('Tìm kiếm') ?></h2>
  <ul class="nav nav-tabs">
    <li>
    	<?= $this->Html->link(
		    __('Tất cả'),
		    ['controller' => 'fortunes', 'action' => 'excuteHistory']
		) ?>
    </li>

    <li>
    	<?= $this->Html->link(
		    __('By Month'),
		    ['controller' => 'fortunes', 'action' => 'excuteHistoryByMonth']
		) ?>
    </li>

  </ul>

 <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      	<h3><?= __('Tất cả') ?></h3>
  		<table class="table table-bordered">
		    <thead>
		      <tr>
		        <th><?= __('STT') ?></th>
		        <th><?= __('Username') ?></th>
		        <th><?= __('Minute') ?></th>
		        <th><?= __('Money') ?></th>
		        <th><?= __('Created') ?></th>
		      </tr>
		    </thead>
    		<tbody>
    		<?php if(!empty($dataHistory)): ?>
    			<?php foreach($dataHistory as $index => $item): ?>
			      	<tr>
			        	<td><?= $index ?></td>
			        	<td><?= $item->user->username ?></td>
			        	<td><?= $item->minute ?></td>
			        	<td><?= $item->money ?></td>
			        	<td><?= date('Y-m-d', strtotime($item->date_created)) ?></td>
			      	</tr>
			    <?php endforeach; ?>
			<?php endif; ?>
    		</tbody>
  		</table>
    </div>
  </div>
</div>