<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Schedules') ?></h3>

    <table border="1" cellpadding="0" cellspacing="0" width="100%">
        <thead>
        </thead>
        <tbody>
        <tr>
            <th>&nbsp;</th>
            <th>10<br/>時</th>
            <th>11<br/>時</th>
            <th>12<br/>時</th>
            <th>13<br/>時</th>
            <th>14<br/>時</th>
            <th>15<br/>時</th>
            <th>16<br/>時</th>
            <th>17<br/>時</th>
            <th>18<br/>時</th>
            <th>19<br/>時</th>
            <th>20<br/>時</th>
            <th>21<br/>時</th>
            <th>22<br/>時</th>
            <th>23<br/>時</th>
            <th>0<br/>時</th>
            <th>1<br/>時</th>
        </tr>
        <?php if( !empty($listSchedule) ): ?>

            <?php
            foreach($days as $i => $day): ?>
                <tr>
                    <th class="week"><p class="mon"><?php echo substr($day, -4); ?></p></th>

                    <?php foreach ($listSchedule as $key => $schedule) {
                        $date_time = date("Y-m-d", strtotime($schedule->date)).$schedule->time;
                        if ($date_time == $day."10") { ?>
                                <td style="background:red"></td>
                            <?php break;
                        } else{
                            if ($key == count($listSchedule)-1) { ?>
                                <td></td>
                            <?php  } else
                                continue;
                        }
                    } ?>

                    <?php foreach ($listSchedule as $key => $schedule) {
                        $date_time = date("Y-m-d", strtotime($schedule->date)).$schedule->time;
                        if ($date_time == $day."11") { ?>
                            <td style="background:red"></td>
                            <?php break;
                        } else{
                            if ($key == count($listSchedule)-1) { ?>
                                <td></td>
                            <?php  } else
                                continue;
                        }
                    } ?>

                    <?php foreach ($listSchedule as $key => $schedule) {
                        $date_time = date("Y-m-d", strtotime($schedule->date)).$schedule->time;
                        if ($date_time == $day."12") { ?>
                            <td style="background:red"></td>
                            <?php break;
                        } else{
                            if ($key == count($listSchedule)-1) { ?>
                                <td></td>
                            <?php  } else
                                continue;
                        }
                    } ?>

                    <?php foreach ($listSchedule as $key => $schedule) {
                        $date_time = date("Y-m-d", strtotime($schedule->date)).$schedule->time;
                        if ($date_time == $day."13") { ?>
                            <td style="background:red"></td>
                            <?php break;
                        } else{
                            if ($key == count($listSchedule)-1) { ?>
                                <td></td>
                            <?php  } else
                                continue;
                        }
                    } ?>

                    <?php foreach ($listSchedule as $key => $schedule) {
                        $date_time = date("Y-m-d", strtotime($schedule->date)).$schedule->time;
                        if ($date_time == $day."14") { ?>
                            <td style="background:red"></td>
                            <?php break;
                        } else{
                            if ($key == count($listSchedule)-1) { ?>
                                <td></td>
                            <?php  } else
                                continue;
                        }
                    } ?>

                    <?php foreach ($listSchedule as $key => $schedule) {
                        $date_time = date("Y-m-d", strtotime($schedule->date)).$schedule->time;
                        if ($date_time == $day."15") { ?>
                            <td style="background:red"></td>
                            <?php break;
                        } else{
                            if ($key == count($listSchedule)-1) { ?>
                                <td></td>
                            <?php  } else
                                continue;
                        }
                    } ?>

                    <?php foreach ($listSchedule as $key => $schedule) {
                        $date_time = date("Y-m-d", strtotime($schedule->date)).$schedule->time;
                        if ($date_time == $day."16") { ?>
                            <td style="background:red"></td>
                            <?php break;
                        } else{
                            if ($key == count($listSchedule)-1) { ?>
                                <td></td>
                            <?php  } else
                                continue;
                        }
                    } ?>

                    <?php foreach ($listSchedule as $key => $schedule) {
                        $date_time = date("Y-m-d", strtotime($schedule->date)).$schedule->time;
                        if ($date_time == $day."17") { ?>
                            <td style="background:red"></td>
                            <?php break;
                        } else{
                            if ($key == count($listSchedule)-1) { ?>
                                <td></td>
                            <?php  } else
                                continue;
                        }
                    } ?>

                    <?php foreach ($listSchedule as $key => $schedule) {
                        $date_time = date("Y-m-d", strtotime($schedule->date)).$schedule->time;
                        if ($date_time == $day."18") { ?>
                            <td style="background:red"></td>
                            <?php break;
                        } else{
                            if ($key == count($listSchedule)-1) { ?>
                                <td></td>
                            <?php  } else
                                continue;
                        }
                    } ?>

                    <?php foreach ($listSchedule as $key => $schedule) {
                        $date_time = date("Y-m-d", strtotime($schedule->date)).$schedule->time;
                        if ($date_time == $day."19") { ?>
                            <td style="background:red"></td>
                            <?php break;
                        } else{
                            if ($key == count($listSchedule)-1) { ?>
                                <td></td>
                            <?php  } else
                                continue;
                        }
                    } ?>

                    <?php foreach ($listSchedule as $key => $schedule) {
                        $date_time = date("Y-m-d", strtotime($schedule->date)).$schedule->time;
                        if ($date_time == $day."20") { ?>
                            <td style="background:red"></td>
                            <?php break;
                        } else{
                            if ($key == count($listSchedule)-1) { ?>
                                <td></td>
                            <?php  } else
                                continue;
                        }
                    } ?>

                    <?php foreach ($listSchedule as $key => $schedule) {
                        $date_time = date("Y-m-d", strtotime($schedule->date)).$schedule->time;
                        if ($date_time == $day."21") { ?>
                            <td style="background:red"></td>
                            <?php break;
                        } else{
                            if ($key == count($listSchedule)-1) { ?>
                                <td></td>
                            <?php  } else
                                continue;
                        }
                    } ?>

                    <?php foreach ($listSchedule as $key => $schedule) {
                        $date_time = date("Y-m-d", strtotime($schedule->date)).$schedule->time;
                        if ($date_time == $day."22") { ?>
                            <td style="background:red"></td>
                            <?php break;
                        } else{
                            if ($key == count($listSchedule)-1) { ?>
                                <td></td>
                            <?php  } else
                                continue;
                        }
                    } ?>

                    <?php foreach ($listSchedule as $key => $schedule) {
                        $date_time = date("Y-m-d", strtotime($schedule->date)).$schedule->time;
                        if ($date_time == $day."23") { ?>
                            <td style="background:red"></td>
                            <?php break;
                        } else{
                            if ($key == count($listSchedule)-1) { ?>
                                <td></td>
                            <?php  } else
                                continue;
                        }
                    } ?>

                    <?php foreach ($listSchedule as $key => $schedule) {
                        $date_time = date("Y-m-d", strtotime($schedule->date)).$schedule->time;
                        if ($date_time == $day."0") { ?>
                            <td style="background:red"></td>
                            <?php break;
                        } else{
                            if ($key == count($listSchedule)-1) { ?>
                                <td></td>
                            <?php  } else
                                continue;
                        }
                    } ?>

                    <?php foreach ($listSchedule as $key => $schedule) {
                        $date_time = date("Y-m-d", strtotime($schedule->date)).$schedule->time;
                        if ($date_time == $day."1") { ?>
                            <td style="background:red"></td>
                            <?php break;
                        } else{
                            if ($key == count($listSchedule)-1) { ?>
                                <td></td>
                            <?php  } else
                                continue;
                        }
                    } ?>

                </tr>
        <?php endforeach; ?>

        <?php elseif (empty($listSchedule)): ?>
            <?php foreach($days as $i => $day): ?>
                <tr>
                    <th class="week"><p class="mon"><?php echo substr($day, -4); ?></p></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
