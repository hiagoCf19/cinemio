<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="./A.png">

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>

<body class="bg-[#0F0F1A] text-white">

  <div class="flex min-h-screen">
    <!-- Left Side: Visuals -->
    <div class="hidden lg:flex flex-1 items-center justify-center bg-purple-900/20 relative overflow-hidden">
      <!-- Abstract background shapes -->
      <div class="absolute w-96 h-96 bg-purple-500 rounded-full -top-16 -left-16 opacity-20 blur-3xl"></div>
      <div class="absolute w-80 h-80 bg-indigo-500 rounded-full -bottom-24 -right-10 opacity-20 blur-3xl"></div>

      <div class="z-10 text-center p-8">
        <h1 class="text-4xl font-bold mb-4 tracking-tight">Crie sua Conta</h1>
        <p class="text-lg text-purple-200 max-w-md">Junte-se à nossa comunidade e explore um universo de animes sem
          limites.</p>
        <!-- Placeholder for an anime-style illustration or logo -->
        <div class="mt-12">
          <svg class="w-48 h-48 mx-auto text-purple-400 opacity-50" fill="none" stroke="currentColor"
            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
              d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
          </svg>
        </div>
      </div>
    </div>

    <!-- Right Side: Registration Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-8">
      <div class="w-full max-w-md">
        <div class="text-center mb-8">
          <h2 class="text-3xl font-bold text-white">Formulário de Registro</h2>
          <p class="text-gray-400 mt-2">É rápido e fácil. Vamos começar!</p>
        </div>

        <!-- The action and method can be adjusted for your backend -->
        <form action="<?= base_url('/register') ?>" method="post" class="space-y-4">

          <!-- Nome e Sobrenome -->
          <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
            <div class="w-full sm:w-1/2">
              <label for="nome" class="block text-sm font-medium text-gray-300 mb-2">Nome</label>
              <input type="text" name="nome" id="nome" required placeholder="Seu nome"
                class="w-full px-4 py-3 bg-[#1A1A2E] border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200" />
            </div>
            <div class="w-full sm:w-1/2">
              <label for="sobrenome" class="block text-sm font-medium text-gray-300 mb-2">Sobrenome</label>
              <input type="text" name="sobrenome" id="sobrenome" required placeholder="Seu sobrenome"
                class="w-full px-4 py-3 bg-[#1A1A2E] border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200" />
            </div>
          </div>

          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
            <input type="email" name="email" id="email" required placeholder="seuemail@exemplo.com"
              class="w-full px-4 py-3 bg-[#1A1A2E] border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200" />
          </div>

          <!-- Telefone -->
          <div>
            <label for="telefone" class="block text-sm font-medium text-gray-300 mb-2">Telefone</label>
            <input type="tel" name="telefone" id="telefone" required placeholder="(99) 99999-9999"
              class="w-full px-4 py-3 bg-[#1A1A2E] border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200" />
          </div>

          <!-- Data de Nascimento -->
          <div>
            <label for="data_nascimento" class="block text-sm font-medium text-gray-300 mb-2">Data de Nascimento</label>
            <input type="date" name="data_nascimento" id="data_nascimento" required
              class="w-full px-4 py-3 bg-[#1A1A2E] border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200" />
          </div>

          <!-- Senha -->
          <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Senha</label>
            <input type="password" name="password" id="password" required placeholder="Crie uma senha forte"
              class="w-full px-4 py-3 bg-[#1A1A2E] border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200" />
          </div>

          <!-- Confirmação de Senha -->
          <div>
            <label for="confirm_password" class="block text-sm font-medium text-gray-300 mb-2">Confirmação de
              Senha</label>
            <input type="password" name="confirm_password" id="confirm_password" required
              placeholder="Confirme sua senha"
              class="w-full px-4 py-3 bg-[#1A1A2E] border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200" />
          </div>

          <!-- Botão de Submit -->
          <button type="submit"
            class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg shadow-purple-900/30 !mt-6">
            Criar Conta
          </button>

          <!-- Link para login -->
          <div class="text-center text-gray-400 pt-4">
            Já possui uma conta?
            <a href="<?= base_url('/login') ?>" class="font-medium text-purple-400 hover:text-purple-300 transition">
              Faça login
            </a>
          </div>

        </form>

      </div>
    </div>
  </div>

</body>

</html>