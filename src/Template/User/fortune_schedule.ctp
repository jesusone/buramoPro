<link rel="stylesheet" href="/buramoPro/css/schedule.css">
<?php  $daysInWeek = [
    'Sun', //Sunday starts at 0
    'Mon',
    'Tue',
    'Wed',
    'Thu',
    'Fri',
    'Sat'
];
?>
<div class="users view large-9 medium-8 columns content container">
    <h3><?= __('Fortune Schedules') ?></h3>

    <div class="col-lg-10 col-md-5 col-sm-8 col-xs-9 schedule-tab-container">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 schedule-tab-menu">
                <div class="list-group">
                    <?php foreach($listSchedule as $i => $value): ?>
                        <a href="#" class="list-group-item text-center <?= ( $value['day'] == date('Y-m-d') ) ? 'active' : '' ?>">
                            <h4 class="glyphicon glyphicon">
                                <?= $value['day'] ?>
                                <?php
                                $date = $daysInWeek[(getdate(strtotime($value['day']))['wday'])];
                                ?>
                                <?= $this->Html->image('icon/icon'.$date.'.gif');?>
                            </h4>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 schedule-tab">

                <?php foreach($listSchedule as $i => $value): ?>
                <div class="schedule-tab-content" id="<?= h($value['day']) ?>"><!-- start day (from today to next 8 days)  -->
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
                        <?php if( !empty($listSchedule) ): ?>
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
                                        <td id="<?= $key ?>" align="center"><?= $this->Html->image('icon/reSta.gif');?></td>
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
                    <?php elseif (empty($listSchedule)): ?>
                        <h3><?= __('No Favorite Schedules Found') ?></h3>
                    <?php endif; ?>
                </div> <!-- end day (from today to next 8 days)-->
                <?php endforeach; ?>
            </div>
    </div>
</div>
<script>
$(document).ready(function() {

    var key = $(this).index();
    $("div.schedule-tab>div.schedule-tab-content").eq(key).addClass("active");

    $("div.schedule-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.schedule-tab>div.schedule-tab-content").removeClass("active");
        $("div.schedule-tab>div.schedule-tab-content").eq(index).addClass("active");
    });
});
</script>
