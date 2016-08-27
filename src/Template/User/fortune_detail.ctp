<?php 
?>

<div class="fortune-detail-warpers">
    <div class="for-profile-detail clearfix">
        <div class="for-logo " >
            <?= $this->Html->image($fortune->avatar, [
                "alt" => __('待機中'),
                'url' => ['controller' => 'User','action' => 'FortuneDetail', $fortune->id]
                ]); ?>
        </div>
        <div class="for-info">
            <p>
                <label><?= __('相談件数') ?></label>
                <span class="for-count-history"><?= $fortune->count_history; ?><?= __('件') ?></span>
                <span><?= __('口コミ') ?></span>
                <span class="fro-count-comments"> <?= $fortune->count_comments; ?></span>
                <span><?= __('件') ?></span>
            </p>
            <p>
                <label><?= __('就業開始時期') ?></label>
                <span class="for-create-day"><?= $fortune->date_created ?><?= $fortune->date_created  ?></span>
            </p>
            <p>
                <label><?= __('占い歴') ?></label>
                <span class="for-review-history"><?= $fortune->date_created ?><?= __('10年 3ヶ月（プロ占い歴9年 7ヶ月））') ?></span>
            </p>
            <p>
                <label><?= __('価格') ?></label>
                <span class="for-phone"><?= __('1分 /') ?>240</span>
                <span class="for-sms"><?= __('1通  / 8000円＋消費税') ?>240</span>
            </p>
        </div>
        <div class="staBtn">
            <div>
                <?= $this->Html->image('icon/staOn_L.png', [
                    'alt' => 'messages',
                    'class' => 'iconSta_L',
                    'url' => ['controller' => 'fortunes', 'action' => '']
                ]) ?>
                相談中
            </div>
            <div>
                <?= $this->Html->image('icon/iconStar_on.png', [
                    'alt' => 'star',
                    'url' => ['controller' => 'fortunes', 'action' => '']
                ]) ?>
                相談中
            </div>
        </div>
    </div>

    <ul class="listMenu nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#home"><?= __('メッセージ') ?></a></li>
      <li><a data-toggle="tab" href="#menu1"><?= __('予約受付表') ?></a></li>
      <li><a data-toggle="tab" href="#menu2"><?= __('待機予定') ?></a></li>
      <li><a data-toggle="tab" href="#menu3"><?= __('口コミ') ?></a></li>
      <li><a data-toggle="tab" href="#menu4"><?= __('回答したお試し占い') ?></a></li>
      <li><a data-toggle="tab" href="#menu5"><?= __('ブログ') ?></a></li>
      <li><a data-toggle="tab" href="#menu6"><?= __('つぶやき') ?></a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <div class="for-content-warpper">
                <h2 class="subject"><?= __('先生からのお知らせ') ?></h2>
                <div class="for-content">
                    <?php
                    if($fortuneExtract->news_from_teacher){
                        echo $fortuneExtract->news_from_teacher;
                    }
                    ?>
                </div>
            </div>
            <div class="for-content-warpper">
                <h2 class="subject"><?= __('皆様へのメッセージ') ?></h2>
                <div class="for-content">
                    <?php
                    if($fortuneExtract->message_to_everyone){
                        echo $fortuneExtract->message_to_everyone;
                    }?>
                </div>
            </div>
            <div class="for-content-warpper">
                <h2 class="subject"><?= __('占うことが出来る相談内容') ?></h2>
                <div class="for-content">
                    <?php
                    if($fortuneExtract->consultation_content){
                        echo $fortuneExtract->consultation_content;
                    }?>
                </div>
            </div>
            <div class="for-content-warpper">
                <h2 class="subject"><?= __('得意な相談トップ3') ?></h2>
                <div class="for-content">
                    <?php
                    if($fortuneExtract->good_at_consultation){
                        echo $fortuneExtract->good_at_consultation;
                    }?>
                </div>
            </div>
            <div class="for-content-warpper">
                <h2 class="subject"><?= __('占いスタイル') ?></h2>
                <div class="for-content">
                    <?php
                    if($fortuneExtract->fortune_telling_style){
                        echo $fortuneExtract->fortune_telling_style;
                    }?>
                </div>
            </div>
            <div class="for-content-warpper">
                <h2 class="subject"><?= __('スピリチュアル力') ?></h2>
                <div class="for-content">
                    <?php
                    if($fortuneExtract->spiritual_force){
                        echo $fortuneExtract->spiritual_force;
                    }?>
                    ?>
                </div>
            </div>
            <div class="for-content-warpper">
                <h2 class="subject"><?= __('趣味') ?></h2>
                <div class="for-content">
                    <?php
                    if($fortuneExtract->hobby){
                        echo $fortuneExtract->hobby;
                    }?>
                </div>
            </div>
        </div>
<!-- menu 1 -->
        <div id="menu1" class="tab-pane fade">
            <h2 class="subject">予約スケジュール</h2>
            <p>こちらから鑑定の予約を申し込むことができます。
