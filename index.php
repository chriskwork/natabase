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
  <section id="sobre-nosotros" class="">
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
    <div class="bg-gray-50 px-4 py-12">

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

  <!-- programs section -->
  <section id="programas" class="mx-auto mt-14 px-4 max-w-6xl text-center scroll-mt-10">
    <h2 class="mb-8 font-bold text-brand-navy text-3xl text-center tracking-tight">
      Un programa para cada etapa
    </h2>

    <p>
      Programas adaptados a cada grupo de edad, desde los más pequeños hasta nadadores máster.
    </p>

    <!-- programs cards -->
    <div
      class="gap-6 grid grid-cols-1 md:grid-cols-3 mt-8 text-left">
      <!-- program Card #pre&benjamin -->
      <div
        class="bg-brand-navy p-6 rounded-2xl min-h-30 transition-all duration-300">
        <div class="flex justify-between items-center gap-2 mb-4">
          <h3 class="font-bold text-white group-hover:text-brand-turquoise text-xl transition-colors">
            Pre-Benjamín &amp; Benjamín
          </h3>
          <span class="bg-white/10 px-2 py-1 rounded font-bold text-white text-xs">0-8 años</span>
        </div>

        <p class="text-gray-300 text-sm">
          Iniciación lúdica a la natación y fundamentos técnicos básicos.
        </p>
      </div>

      <!-- program Card #alevin -->
      <div
        class="bg-brand-navy p-6 rounded-2xl min-h-30 transition-all duration-300">
        <div class="flex justify-between items-center gap-2 mb-4">
          <h3 class="font-bold text-white group-hover:text-brand-turquoise text-xl transition-colors">Alevín</h3>
          <span class="bg-white/10 px-2 py-1 rounded font-bold text-white text-xs">11-12 años</span>
        </div>

        <p class="text-gray-300 text-sm">
          Técnica avanzada y competición regional
        </p>
      </div>

      <!-- program Card #infantil -->
      <div
        class="bg-brand-navy p-6 rounded-2xl min-h-30 transition-all duration-300">
        <div class="flex justify-between items-center gap-2 mb-4">
          <h3 class="font-bold text-white group-hover:text-brand-turquoise text-xl transition-colors">Infantil</h3>
          <span class="bg-white/10 px-2 py-1 rounded font-bold text-white text-xs">13-14 años</span>
        </div>

        <p class="text-gray-300 text-sm">
          specialización y preparación intensiva
        </p>
      </div>

      <!-- program Card #junior -->
      <div
        class="bg-brand-navy p-6 rounded-2xl min-h-30 transition-all duration-300">
        <div class="flex justify-between items-center gap-2 mb-4">
          <h3 class="font-bold text-white group-hover:text-brand-turquoise text-xl transition-colors">Junior</h3>
          <span class="bg-white/10 px-2 py-1 rounded font-bold text-white text-xs">15-18 años</span>
        </div>

        <p class="text-gray-300 text-sm">
          Alto rendimiento y competición nacional
        </p>
      </div>

      <!-- program Card #absoluto -->
      <div
        class="bg-brand-navy p-6 rounded-2xl min-h-30 transition-all duration-300">
        <div class="flex justify-between items-center gap-2 mb-4">
          <h3 class="font-bold text-white group-hover:text-brand-turquoise text-xl transition-colors">Absoluto</h3>
          <span class="bg-white/10 px-2 py-1 rounded font-bold text-white text-xs">19-24 años</span>
        </div>

        <p class="text-gray-300 text-sm">
          Nivel competitivo máximo
        </p>
      </div>

      <!-- program Card #master -->
      <div
        class="bg-brand-navy p-6 rounded-2xl min-h-30 transition-all duration-300">
        <div class="flex justify-between items-center gap-2 mb-4">
          <h3 class="font-bold text-white group-hover:text-brand-turquoise text-xl transition-colors">Máster</h3>
          <span class="bg-white/10 px-2 py-1 rounded font-bold text-white text-xs">25+ años</span>
        </div>

        <p class="text-gray-300 text-sm">
          Mantenimiento y competición adulta
        </p>
      </div>

    </div>
  </section>

  <section id="cifras" class="bg-brand-turquoise mt-14 text-white">
    <div class="mx-auto px-4 py-4 max-w-6xl">

      <!-- cifras -->
      <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-white/10 text-center">

        <div class="flex flex-col items-center p-4">
          <span class="mb-2 font-black text-primary text-4xl md:text-5xl">
            500+
          </span>
          <span class="font-medium text-gray-300 text-sm md:text-base uppercase tracking-wider">
            Nadadores
          </span>
        </div>

        <div class="flex flex-col items-center p-4">
          <span class="mb-2 font-black text-primary text-4xl md:text-5xl">
            50+
          </span>
          <span class="font-medium text-gray-300 text-sm md:text-base uppercase tracking-wider">
            Competiciones al año
          </span>
        </div>

        <div class="flex flex-col items-center p-4">
          <span class="mb-2 font-black text-primary text-4xl md:text-5xl">
            200+
          </span>
          <span class="font-medium text-gray-300 text-sm md:text-base uppercase tracking-wider">
            Medallas conseguidas
          </span>
        </div>

        <div class="flex flex-col items-center p-4">
          <span class="mb-2 font-black text-primary text-4xl md:text-5xl">
            16
          </span>
          <span class="font-medium text-gray-300 text-sm md:text-base uppercase tracking-wider">
            Años de experiencia
          </span>
        </div>

      </div>

    </div>
  </section>

  <!-- eventos section -->
  <section id="eventos" class="mx-auto mt-14 px-4 max-w-6xl text-center scroll-mt-10">
    <h2 class="mb-10 font-bold text-brand-navy text-3xl text-center tracking-tight">
      Próximas Competiciones
    </h2>

    <!-- eventos container -->
    <div class="gap-4 grid grid-cols-1 md:grid-cols-3 mb-10 text-left">

      <div class="flex items-center bg-white shadow-sm p-4 border-blue-600 border-l-4 rounded-lg">
        <div class="w-16 text-center shrink-0">
          <span class="block font-bold text-blue-600 text-sm uppercase">Feb</span>
          <span class="font-black text-2xl">15</span>
        </div>
        <div class="ml-6 px-4 grow">
          <h3 class="font-bold text-gray-800 text-lg">Campeonato Regional de Invierno</h3>
          <p class="flex items-center gap-1 text-gray-500 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Valencia
          </p>
        </div>
      </div>

      <div class="flex items-center bg-white shadow-sm p-4 border-blue-600 border-l-4 rounded-lg">
        <div class="w-16 text-center shrink-0">
          <span class="block font-bold text-blue-600 text-sm uppercase">Abr</span>
          <span class="font-black text-2xl">20</span>
        </div>
        <div class="ml-6 px-4 grow">
          <h3 class="font-bold text-gray-800 text-lg">Copa de Primavera</h3>
          <p class="flex items-center gap-1 text-gray-500 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Madrid
          </p>
        </div>
      </div>

      <div class="flex items-center bg-white shadow-sm p-4 border-blue-600 border-l-4 rounded-lg">
        <div class="w-16 text-center shrink-0">
          <span class="block font-bold text-blue-600 text-sm uppercase">Jun</span>
          <span class="font-black text-2xl">10</span>
        </div>
        <div class="ml-6 px-4 grow">
          <h3 class="font-bold text-gray-800 text-lg">CCampeonato Nacional Juvenil</h3>
          <p class="flex items-center gap-1 text-gray-500 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Barcelona
          </p>
        </div>
      </div>

    </div>

    <div class="">
      <p class="mb-4 font-serif font-medium text-brand-turquoise text-xl italic">¿Quieres participar?</p>
      <h3 class="mb-6 font-bold text-2xl leading-tight">Hazte socio y accede al <br class="md:hidden"> calendario completo</h3>
      <a href="#" class="inline-block bg-blue-500 hover:bg-blue-50 px-8 py-3 rounded-full font-bold text-white uppercase tracking-tight transition-colors">
        Quiero Ser Socio
      </a>
    </div>



  </section>

  <div style="height: 200px;"></div>
</main>



<!-- footer section -->
<?php require_once "./views/layouts/footer.php"; ?>