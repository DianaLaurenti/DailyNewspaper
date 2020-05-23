<?php $this->layout('layout', ['title' => 'Edit Articles']) ?>

<h2 style="color:#ff33c1">Qui puoi modificare/eliminare articoli</h2>

<?php foreach($articles as $a): ?>
    <h3><a href="/article?id=<?=$this->e($a->getId())?>"><?=$this->e($a->getTitle())?></a></h3>
    <h5>di <?=$this->e($a->getAuthor())?></h5>
    <p><?=$this->e($a->getContent())?></p>
    <a href="/update?id=<?=$this->e($a->getId())?>">Update</a>
    <a href="/delete?id=<?=$this->e($a->getId())?>">Delete</a>
    </br></br>
<?php endforeach ?>