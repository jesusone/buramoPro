<div class="container">

    <div>

        <!-- Nav tabs -->
        <ul id="myTabs" class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#bur-fortune" aria-controls="bur-fortune" role="tab" data-toggle="tab"><?= __('先生の名前') ?></a></li>
            <li role="presentation"><a href="#bur-reviews" aria-controls="bur-reviews" role="tab" data-toggle="tab"><?= __('口コミ') ?></a></li>
            <li role="presentation"><a href="#fortune-free" aria-controls="fortune-free" role="tab" data-toggle="tab"><?= __('お試し占い') ?></a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="bur-fortune">
                <div class="bur-find-fortune form">
                    <?= $this->Form->create() ?>
                    <?= $this->Form->input('keyword') ?>
                    <?= $this->Form->hidden('prof') ?>
                    <?= $this->Form->hidden('pres') ?>
                    <?= $this->Form->hidden('od') ?>
                    <?= $this->Form->button(__('search')); ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="bur-reviews">
                <div class="bur-find-fortune form">
                    <?= $this->Form->create(null,['url' => ['controller'=>'FortuneFreec','action' => 'index'],'type' => 'get']) ?>
                    <?= $this->Form->input('keyword') ?>
                    <?= $this->Form->button(__('search')); ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="fortune-free">
                <div class="bur-find-fortune form">
                    <?= $this->Form->create(null,['url' => ['controller'=>'FortuneFreec','action' => 'index'],'type' => 'get']) ?>
                    <?= $this->Form->input('keyword') ?>
                    <?= $this->Form->button(__('search')); ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>

    </div>

</div>
<script type="application/javascript">
    jQuery('#myTabs a').click(function (e) {
        e.preventDefault()
        jQuery(this).tab('show')
    })
</script>