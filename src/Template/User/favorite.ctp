<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Favorite Fortunes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <tbody>
        <?php foreach ($listFavoriteFortunes as $value): ?>
            <?php $row = (object) $value; ?>
            <div class="mT20">
                <div class="cf">

                    <div class="profile_fav relative">
                        <ul class="prf">
                            <li class="prfPhoto">
                                <?=  $this->Html->image($row->fortunes['avatar'], ["alt" => "fortune avatar"])   ?>
                            </li>
                            <li class="prfDate">
                                <p class="name">
                                    <a href="https://localhost/buramoPro/fortunes/view/<?= h($row->fortune_id) ?>"">
                                        <ruby>
                                            <rb><span class="sr"><?= h($row->fortunes['username'])?></span></rb>
                                            <rp>(</rp>
                                            <rt><?= h($row->fortunes['name'])?></rt>
                                            <rp>)</rp>
                                        </ruby>
                                        <img src="//image.excite.co.jp/jp/uranai/eximg/images/iconSpiritual.gif" border="0"
                                             alt="スピリチュアル" class="iconSpiritual"></a>
                                </p>
                                <p class="sr"><span class="spiritual">タロットカード☆複数のフルデッキによるオリジナルスプレッド☆</span></p>
                                <dl class="date cf">
                                    <dt class="bgBlue">相談件数</dt>
                                    <dd><p>10件&nbsp;<a href="https://localhost/buramoPro/user/comment/<?= h($row->fortune_id) ?>"><span id="report">（口コミ&nbsp;:&nbsp;<?= h($row->total_comments) ?>件）</span></a>
                                        </p></dd>
                                    <dt class="bgBlue">就業開始時期</dt>
                                    <dd><p><?= h($row->fortunes['start_time'])?></p></dd>
                                    <dt class="bgBlue">占い歴</dt>
                                    <dd><p><?= h($row->fortunes['experience_history'])?></p></dd>
                                    <dt class="bgBlue">価格</dt>
                                    <dd><p><span class="icon_tel"><span class="weight">1分</span>&nbsp;/&nbsp;<?= h($row->fortunes['price'])?>円</span>&nbsp;&nbsp;&nbsp;&nbsp;<span
                                                class="icon_mail"><span class="weight">1通</span>&nbsp;/&nbsp;<?= h($row->fortunes['price'])?>円</span></p>
                                    </dd>
                                </dl>
                            </li>
                        </ul>

                    </div><!-- /profile -->

                    <div id="staBtn">
                        <div><a href="https://localhost/buramoPro/user/call/<?= h($row->fortune_id) ?>" class="staL staStd_L"><img
                                    src="//image.excite.co.jp/jp/uranai/eximg/images/iconSta_L.png" class="iconSta_L">電話待機中</a>
                        </div>

                        <div><a href="https://localhost/buramoPro/user/deleteFavoriteFortune/<?= h($row->id) ?>"
                                class="staL fav"><img src="//image.excite.co.jp/jp/uranai/eximg/images/iconStar_off.png"
                                                      class="iconSta_L">お気に入りを解除</a>
                        </div>

                    </div><!-- /staBtn -->
                </div><!-- /cf -->
            </div>
            <br><br>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
