<?php $this->layout('layout', ['title' => 'Edit Articles']) ?>
<h2 style="color:#ff33c1">Qui puoi modificare/eliminare articoli</h2>
<?php foreach($articles as $a): ?>
    <h3><?=$this->e($a->getTitle())?></h3>
    <h5>di <?=$this->e($a->getAuthor())?></h5>
    <p><?=$this->e($a->getContent())?></p>
    <a href="/update?id=<?=$this->e($a->getId())?>">Update</a>
    <a href="/delete?id=<?=$this->e($a->getId())?>">Delete</a>
    </br></br>
<?php endforeach ?>