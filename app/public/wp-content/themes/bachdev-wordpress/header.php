<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php wp_head(); ?>
</head>
<body>
  <section class="common-section section-head">
    <div class="wrapper">
      <h1><a href="<?php get_permalink("#"); ?>">BachtheDev</a></h1>
      <ul class="nav-list">
        <li class="list-item"><a href="<?php echo 'www.linkedin.com/in/nhanmbach' ?>">About Me</a></li>
        <li class="list-item"><a href="<?php get_permalink("https://github.com/nnatebach/fictional-university-wp"); ?>">My Product</a></li>
        <li class="list-item"><a href="<?php get_permalink("https://github.com/nnatebach"); ?>">Hire Me</a></li>
      </ul>
    </div>
  </section>