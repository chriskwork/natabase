<!-- header -->
<?php require_once "../layouts/header.php"; ?>

<main class="flex flex-1 justify-center items-center px-4 py-12">
  <form action="" method="post" class="bg-white shadow-lg p-8 rounded-2xl w-full max-w-md">

    <h1 class="mb-8 font-bold text-gray-800 text-2xl text-center">Registrar</h1>

    <?php if (!empty($error)): ?>
      <div class="mb-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <!-- email -->
    <div class="mb-5">
      <label for="email" class="block mb-2 font-medium text-gray-700 text-sm">Email</label>
      <input
        type="email"
        name="email"
        id="email"
        placeholder="tu@email.com"
        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
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
        value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
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
        value="<?= htmlspecialchars($_POST['surname'] ?? '') ?>"
        class="px-4 py-3 border border-gray-300 focus:border-transparent rounded-lg outline-none focus:ring-2 focus:ring-brand-turquoise w-full transition"
        required>
    </div>

    <!-- pass -->
    <div class="mb-5">
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
    <div class="mb-5">
      <label for="confirm_pass" class="block mb-2 font-medium text-gray-700 text-sm">Repetir Contraseña</label>
      <input
        type="password"
        name="confirm_pass"
        id="confirm_pass"
        placeholder="••••••••"
        class="px-4 py-3 border border-gray-300 focus:border-transparent rounded-lg outline-none focus:ring-2 focus:ring-brand-turquoise w-full transition"
        required>
    </div>

    <p class="mt-10 mb-6 font-bold">Información Personal</p>

    <!-- phone -->
    <div class="mb-5">
      <label for="phone" class="block mb-2 font-medium text-gray-700 text-sm">Teléfono</label>
      <input
        type="tel"
        name="phone"
        id="phone"
        placeholder="600 123 456"
        value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"
        class="px-4 py-3 border border-gray-300 focus:border-transparent rounded-lg outline-none focus:ring-2 focus:ring-brand-turquoise w-full transition">
    </div>

    <!-- DNI -->
    <div class="mb-5">
      <label for="dni" class="block mb-2 font-medium text-gray-700 text-sm">DNI de nadador/a</label>
      <input
        type="text"
        name="dni"
        id="dni"
        placeholder="12345678A"
        value="<?= htmlspecialchars($_POST['dni'] ?? '') ?>"
        class="px-4 py-3 border border-gray-300 focus:border-transparent rounded-lg outline-none focus:ring-2 focus:ring-brand-turquoise w-full transition">
      <p class="mt-1 text-gray-500 text-xs">Solo necesario si te registras como nadador/a</p>
    </div>

    <!-- birthday -->
    <div class="mb-8">
      <label for="birth" class="block mb-2 font-medium text-gray-700 text-sm">Fecha de Nacimiento</label>
      <input
        type="date"
        name="birth"
        id="birth"
        value="<?= htmlspecialchars($_POST['birth'] ?? '') ?>"
        class="px-4 py-3 border border-gray-300 focus:border-transparent rounded-lg outline-none focus:ring-2 focus:ring-brand-turquoise w-full transition">
      <p class="mt-1 text-gray-500 text-xs">Solo necesario si te registras como nadador/a</p>
    </div>

    <!-- confirm role -->
    <div class="mb-8">
      <!-- si es mayor de 18, se puede registrar como nadador -->
      <div class="flex items-center mb-4">
        <input id="role_nadador" type="radio" value="nadador" name="role"
          <?= (isset($_POST['role']) && $_POST['role'] === 'nadador') ? 'checked' : '' ?>
          class="bg-brand-navy border border-default-medium rounded-full focus:ring-1 focus:ring-brand-navy w-4 h-4">
        <label for="role_nadador" class="ms-2 font-medium text-heading text-sm select-none">Soy Nadador/a (mayor de 18 años)</label>
      </div>

      <!-- si es menor, su padre/madre tiene que registrar -->
      <div class="flex items-center">
        <input <?= (!isset($_POST['role']) || $_POST['role'] === 'familia') ? 'checked' : '' ?>
          id="role_familia" type="radio" value="familia" name="role"
          class="bg-brand-navy border border-default-medium rounded-full focus:ring-1 focus:ring-brand-navy w-4 h-4">
        <label for="role_familia" class="ms-2 font-medium text-heading text-sm select-none">Soy Familia (Registrar un/a nadador/a menor)</label>
      </div>

    </div>

    <!-- submit btn -->
    <button
      type="submit"
      class="bg-brand-point hover:bg-[#f75e34] py-3 rounded-lg w-full font-semibold text-white transition duration-200 cursor-pointer">
      Registrar
    </button>

    <div class="mt-4 text-center text-sm">
      <span class="text-gray-600">¿Ya tienes cuenta?</span>
      <a href="/views/auth/login.php" class="text-brand-turquoise hover:underline ml-1">Iniciar Sesión</a>
    </div>

  </form>
</main>


<!-- footer -->
<?php require_once "../layouts/footer.php"; ?>
