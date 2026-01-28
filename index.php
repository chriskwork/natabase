<?php

// require_once "./config/database.php";
?>

<!-- header section -->
<?php require_once __DIR__ . "/views/layouts/header.php"; ?>

<!-- landing page -->
<?php require_once __DIR__ . "/views/layouts/index_sections/hero.php"; ?>

<!-- main contents -->
<main class="mx-auto mt-14">

  <!-- sobre nosotros (el club) -->
  <?php require_once __DIR__ . "/views/layouts/index_sections/sobre_nos.php"; ?>

  <!-- programs section -->
  <?php require_once __DIR__ . "/views/layouts/index_sections/program.php"; ?>

  <!-- cifras section -->
  <?php require_once __DIR__ . "/views/layouts/index_sections/cifras.php"; ?>

  <!-- eventos section -->
  <?php require_once __DIR__ . "/views/layouts/index_sections/events.php"; ?>

  <!-- precios section -->
  <?php require_once __DIR__ . "/views/layouts/index_sections/precios.php"; ?>

  <!-- contacto section -->
  <?php require_once __DIR__ . "/views/layouts/index_sections/contact.php"; ?>

</main>

<!-- footer section -->
<?php require_once __DIR__ . "/views/layouts/footer.php"; ?>