<?php $this->layout('layout', ['title' => 'New Article']) ?>
<h2 style="color:#ff33c1">Crea un nuovo articolo</h2>
<form action = "create" method="POST">
  <br>
  <label for="author">Author:</label><br>
  <input type="text" required name="author"><br>
  <label for="title">Title:</label><br>
  <input type="text" required name="title"><br>
  <label for="content">Content:</label><br>
  <textarea required rows="20" cols="100" name="content"></textarea>
  <br><br>
  <input type="submit" value="Salva">
</form> 