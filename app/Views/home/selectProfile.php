<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Seleção de Perfil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Fundo gradient do preto mais evidente até o roxo */
    body {
      background: linear-gradient(180deg, #000000 0%, #000 40%, #2b0066 100%);
      min-height: 100vh;
    }

    .glass {
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(6px);
      -webkit-backdrop-filter: blur(6px);
    }
  </style>
</head>

<body class="flex items-center justify-center min-h-screen text-white">
  <div class="container mx-auto px-6 py-12 max-w-5xl">
    <header class="flex items-center justify-between mb-10">
      <h1 class="text-4xl md:text-5xl font-semibold tracking-tight">Quem está assistindo?</h1>
      <a href="#" class="text-sm md:text-base opacity-80 hover:opacity-100">Gerenciar perfis</a>
    </header>

    <main class="glass p-8 rounded-2xl shadow-2xl">
      <p class="text-sm text-gray-300 mb-6">Escolha um perfil para continuar</p>

      <!-- Grid de perfis -->
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-8 justify-items-center">
        <!-- Perfil 1 -->
        <button class="profile-card group w-36 focus:outline-none" data-name="Hiago">
          <div class="relative">
            <div
              class="w-36 h-36 rounded-full border-4 border-purple-600 flex items-center justify-center text-2xl font-bold uppercase bg-gradient-to-tr from-purple-700 via-purple-500 to-pink-500 transform transition duration-200 group-hover:scale-105 group-focus:scale-105">
              <span>H</span>
            </div>
          </div>
          <div class="mt-3 text-center">
            <span class="block text-white font-semibold">Hiago</span>
            <span class="block text-xs text-gray-300 mt-1">Adulto</span>
          </div>
        </button>


        <!-- Botão de + -->
        <button class="profile-card group w-36 focus:outline-none" data-name="Adicionar">
          <div
            class="w-36 h-36 rounded-full border-4 border-purple-600 flex items-center justify-center text-5xl font-bold text-purple-500 bg-black/40 transform transition duration-200 group-hover:scale-105 group-focus:scale-105">
            +
          </div>
          <div class="mt-3 text-center">
            <span class="block text-white font-semibold">Adicionar</span>
            <span class="block text-xs text-gray-300 mt-1">Novo perfil</span>
          </div>
        </button>
      </div>

      <!-- Buttons inferiores -->
      <div class="mt-10 flex items-center justify-center gap-6">
        <button id="manage" class="px-6 py-2 rounded-md text-sm bg-white/10 hover:bg-white/20 transition">Editar
          perfis</button>
        <button id="signout" class="px-6 py-2 rounded-md text-sm bg-white/6 hover:bg-white/12 transition">Sair</button>
      </div>
    </main>
  </div>

  <script>
    document.querySelectorAll('.profile-card').forEach(btn => {
      btn.addEventListener('click', () => {
        const name = btn.getAttribute('data-name') || 'Perfil';
        btn.classList.add('ring-4', 'ring-purple-500', 'ring-opacity-50');
        setTimeout(() => {
          alert('Entrando como: ' + name);
          btn.classList.remove('ring-4', 'ring-purple-500', 'ring-opacity-50');
        }, 220);
      });
    });

    document.getElementById('manage').addEventListener('click', () => {
      alert('Ir para: Gerenciar perfis (placeholder)');
    });
    document.getElementById('signout').addEventListener('click', () => {
      alert('Deslogando... (placeholder)');
    });
  </script>
</body>

</html>