予約は無料です。予約するには、ご希望の日時をクリックしてください</p>
            <p>
                <?= $this->Html->image('icon/reSta.gif', ['alt' => 'reSta']) ?>
                <?= $this->Html->image('icon/reOff.gif', ['alt' => 'reOff']) ?>
            </p>
            <table border="1" style="width: 100%; margin-top: 40px; margin-bottom: 40px;" >
                <tbody>
                    <tr>
                      <th>&nbsp;</th>
                      <?php if(!empty($times)): ?>
                        <?php foreach($times as $index => $time): ?>
                            <th><?=$time->time_text?></th>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tr>
                    <?php if(!empty($seventDaynow)): ?>
                        <?php foreach($seventDaynow as $index => $day): ?>
                        <tr>
                          <th>
                            <?= date('m-d', strtotime($day)) ?>
                          </th> 
                          <?php foreach($times as $time): 
                            $checkUserOrder = $this->FortuneSchedule->checkUserOrder($id, $day, $time->id);
                          ?>
                                <?php if($checkUserOrder == true): ?>
                                    <td>
                                        <?= $this->Html->image('icon/reSta.gif',[
                                            'alt' => 'reSta',
                                            'url' => ['controller' => 'fortunes', 'action' => '']
                                        ]) ?>
                                    </td>
                                <?php elseif($checkUserOrder == false): ?>
                                    <td></td>
                                <?php endif; ?>
                          <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
        </div>
<!-- end menu 1 -->

<!-- menu 2 -->
        <div id="menu2" class="tab-pane fade">
            <h2 class="subject">待機予定</h2>
            <p>こちらは占い師の待機予定です。
鑑定のお申込みの目安にしてください。</p>
            <p>
                <?= $this->Html->image('icon/reOn.gif', ['alt' => 'reOn']) ?>待機予定
            </p>
            <table border="1" style="width: 100%; margin-top: 40px; margin-bottom: 40px;" >
                <tbody>
                    <tr>
                      <th>&nbsp;</th>
                      <?php if(!empty($timeEstimates)): ?>
                        <?php foreach($timeEstimates as $index => $time): ?>
                            <th><?=$time->time_text?></th>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tr>
                    <?php if(!empty($allDayInWeek)): ?>
                        <?php foreach($allDayInWeek as $index => $day): ?>
                        <tr>
                          <th>
                            <?= date('m-d', strtotime($day)) ?>
                          </th> 
                          <?php foreach($timeEstimates as $time):
                            $checkTime = $this->FortuneSchedule->CheckIsTime($id, $day, $time->id);
                          ?>
                            <?php if($checkTime == true): ?>
                               <td>
                                   <?= $this->Html->image('icon/reOn.gif', ['alt' => 'reOn']) ?>
                               </td>
                            <?php elseif($checkTime == false): ?>
                                <td></td>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
        </div>
<!-- end menu 2 -->

        <div id="menu3" class="tab-pane fade">
            <div class="for-content-warpper">
                <h2 class="subject"><?= __('先生からのお知らせ') ?></h2>
                <div class="for-content">
                    <?php
                    if(!empty($comments)){
                        ?>
                        <h2 class="subject"><?= __('口コミ') ?></h2>
                        <?php
                        foreach($comments  as $key => $comment) {
                            ?>
                            <div class="comment-item">
                                <div class="for-comment-body">
                                    <?= $comment->comment_content;?>
                                </div>
                                <div class="for-comment-info">
                                    <ul class="for-info-wrapper">
                                        <li class="for-name"><?= $comment->user->full_name; ?></li>
                                        <li class="for-name"><?php

                                           $age  =    $this->FavoriteUser->getAgeForUser($comment->user->birthday->format('Y-m-d'));
                                           echo $age;
                                           ?> <?= __('代')?></li>
                                           <li class="for-day-comments"><?= $comment->date_created->format('Y.m.d')?></li>
                                       </ul>
                                   </div>
                               </div>
                               <?php
                           }
                       }
                       ?>
                   </div>
               </div>
        </div>

<!-- menu 4 -->
        <div id="menu4" class="tab-pane fade">
            <h2>回答したお試し占い</h2>
            <p>皆様から寄せられたお試し占いの投稿から一部をお選びし、無料でお答えします。
※ ご本人様の了承を得て掲載しています。
            </p>
            <?php if(!empty($fortuneFree)): ?>
                <ul>
                    <?php foreach($fortuneFree as $freec): ?>
                        <li></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
<!-- end menu 4 -->

        <div id="menu6" class="tab-pane fade">
            <h2>ヒカリ先生のつぶやき</h2>
            <p>ヒカリ先生のつぶやき最新10件を表示しています。</p>
        </div>
        <div id="menu5" class="tab-pane fade">
            <div class="for-content-warpper">
                <h2 class="subject"><?= __('先生からのお知らせ') ?></h2>
                <div class="for-content">
                    <p>show Blog</p>
                    <ul class="blog">
                        <?php if(!empty($blogs)): ?>
                        <?php foreach($blogs as $blog): ?>
                            <li>
                                <span class="update"><?= date('m/d', strtotime($blog->date_created)) ?> <?= date('H:i', strtotime($blog->date_created)) ?></span>&nbsp;
                                <?= $this->Html->link(
                                    "$blog->blog_header",
                                    "$blog->blog_url",
                                    ['target'=>"_blank"]
                                ) ?>
                            </li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                    <p class="more r">
                    <?php if(!empty($blogUrlRoot)): ?>
                        <?= $this->Html->link("$blogUrlRoot->blog_header_root", "$blogUrlRoot->blog_url_root", ['class' => 'arr_more', 'target' => "_blank"]) ?>
                    <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

<!-- slide -->
    <div class="fortune-slider-bottom">
         <?= $this->element('fortunes/fortune_slider') ?>
    </div>
<!-- end slide -->
</div>
