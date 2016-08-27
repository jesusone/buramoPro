<table border="1" style="width: 100%; margin-top: 40px" >
	<tbody>
		<tr>
      <th>&nbsp;</th>
      <?php if(!empty($times)): ?>
        <?php foreach($times as $index => $time): ?>
            <th><?=$time->time_text?></th>
        <?php endforeach; ?>
      <?php endif; ?>
    </tr>
    <?php if(!empty($days)): ?>
        <?php foreach($days as $index => $day): ?>
            <tr>
              <th>
                <?= date('m-d', strtotime($day)) ?>
              </th> 
              <?php
              foreach($times as $time):
                $isCheck = $this->FortuneSchedule->CheckIsTime($id, $day, $time->id);
              ?>
                <?php if($isCheck == true): ?>
                        <td><?= $this->Html->image('icon/reOn.gif', ['alt' => 'dt']); ?></td>
                <?php elseif($isCheck == false): ?>
                        <td class="bur-check-time" id="bur-check-time-<?= $time->id ?>" data-id="<?= $id ?>" data-day="<?= $day ?>" data-time="<?= $time->id; ?>"></td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>
