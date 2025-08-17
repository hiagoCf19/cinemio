<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="./A.png">

</head>

<body class="bg-[#0F0F1A] text-white">

  <div class="flex min-h-screen">
    <!-- Left Side: Visuals -->
    <div class="hidden lg:flex flex-1 items-center justify-center bg-purple-900/20 relative overflow-hidden">
      <!-- Abstract background shapes -->
      <div class="absolute w-96 h-96 bg-purple-500 rounded-full -top-16 -left-16 opacity-20 blur-3xl"></div>
      <div class="absolute w-80 h-80 bg-indigo-500 rounded-full -bottom-24 -right-10 opacity-20 blur-3xl"></div>

      <div class="z-10 text-center p-8">
        <h1 class="text-4xl font-bold mb-4 tracking-tight">Bem-vindo ao <strong>Animio</strong></h1>
        <p class="text-lg text-purple-200 max-w-md">Sua jornada para mundos incríveis começa aqui. Faça login para
          continuar.</p>
        <!-- Placeholder for an anime-style illustration or logo -->
        <div class="mt-4 flex items-center justify-center">
          <img src="./A.png" class="h-60" alt="Logo">
        </div>
      </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-8">
      <div class="w-full max-w-md">

        <div class="text-center mb-10">

          <h2 class="text-3xl font-bold text-white">Acesse sua Conta</h2>
          <p class="text-gray-400 mt-2">Continue sua aventura no mundo dos animes.</p>
        </div>


        <!-- The action and method can be adjusted for your backend -->
        <form action="<?= base_url('/login') ?>" method="post" class="space-y-6">
          <!-- Email Input -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
            <input type="email" name="email" id="email" required placeholder="seuemail@exemplo.com"
              class="w-full px-4 py-3 bg-[#1A1A2E] border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200" />
          </div>

          <!-- Password Input -->
          <div>
            <div class="flex justify-between items-center mb-2">
              <label for="password" class="block text-sm font-medium text-gray-300">Senha</label>

            </div>
            <input type="password" name="password" id="password" required placeholder="••••••••"
              class="w-full px-4 py-3 bg-[#1A1A2E] border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200" />
          </div>
          <div class="flex justify-between items-center">

            <a href="#" class="text-sm text-purple-400 hover:text-purple-300 transition">Esqueceu a senha?</a>
            <?php if (session()->getFlashdata('error')): ?>
              <div class=" text-sm text-red-400 ">
                <?= session()->getFlashdata('error') ?>
              </div>
            <?php endif; ?>
          </div>
          <!-- Submit Button -->
          <button type="submit"
            class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg shadow-purple-900/30">
            Entrar
          </button>
          <!-- Mensagem de erro -->


          <!-- Sign-up Link -->
          <div class="text-center text-gray-400 pt-4">
            Ainda não possui conta?
            <a href="<?= base_url('/cadastro') ?>" class="font-medium text-purple-400 hover:text-purple-300 transition">
              Cadastre-se
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>