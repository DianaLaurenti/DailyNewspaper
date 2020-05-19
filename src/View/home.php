<?php $this->layout('layout', ['title' => 'Home']) ?>

<?php foreach($articles as $a): ?>
    <h3><?=$this->e($a->title)?></h3>
    <h5>di <?=$this->e($a->author)?></h5>
    <p><?=$this->e($a->content)?></p>
    </br>
<?php endforeach ?>