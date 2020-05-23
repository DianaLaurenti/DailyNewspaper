<?php $this->layout('layout', ['title' => 'Login']) ?>

<h2 style="color:#ff33c1">Effettua il login per creare nuovi articoli o modificare quelli salvati</h2>

<form action = "login" method="POST">
    <div class="form-group row">
        <label class="col-1 col-form-label" for="author">Username:</label>
        <div class="col-11">
            <input class="form-control" type="text" required name="username">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-1 col-form-label" for="title">Password:</label>
        <div class="col-11">
            <input class="form-control" type="password" required name="pwd">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Vai</button>
</form> 