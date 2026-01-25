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

      <p class="font-extrabold text-6xl lg:text-7xl md:leading-20 lg:leading-24">Más allá de tus límites: <br />Tu meta comienza aquí.</p>
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
<main class="mx-auto mt-14">

  <!-- sobre nosotros(el club link) -->
  <section id="#sobre-nosotros" class="">
    <div class="flex md:flex-row flex-col gap-8 mx-auto mb-10 px-4 max-w-6xl container">
      <div class="md:basis-1/2">
        <p class="text-gray-400">Sobre Nosotros</p>
        <h2 class="mb-8 font-bold text-brand-navy text-5xl leading-16 tracking-tight">Formando campeones desde 2010</h2>
        <p>En NATABASE, combinamos la pasión por la natación con una metodología de entrenamiento de élite. Nuestro club ha formado a más de 500 nadadores, desde principiantes hasta competidores de nivel nacional.</p>
      </div>

      <div class="md:basis-1/2">
        <img class="rounded-2xl w-full h-auto object-cover" src="public/assets/imgs/swimming-index.jpg" alt="">
      </div>
    </div>

    <!-- cards container -->
    <div class="bg-gray-50 py-12">

      <!-- cards -->
      <div class="gap-6 grid grid-cols-1 md:grid-cols-3 mx-auto max-w-6xl">
        <div class="flex flex-col items-center bg-white shadow-sm p-6 border border-slate-100 rounded-2xl text-center">
          <div class="flex justify-center items-center bg-blue-50 mb-4 rounded-full w-16 h-16">
            <span class="font-light text-brand-turquoise text-5xl material-symbols-outlined">
              workspace_premium
            </span>
          </div>
          <h3 class="mb-2 font-bold text-gray-900 text-xl">Entrenadores Certificados</h3>
          <p class="text-gray-600 text-sm">Profesionales con experiencia nacional e internacional</p>
        </div>

        <div class="flex flex-col items-center bg-white shadow-sm p-6 border border-slate-100 rounded-2xl text-center">
          <div class="flex justify-center items-center bg-blue-50 mb-4 rounded-full w-16 h-16">
            <span class="font-light text-brand-turquoise text-5xl material-symbols-outlined">pool</span>
          </div>
          <h3 class="mb-2 font-bold text-gray-900 text-xl">Piscina Olímpica</h3>
          <p class="text-gray-600 text-sm">Instalaciones de 50m con tecnología de última generación</p>
        </div>

        <div class="flex flex-col items-center bg-white shadow-sm p-6 border border-slate-100 rounded-2xl text-center">
          <div class="flex justify-center items-center bg-blue-50 mb-4 rounded-full w-16 h-16">
            <span class="font-light text-brand-turquoise text-5xl material-symbols-outlined">monitoring</span>
          </div>
          <h3 class="mb-2 font-bold text-gray-900 text-xl">Seguimiento Personalizado</h3>
          <p class="text-gray-600 text-sm">Análisis de tiempos y progreso individual</p>
        </div>
      </div>

    </div>
  </section>

  <!-- programs -->
  <section id="#programa" class="mx-auto mt-14 max-w-6xl text-center container">
    <h2 class="mb-8 font-bold text-brand-navy text-3xl text-center tracking-tight">
      Un programa para cada etapa
    </h2>

    <p>
      Programas adaptados a cada grupo de edad, desde los más pequeños hasta nadadores máster.
    </p>
  </section>

  <div style="height: 200px;"></div>
</main>



<!-- footer section -->
<?php require_once "./views/layouts/footer.php"; ?>