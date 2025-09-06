<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Seleção de Perfil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
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
      <div id="profile-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-8 justify-items-center">
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
        <button id="add-profile" class="profile-card group w-36 focus:outline-none" data-name="Adicionar">
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

  <!-- Modal -->
  <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
    <div class="bg-gray-900 p-8 rounded-xl shadow-xl max-w-lg w-full">
      <h2 class="text-xl font-semibold mb-4">Criar novo perfil</h2>
      <form id="create-profile-form" class="space-y-4">

        <!-- Avatar selecionado -->
        <div class="flex flex-col items-center">
          <div id="avatar-preview"
            class="w-24 h-24 rounded-full border-4 border-purple-600 flex items-center justify-center text-3xl font-bold bg-black/40 cursor-pointer hover:scale-105 transition">
            +
          </div>
          <span class="text-xs text-gray-400 mt-2">Clique para escolher uma foto</span>
        </div>

        <div>
          <label class="block text-sm mb-1">Nome completo</label>
          <input type="text" id="name"
            class="w-full px-3 py-2 rounded-md bg-black/40 border border-gray-600 text-white focus:ring-2 focus:ring-purple-500"
            placeholder="Ex: João Silva">
        </div>

        <div>
          <label class="block text-sm mb-1">Username</label>
          <input type="text" id="user_name"
            class="w-full px-3 py-2 rounded-md bg-black/40 border border-gray-600 text-white focus:ring-2 focus:ring-purple-500"
            placeholder="Ex: joaosilva">
        </div>

        <div>
          <label class="block text-sm mb-1">Idade</label>
          <input type="number" id="age" min="0"
            class="w-full px-3 py-2 rounded-md bg-black/40 border border-gray-600 text-white focus:ring-2 focus:ring-purple-500"
            placeholder="Ex: 18">
        </div>

        <!-- hidden fields -->
        <input type="hidden" id="selected-avatar">
        <input type="hidden" id="id">
        <input type="hidden" id="user_id">
        <input type="hidden" id="created_at">
        <input type="hidden" id="updated_at">

        <div class="flex justify-end gap-3 mt-6">
          <button type="button" id="cancel"
            class="px-4 py-2 rounded-md bg-white/10 hover:bg-white/20 transition">Cancelar</button>
          <button type="submit"
            class="px-4 py-2 rounded-md bg-purple-600 hover:bg-purple-700 transition">Salvar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal de seleção de avatar -->
  <div id="avatar-modal" class="hidden fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50">
    <div class="bg-gray-800 p-6 rounded-xl max-w-md w-full">
      <h3 class="text-lg font-semibold mb-4">Escolha uma foto</h3>
      <div id="avatar-grid" class="grid grid-cols-4 gap-4">
        <!-- imagens virão do backend -->
      </div>
      <div class="flex justify-end mt-4">
        <button id="close-avatar-modal" class="px-4 py-2 rounded-md bg-white/10 hover:bg-white/20">Fechar</button>
      </div>
    </div>
  </div>

  <script>
    const availableAvatars = [
      "https://i.pravatar.cc/150?img=1",
      "https://i.pravatar.cc/150?img=2",
      "https://i.pravatar.cc/150?img=3",
      "https://i.pravatar.cc/150?img=4",
      "https://i.pravatar.cc/150?img=5",
    ];

    // Ação para clicar no perfil existente
    document.querySelectorAll('.profile-card').forEach(btn => {
      btn.addEventListener('click', () => {
        const name = btn.getAttribute('data-name') || 'Perfil';
        if (name === "Adicionar") return;
        alert('Entrando como: ' + name);
      });
    });

    // Abrir modal
    document.getElementById('add-profile').addEventListener('click', () => {
      document.getElementById('modal').classList.remove('hidden');
    });

    // Fechar modal
    document.getElementById('cancel').addEventListener('click', () => {
      document.getElementById('modal').classList.add('hidden');
    });

    // Abrir modal de avatar
    document.getElementById('avatar-preview').addEventListener('click', () => {
      const grid = document.getElementById('avatar-grid');
      grid.innerHTML = "";
      availableAvatars.forEach(url => {
        const btn = document.createElement("button");
        btn.className =
          "w-20 h-20 rounded-full overflow-hidden border-2 border-transparent hover:border-purple-500 transition";
        btn.innerHTML = `<img src="${url}" class="w-full h-full object-cover">`;
        btn.addEventListener("click", () => {
          document.getElementById("selected-avatar").value = url;
          document.getElementById("avatar-preview").innerHTML =
            `<img src="${url}" class="w-full h-full object-cover rounded-full">`;
          document.getElementById("avatar-modal").classList.add("hidden");
        });
        grid.appendChild(btn);
      });
      document.getElementById('avatar-modal').classList.remove('hidden');
    });

    // Fechar modal avatar
    document.getElementById('close-avatar-modal').addEventListener('click', () => {
      document.getElementById('avatar-modal').classList.add('hidden');
    });

    // Salvar novo perfil
    document.getElementById('create-profile-form').addEventListener('submit', (e) => {
      e.preventDefault();

      const profile = {
        id: 'id-' + Math.random().toString(36).substr(2, 9),
        user_id: "user-123",
        name: document.getElementById('name').value,
        user_name: document.getElementById('user_name').value,
        age: document.getElementById('age').value,
        image_url: document.getElementById('selected-avatar').value,
        created_at: new Date().toISOString(),
        updated_at: new Date().toISOString()
      };

      const grid = document.getElementById('profile-grid');
      const addBtn = document.getElementById('add-profile');

      const newProfile = document.createElement('button');
      newProfile.className = "profile-card group w-36 focus:outline-none";
      newProfile.setAttribute("data-name", profile.name);
      newProfile.innerHTML = `
        <div class="relative">
          <div class="w-36 h-36 rounded-full border-4 border-purple-600 flex items-center justify-center overflow-hidden bg-gradient-to-tr from-purple-700 via-purple-500 to-pink-500 transform transition duration-200 group-hover:scale-105 group-focus:scale-105">
            ${profile.image_url ? `<img src="${profile.image_url}" alt="${profile.name}" class="w-full h-full object-cover rounded-full">` : `<span class="text-2xl font-bold uppercase">${profile.name.charAt(0)}</span>`}
          </div>
        </div>
        <div class="mt-3 text-center">
          <span class="block text-white font-semibold">${profile.name}</span>
          <span class="block text-xs text-gray-300 mt-1">${profile.age ? profile.age + " anos" : ""}</span>
        </div>
      `;

      newProfile.addEventListener('click', () => {
        alert('Entrando como: ' + profile.name);
      });

      grid.insertBefore(newProfile, addBtn);

      document.getElementById('modal').classList.add('hidden');
      e.target.reset();
      document.getElementById("avatar-preview").innerHTML = "+";
    });

    // Ações dos botões inferiores
    document.getElementById('manage').addEventListener('click', () => {
      alert('Ir para: Gerenciar perfis (placeholder)');
    });
    document.getElementById('signout').addEventListener('click', () => {
      alert('Deslogando... (placeholder)');
    });
  </script>
</body>

</html>