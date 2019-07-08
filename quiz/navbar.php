<?php require_once "config.php" ?>

<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
  <ul class="navbar-nav">
      <a class="navbar-brand">
          <img src="logo.png" width="40" height="40" />
      </a>
    <li class="nav-item">
<a class="nav-link" href="index.php">Home</a>
    </li>
    <?php if(isset($_SESSION['username'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="add_quiz.php">Nuovo Quiz</a>
        </li>
    <?php endif ?>
    <li class="nav-item">
      <?php if(!isset($_SESSION['username'])): ?>
          <a class="nav-link" href="login.php">login</a>
      <?php else: ?>
          <a class="nav-link" href="logout.php">logout</a>
      <?php endif ?>
    </li>
  </ul>
</nav>
