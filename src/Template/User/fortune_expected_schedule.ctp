<div class="users view large-9 medium-8 columns content">
    <h3><?= __('Fortune Expected Schedules') ?></h3>
    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a href="#Monday" data-toggle="tab">Monday</a></li>
        <li><a href="#Tuesday" data-toggle="tab">Tuesday</a></li>
        <li><a href="#Wednesday" data-toggle="tab">Wednesday</a></li>
        <li><a href="#Thursday" data-toggle="tab">Thursday</a></li>
        <li><a href="#Friday" data-toggle="tab">Friday</a></li>
        <li><a href="#Saturday" data-toggle="tab">Saturday</a></li>
        <li><a href="#Sunday" data-toggle="tab">Sunday</a></li>
    </ul>

    <div id="my-tab-content" class="tab-content"><!-- start tab content -->

        <?php foreach($listScheduleInWeek as $i => $value): ?>

            <div class="tab-pane <?= $value['day'] == 'Monday' ? 'active' : '' ?>" id="<?= h($value['day']) ?>"><!-- start day (from monday to sunday)  -->
                <table border="1" cellpadding="0" cellspacing="0" width="100%">
                    <thead>
                    </thead>
                    <tbody>
                    <tr>
                        <th>&nbsp;</th>
                        <?php foreach($times as $i => $hour): ?>
                            <th><?= __(json_decode(str_replace('\n', '<br>', json_encode($hour['time_text'])))) ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <?php if( !empty($listScheduleInWeek) ): ?>
                    <?php
                    foreach($value['data'] as $index => $data):
                        $listTime = $this->FortuneSchedule->getTimeScheduleByFortune($data->fortune_id,$data->schedule_day );
                        $timeArray = array();
                        foreach($listTime as $keyTime => $timeValue)   {
                            $timeArray[$index][$timeValue['ScheduleTime']['name']] = $timeValue['ScheduleTime']['id'];
                        }
                        ?>
                        <tr id="<?= $data['id'] ?>">
                            <th class="week"><p class="mon"><?php echo $data['fortunes']['username']; ?></th>
                            <?php
                            foreach($times as $key => $time) {
                                if (in_array($time->id,$timeArray[$index]) ) {
                                    ?>
                                    <td id="<?= $key ?>" align="center"><?= $this->Html->image('icon/reOn.gif');?></td>
                                    <?php
                                }
                                else {
                                    ?>
                                    <td id="<?= $key  ?>"></td>
                                    <?php

                                }
                            } ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php elseif (empty($listScheduleInWeek)): ?>
                    <h3><?= __('No Favorite Schedules Found') ?></h3>
                <?php endif; ?>
            </div> <!-- end day (from monday to sunday)-->
        <?php endforeach; ?>
    </div><!-- end tab content -->
</div>
