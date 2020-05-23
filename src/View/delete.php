<?php $this->layout('layout', ['title' => 'Delete Article']) ?>

<h2 style="color:#ff33c1">Sicuro di voler eliminare questo articolo?</h2>

<form action = "delete" method="POST">
    <input type="hidden" name="article_id" value="<?=$article->getId()?>">
    <h3><?=$this->e($article->getTitle())?></h3>
    <h5>di <?=$this->e($article->getAuthor())?></h5>
    <p><?=$this->e($article->getContent())?></p>
    </br>
    <input type="submit" value="Elimina">
    <br>
</form> 