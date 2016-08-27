<div>
	<div id="sidebar">
		<ul class="bur-profile-menu">
			<li class="logo">
				<div class="userArea">
					<p>
						<?= $this->Html->link($this->Html->image("level/iconRegular.png", ["alt" => "level regular"]),
    						"/user/edit/1",
    						['escape' => false]
						) ?>
					</p>
					<p></p>
				</div>
			</li>
			<?php //if(!$user_id):?>
			<li class="login_menu border-top">
				<?= $this->Html->link('マイページ', ['controller' => 'user', 'action' => 'schedule']) ?>
			</li>
			<li class="login_menu border-top">
				<?= $this->Html->link('ご利用明細', ['controller' => 'user', 'action' => 'point']) ?>
			</li>
			<li class="login_menu border-top">
				<?= $this->Html->link('コイン残高照会', ['controller' => 'user', 'action' => 'coin']) ?>
			</li>
			<li class="login_menu border-top">
				<?= $this->Html->link('会員ランク', ['controller' => 'user', 'action' => 'level']) ?>
			</li>
			<li class="login_menu border-top">
				<?= $this->Html->link('お気に入り占い師', ['controller' => 'user', 'action' => 'favorite']) ?>
			</li>
			<li class="login_menu border-top">
				<?= $this->Html->link('お気に入り占い師の待機予定', ['controller' => 'user', 'action' => 'favoriteSchedule']) ?>
			</li>
			<li class="login_menu border-top">
				<?= $this->Html->link('あなたの感想', ['controller' => 'user', 'action' => 'comment']) ?>
			</li>
			<li class="login_menu border-top">
				<?= $this->Html->link('メールボックス', ['controller' => 'user', 'action' => 'message']) ?>
			</li>
			<?php //else:?>
			<li class="login_menu border-top">
				<?= $this->Html->link('signup', ['controller' => 'user', 'action' => 'add']) ?>
			</li>
			<li class="login_menu border-top">
				<?= $this->Html->link('signin', ['controller' => 'user', 'action' => 'login']) ?>
			</li>
			<?php //endif;?>
		</ul>
	</div>
</div>
