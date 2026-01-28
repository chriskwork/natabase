<div class="border-gray-100 border-b">
  <nav class="bg-white mx-auto max-w-6xl">
    <div class="flex justify-between items-center mx-auto px-4 py-4 w-full">
      <!-- LOGO -->
      <a href="/">
        <img src="/public/assets/imgs/logo.png" alt="LOGO" class="w-auto h-10" />
      </a>

      <!-- nav(desktop) -->
      <ul class="hidden lg:flex items-center gap-8">
        <li class="text-gray-700 hover:text-brand-turquoise transition-colors duration-200 cursor-pointer">
          <a href="#sobre-nosotros">El Club</a>
        </li>
        <li class="text-gray-700 hover:text-brand-turquoise transition-colors duration-200 cursor-pointer">
          <a href="#programas">Programas</a>
        </li>
        <li class="text-gray-700 hover:text-brand-turquoise transition-colors duration-200 cursor-pointer">
          <a href="#eventos">Eventos</a>
        </li>
        <li class="text-gray-700 hover:text-brand-turquoise transition-colors duration-200 cursor-pointer">
          <a href="#precios">Precios</a>
        </li>
        <li class="text-gray-700 hover:text-brand-turquoise transition-colors duration-200 cursor-pointer">
          <a href="#contacto">Contacto</a>
        </li>
      </ul>

      <!-- hamburger menu -->
      <button id="menu-toggle" class="lg:hidden flex flex-col gap-1.5 p-2 cursor-pointer">
        <span class="block bg-gray-700 w-6 h-0.5"></span>
        <span class="block bg-gray-700 w-6 h-0.5"></span>
        <span class="block bg-gray-700 w-6 h-0.5"></span>
      </button>

      <!-- action button -->
      <div class="hidden lg:flex items-center gap-x-10">
        <a href="/views/auth/login.php" class="text-brand-turquoise text-sm hover:underline">Iniciar Sesión</a>
        <a href="/views/auth/register.php" class="bg-brand-point hover:bg-[#f75e34] shadow-sm hover:shadow-md px-6 py-2 rounded-lg font-semibold text-white text-sm transition-colors duration-200">
          Hazte socio
        </a>
      </div>
    </div>





    <!-- 모바일 메뉴 (토글) -->
    <div id="mobile-menu" class="hidden lg:hidden px-4 pb-4">
      <ul class="flex flex-col gap-4 mb-4 text-center">
        <li class="text-gray-700 hover:text-brand-turquoise transition-colors duration-200 cursor-pointer">
          El Club
        </li>
        <li class="text-gray-700 hover:text-brand-turquoise transition-colors duration-200 cursor-pointer">
          Actividades
        </li>
        <li class="text-gray-700 hover:text-brand-turquoise transition-colors duration-200 cursor-pointer">
          Eventos
        </li>
        <li class="text-gray-700 hover:text-brand-turquoise transition-colors duration-200 cursor-pointer">
          Precios
        </li>
      </ul>
      <div class="flex flex-col gap-3">
        <a href="/views/auth/login.php" class="text-center">Iniciar Sesión</a>
        <a href="/views/auth/register.php" class="bg-brand-point hover:bg-[#e64c22] shadow-sm hover:shadow-md px-6 py-2 rounded-lg font-semibold text-white text-center transition-colors duration-200">
          Hazte socio
        </a>
      </div>
    </div>
  </nav>

</div>

<script>
  document.getElementById('menu-toggle').addEventListener('click', function() {
    document.getElementById('mobile-menu').classList.toggle('hidden');
  });
</script>