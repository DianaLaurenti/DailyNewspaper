<?php $this->layout('layout', ['title' => 'Update Article']) ?>

<h2 style="color:#ff33c1">Effettua le modifice e salva</h2>
<form action = "update" method="POST">
    <input type="hidden" name="article_id" value="<?=$article->getId()?>"><br>
    <label for="author">Author:</label><br>
    <input type="text" name="author" value="<?=$article->getAuthor()?>"><br>
    <label for="title">Title:</label><br>
    <input type="text" name="title" value="<?=$article->getTitle()?>"><br>
    <label for="content">Content:</label><br>
    <input type="text" name="content" value="<?=$article->getContent()?>">
    <br><br>
    <input type="submit" value="Salva">
</form> 