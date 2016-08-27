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
                <?php if($isCheck == true):
                $isCheckUser = $this->FortuneSchedule->CheckIsHasUser($id, $day, $time->id);
                ?>
                <?php if($isCheckUser == true): ?>
                      <td data-toggle="modal" data-target="#myModal" class="bur-infor-user" id="bur-check-time-<?= $time->id ?>" data-id="<?= $id ?>" data-day="<?= $day ?>" data-time="<?= $time->id; ?>">
                        <?= $this->Html->image('icon/User.png', ['alt'=>'user']) ?>
                      </td>
                <?php elseif($isCheckUser == false): ?>
                      <td ><?= $this->Html->image('icon/reOn.gif', ['alt'=>'dt']) ?></td>
                <?php endif; ?>
                <?php elseif($isCheck == false): ?>
                      <td></td>
                <?php endif; ?>
              <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>

<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Thông tin</h4>
      </div>
      <div class="modal-body">
        <!-- ajax -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
