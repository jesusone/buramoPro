<div class="container">
  <h2><?= __('Tìm kiếm') ?></h2>
  <ul class="nav nav-tabs">
    <li>
    	<?= $this->Html->link(
		    __('Tất Cả'),
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
    <div id="month">
      <h4><?=__('Tìm kiếm theo tháng')?></h4>
      <?= $this->Form->create() ?>
      	<?= $this->Form->select('month', [0,1,2,3,4,5,6,7,8,9,10,11,12],[
      		'empty'   => __('choose month'),
      		'style'   => 'width: 114px; height: 34px'
      	]) ?>
      <?= $this->Form->year('years', [
		    'minYear' => 2000,
		    'maxYear' => date('Y'),
		    'empty'   => __('choose year'),
		    'style'   => 'width:114px; height: 34px'
		  ]) ?>
		  <input type="submit" name="ok" value="Tìm kiếm">
      <?= $this->Form->end() ?>
    </div>
    <div>
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
                <td><?= $item->user->full_name = isset($item->user->id) ? $item->user->full_name : '-' ?></td>
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