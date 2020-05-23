<?php $this->layout('layout', ['title' => 'New Article']) ?>

<h2 style="color:#ff33c1">Crea un nuovo articolo</h2>

<form action = "create" method="POST">
    <div class="form-group">
      <label for="author">Author:</label>
      <input class="form-control" type="text" required name="author">
    </div>
    <div class="form-group">
      <label for="title">Title:</label>
      <input class="form-control" type="text" size="75" required name="title">
    </div>
    <div class="form-group">
      <label for="content">Content:</label>
      <textarea class="form-control" required rows="20" cols="100" name="content"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Salva</button>
</form>