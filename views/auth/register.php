<!-- header -->
<?php require_once "../layouts/header.php"; ?>

<main class="flex flex-1 justify-center items-center px-4 py-12">
  <form action="" method="post" class="bg-white shadow-lg p-8 rounded-2xl w-full max-w-md">

    <h1 class="mb-8 font-bold text-gray-800 text-2xl text-center">Registrar</h1>

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

    <!-- name -->
    <div class="mb-5">
      <label for="name" class="block mb-2 font-medium text-gray-700 text-sm">Nombre</label>
      <input
        type="text"
        name="name"
        id="name"
        placeholder="Nombre"
        class="px-4 py-3 border border-gray-300 focus:border-transparent rounded-lg outline-none focus:ring-2 focus:ring-brand-turquoise w-full transition"
        required>
    </div>

    <!-- surname -->
    <div class="mb-5">
      <label for="surname" class="block mb-2 font-medium text-gray-700 text-sm">Apellidos</label>
      <input
        type="text"
        name="surname"
        id="surname"
        placeholder="Apellidos"
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

    <!-- confirm pass -->
    <div class="mb-6">
      <label for="confirm_pass" class="block mb-2 font-medium text-gray-700 text-sm">Repetir Contraseña</label>
      <input
        type="password"
        name="confirm_pass"
        id="confirm_pass"
        placeholder="••••••••"
        class="px-4 py-3 border border-gray-300 focus:border-transparent rounded-lg outline-none focus:ring-2 focus:ring-brand-turquoise w-full transition"
        required>
    </div>

    <!-- confirm role -->
    <div class="mb-8">
      <!-- si es mayor de 18, se puede registrar como nadador -->
      <div class="flex items-center mb-4">
        <input id="role_nadador" type="radio" value="nadador" name="role" class="bg-brand-navy border border-default-medium rounded-full focus:ring-1 focus:ring-brand-navy w-4 h-4">
        <label for="role_nadador" class="ms-2 font-medium text-heading text-sm select-none">Soy Nadador/a</label>
      </div>

      <!-- si es menor, su padre/madre tiene que registrar -->
      <div class="flex items-center">
        <input checked id="role_familia" type="radio" value="familia" name="role" class="bg-brand-navy border border-default-medium rounded-full focus:ring-1 focus:ring-brand-navy w-4 h-4">
        <label for="role_familia" class="ms-2 font-medium text-heading text-sm select-none">Soy Familia(Registrar un/a nadador/a menor)</label>
      </div>

    </div>

    <!-- submit btn -->
    <button
      type="submit"
      class="bg-brand-point hover:bg-[#f75e34] py-3 rounded-lg w-full font-semibold text-white transition duration-200 cursor-pointer">
      Registrar
    </button>

  </form>
</main>


<!-- footer -->
<?php require_once "../layouts/footer.php"; ?>