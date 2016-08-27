<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('master.css') ?>
    <?= $this->Html->css('jquery-ui.min.css') ?>
    <?= $this->Html->script('jquery-3.1.0.min.js') ?>
    <?= $this->Html->script('jquery-ui.min.js') ?>
    <?= $this->Html->css('fortune_set_schedule.css') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="container">
        
        <div id="content" >
            <nav class="main-menu">
                <ul>
                    <li><a href="#"><?= $this->Html->image("level/menuTop.png", ['fullBase' => true]); ?></a></li>
                    <li><a href="#"><?= $this->Html->image("level/menuSearch.png", ['fullBase' => true]); ?></a></li>
                    <li><a href="#"><?= $this->Html->image("level/menuVoice.png", ['fullBase' => true]); ?></a></li>
                    <li><a href="#"><?= $this->Html->image("level/menuCharge.png", ['fullBase' => true]); ?></a></li>
                    <li><a href="#"><?= $this->Html->image("level/menuRanking.png", ['fullBase' => true]); ?></a></li>
                    <li><a href="#"><?= $this->Html->image("level/menuMail.png", ['fullBase' => true]); ?></a></li>
                </ul>
            </nav>
            <div  class="row">
                <div id="sidebar" class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <?= $this->element('sidebar/home_left_fortune') ?>
                </div>
                <div id="primary" class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </div>
            </div>
        </div>
        <footer>
        </footer>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('fortune.js') ?>
</body>
</html>
