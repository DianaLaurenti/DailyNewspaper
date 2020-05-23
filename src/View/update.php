<?php $this->layout('layout', ['title' => 'Update Article']) ?>

<h2 style="color:#ff33c1">Effettua le modifice e salva</h2>

<form action = "update" method="POST">
    <input type="hidden" name="article_id" value="<?=$article->getId()?>">
    <div class="form-group">
        <label for="author">Author:</label>
        <input class="form-control" type="text" name="author" value="<?=$article->getAuthor()?>">
    </div>
    <div class="form-group">
        <label for="title">Title:</label>
        <input class="form-control" type="text" size="75" required name="title" value="<?=$article->getTitle()?>">
    </div>
    <div class="form-group">
        <label for="content">Content:</label>
        <textarea class="form-control" required rows="20" cols="100" name="content"><?=$article->getContent()?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Salva</button>
</form> 