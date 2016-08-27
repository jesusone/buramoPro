<div class="container">
  <h2><?= __('List 5 ngay gần nhất') ?></h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th><?= __('STT') ?></th>
        <th><?= __('Fortune ID') ?></th>
        <th><?= __('User ID') ?></th>
        <th><?= __('Minute') ?></th>
        <th><?= __('Money') ?></th>
        <th><?= __('Detail') ?></th>
      </tr>
    </thead>
    <tbody>
    <?php if(!empty($listFiveHistory)): ?>
      <?php foreach($listFiveHistory as $index => $item): ?>
        <tr>
          <td><?= $index+1 ?></td>
          <td><?= $item->fortune_id ?></td>
          <td><?= $item->user_id ?></td>
          <td><?= $item->minute ?></td>
          <td><?= $item->money ?></td>
          <td><?= $this->Html->link('Detail',['controller' => 'fortunes', 'action' => '', '_full' => true ])?></td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
  </table>
</div>