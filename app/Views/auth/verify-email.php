<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifique seu E-mail</title>
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
      <div class="absolute w-96 h-96 bg-purple-500 rounded-full -top-16 -left-16 opacity-20 blur-3xl"></div>
      <div class="absolute w-80 h-80 bg-indigo-500 rounded-full -bottom-24 -right-10 opacity-20 blur-3xl"></div>

      <div class="z-10 text-center p-8">
        <h1 class="text-4xl font-bold mb-4 tracking-tight">Quase lá!</h1>
        <p class="text-lg text-purple-200 max-w-md">
          Um e-mail de verificação foi enviado para:
        </p>
        <p class="text-purple-300 mt-2 font-medium"><?= esc($email) ?></p>
        <p class="text-lg text-purple-200 max-w-md mt-4">
          Clique no link do e-mail para ativar sua conta e começar a explorar.
        </p>
      </div>
    </div>

    <!-- Right Side: Message -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-8">
      <div class="w-full max-w-md text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Verificação de E-mail</h2>
        <p class="text-gray-400 mb-6">Para completar o registro, verifique seu e-mail clicando no link que enviamos.</p>

        <!-- Botão para reenviar e-mail -->
        <form action="<?= base_url('/resend-verification') ?>" method="post" class="space-y-4">
          <input type="hidden" name="email" value="<?= esc($email) ?>" />
          <button type="submit"
            class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg shadow-purple-900/30">
            Reenviar E-mail de Verificação
          </button>
        </form>

        <div class="text-gray-400 mt-6">
          Já confirmou o e-mail? <a href="<?= base_url('/login') ?>"
            class="font-medium text-purple-400 hover:text-purple-300 transition">Faça login</a>
        </div>
      </div>
    </div>
  </div>

</body>

</html>