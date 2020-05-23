<br>
<h1><b>Deily Niuus</b></h1>

<nav class="nav">
  <a class="nav-link" href="/">Home</a>
  <a class="nav-link" href="login">Login</a>

  <?php if(isset($_SESSION['user'])): ?>
    <a class="nav-link" href="create">New</a>
    <a class="nav-link" href="edit">Edit</a>
  <?php endif ?>
</nav>
<br>