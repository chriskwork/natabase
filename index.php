<?php

// require_once "./config/database.php";
?>

<!-- header section -->
<?php require_once "./views/layouts/header.php"; ?>

<!-- landing page -->
<!-- hero video bg -->
<div class="relative w-full h-[75vh]">
  <video autoplay muted loop playsinline class="top-0 left-0 absolute w-full h-full object-cover">
    <source src="public/assets/videos/swimming-pool-720.mp4">
  </video>

  <div class="z-10 relative flex items-center bg-brand-navy/80 h-full text-white">
    <div class="mx-auto px-4 text-center container">

      <p class="font-extrabold text-6xl md:leading-20 lg:leading-20">Más allá de tus límites: <br />Tu meta comienza aquí.</p>
      <br /><br />
      <p class="mb-20">
        Gestión integral para nadadores de competición y preparación de élite para torneos. <br />
        Lleva tu técnica y tus tiempos al siguiente nivel en NATABASE.
      </p>
      <a href="#" class="bg-brand-turquoise hover:bg-[#0088b3] px-6 py-4 rounded-lg font-semibold text-white text-lg transition-colors duration-200">
        Solicitar Evaluación de Nivel
      </a>

    </div>
  </div>
</div>
<!-- main contents -->
<main class="mx-auto container">
  contents here
</main>



<!-- footer section -->
<?php require_once "./views/layouts/footer.php"; ?>