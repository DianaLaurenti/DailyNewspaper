<?php $this->layout('layout', ['title' => 'Home']) ?>

<h2 style="color:#ff33c1">Gli articoli del giorno</h2>

<?php foreach($articles as $a): ?>
    <h3><a href="/article?id=<?=$this->e($a->getId())?>"><?=$this->e($a->getTitle())?></a></h3>
    <h5>di <?=$this->e($a->getAuthor())?></h5>
    <p><?=$this->e($a->getContent())?></p>
    </br>
<?php endforeach ?>