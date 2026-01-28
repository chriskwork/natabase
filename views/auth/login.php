<!-- header -->
<?php require_once "../../views/layouts/header.php"; ?>

<main class="flex flex-1 justify-center items-center px-4 py-12">
  <form action="" method="post" class="bg-white shadow-lg p-8 rounded-2xl w-full max-w-md">

    <h1 class="mb-8 font-bold text-gray-800 text-2xl text-center">Iniciar Sesión</h1>

    <!-- email -->
    <div class="mb-5">
      <label for="email" class="block mb-2 font-medium text-gray-700 text-sm">Email</label>
      <input
        type="email"
        name="email"
        id="email"
        placeholder="tu@email.com"
        class="px-4 py-3 border border-gray-300 focus:border-transparent rounded-lg outline-none focus:ring-2 focus:ring-brand-turquoise w-full transition"
        required>
    </div>

    <!-- pass -->
    <div class="mb-6">
      <label for="pass" class="block mb-2 font-medium text-gray-700 text-sm">Contraseña</label>
      <input
        type="password"
        name="pass"
        id="pass"
        placeholder="••••••••"
        class="px-4 py-3 border border-gray-300 focus:border-transparent rounded-lg outline-none focus:ring-2 focus:ring-brand-turquoise w-full transition"
        required>
    </div>

    <!-- submit btn -->
    <button
      type="submit"
      class="bg-brand-navy hover:bg-brand-turquoise py-3 rounded-lg w-full font-semibold text-white transition duration-200 cursor-pointer">
      Iniciar
    </button>

    <p class="mt-6 text-gray-600 text-sm text-center">
      ¿No tienes cuenta?
      <a href="/views/auth/register.php" class="font-medium text-blue-600 hover:underline">Regístrate</a>
    </p>

  </form>
</main>


<!-- footer -->
<?php require_once "../../views/layouts/footer.php"; ?>