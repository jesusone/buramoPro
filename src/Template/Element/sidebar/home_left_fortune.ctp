<?php 
	if ($this->request->Session()->read('Auth')) {
		$data = $this->request->Session()->read('Auth');
		if (isset($data['User']['id'])) {
			$id_fortune = $data['User']['id'];
			$msg = $this->FortuneSchedule->getCountMsg($id_fortune);
			$msg = isset($msg) ? $msg : '';
		}
	}
 ?>
<div>
	<div id="sidebar">
		<ul class="sidearea">
			<li class="logo">
				<div class="userArea">
					<p>
						<?= $this->Html->link($this->Html->image("level/iconRegular.png", ["alt" => "level regular"]),
    						"recipes/view/6",
    						['escape' => false]
						) ?>
					</p>
					<p></p>
				</div>
			</li>
			<li class="login_menu border-top">
				<?= $this->Html->link('My page', ['controller' => 'Fortunes', 'action' => 'index', '_full' => true]) ?>
				<ul>

					<li><?= $this->Html->link('Xác nhận thành quả mà mình đã bói', ['controller' => 'Fortunes', 'action' => 'excuteHistory', '_full' => true]) ?>
					</li>
					<li><?= $this->Html->link('Hộp thư', ['controller' => 'Fortunes', 'action' => 'messages']) ?>
						<ul>
							<li><?= $this->Html->link('Inbox ('.$msg.')', ['controller' => 'Fortunes', 'action' => 'messages']) ?></li>
							<li><?= $this->Html->link('Tin nhắn từ nhà quản lý', ['controller' => 'Fortunes', 'action' => 'index']) ?></li>
						</ul>
					</li>
					<li><?= $this->Html->link('Bói bằng video', ['controller' => 'Fortunes', 'action' => 'index']) ?>
						<ul>
							<li><?= $this->Html->link('Trạng thái', ['controller' => 'Fortunes', 'action' => 'index']) ?></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="login_menu border-top">
				<?= $this->Html->link('Quản lý lịch', ['controller' => 'Fortunes', 'action' => 'index']) ?>
				<ul>
					<li><?= $this->Html->link('List lịch hẹn của ngày hôm nay', ['controller' => 'Fortunes', 'action' => 'todaySchedule']) ?></li>
					<li><?= $this->Html->link('Lịch sử 5 lần bói gần nhất', ['controller' => 'Fortunes', 'action' => 'listHistoryFiveTeller']) ?></li>
					<li><?= $this->Html->link('Cập nhật lịch', ['controller' => 'Fortunes', 'action' => 'setSchedule']) ?></li>
				</ul>
			</li>
			<li class="login_menu border-top">
				<?= $this->Html->link('Edit Profile', ['controller' => 'Fortunes', 'action' => 'index']) ?>
				<ul>
					<li><?= $this->Html->link('Thuật giám định chính', ['controller' => 'Fortunes', 'action' => 'index']) ?></li>
					<li><?= $this->Html->link('Nội dung bói', ['controller' => 'Fortunes', 'action' => 'index']) ?></li>
				</ul>
			</li>
			<li class="login_menu border-top">
				<?= $this->Html->link('Blog', ['controller' => 'Fortunes', 'action' => 'index']) ?>
				<ul>
					<li><?= $this->Html->link('List blog', ['controller'     => 'Fortunes', 'action' => 'indexBlog']) ?></li>
					<li><?= $this->Html->link('Tạo blog', ['controller'      => 'Fortunes', 'action' => 'setBlog']) ?></li>
					<li><?= $this->Html->link('Add link root', ['controller' => 'Fortunes', 'action' => 'addUrlRoot']) ?></li>
				</ul>
			</li>
			<li class="login_menu border-top">
				<?= $this->Html->link('Xem Bình luận', ['controller' => 'Fortunes', 'action' => 'watchComment']) ?>
			</li>
		</ul>
	</div>
</div>