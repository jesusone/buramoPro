<div class="container">
    <div class="box bur-fortune-lists row">
        <table>
            <tr>
            <?php
            $fortune = isset($fortune) ? $fortune : '';?>
            <?php if ($fortune != ""): ?>
            <?php foreach ($fortune as $key => $item):
                ?>
                   <div class="col-md-4 bur-item">
                       <div class="por-header">
                           <div class="pof-name"><?= h($item->username) ?></div>
                           <?php
                           $favorite = false;
                           if(!empty($user_id)){
                                $favorite = $this->FavoriteUser->Favorite($item->id,$user_id);
                           }
                            $tags     = $this->FavoriteUser->TagsByFortune($item->id,$user_id);
                            $favoriteClass = $favorite ? 'delfav' : 'addfav' ;
                           ?>
                           <div class="pof-like <?= h($favoriteClass)?>"><?= $this->Html->link(
                               '',
                               '/pages/home',
                               ['class' => 'button', 'target' => '_blank']
                               );?></div>
                       </div>
                       <div class="pof-main">
                          <div class="por-media">
                            <?= $this->Html->image($item->avatar, [
                                    "alt" => __('待機中'),
                                    'url' => ['controller' => 'User','action' => 'FortuneDetail', $item->id]
                            ]); ?>
                              </div>
                           <div class="pof-action">
                               <?= $this->Html->link( __('待機中'), '/pages/home',['class' => 'button', 'target' => '_blank']);?>
                               <?= $this->Html->link( __('予約受付中'), '/pages/home',['class' => 'button', 'target' => '_blank']);?>
                               <?= $this->Html->link( __('待機予定'), '/pages/home',['class' => 'button', 'target' => '_blank']);?>
                           </div>
                       </div>
                       <div class="pof-data-detail">

                       </div>
                       <div class="pof-tags">
                            <?= h($tags); ?>
                       </div>
                    </div>
            <?php endforeach; ?>
            <?php endif; ?>
            </tr>
        </table>
    </div>
</div>
