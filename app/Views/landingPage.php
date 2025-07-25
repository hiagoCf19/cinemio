<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="shortcut icon" type="image/png" href="./icon.png">



</head>

<body class="bg-zinc-100 ">
  <header class=" p-4 w-full flex justify-center">
    <div class="w-full max-w-7xl mx-auto flex justify-between items-center">
      <img src="./logo.png" class=" w-52" alt="logo" />

      <div class="flex gap-4">
        <button class="px-8 py-2  text-[#6A0DAD] rounded-lg  font-medium">Entrar</button>
        <button
          class="px-8 py-2 border border-[#6A0DAD] border-2 rounded-lg text-[#6A0DAD] font-medium">Explorar</button>
      </div>
    </div>
  </header>
  <section class="relative flex items-end h-[700px] bg-no-repeat" style="background-image: url('./bg.png');">

    <!-- Título centralizado acima dos cards -->
    <h1 class="absolute top-1/4   left-1/2 transform -translate-x-1/2 text-white text-5xl font-bold text-center">
      Confira os lançamentos <br> mais aguardados!
    </h1>

    <!-- Cards -->
    <div
      class="absolute left-1/2 transform -translate-x-1/2 flex justify-between h-[500px] w-full max-w-7xl -bottom-[20%]">
      <!-- card 1 -->
      <div class="w-[350px] rounded-lg bg-white shadow-lg shadow shadow-lg shadow-black/50">
        <img src="./lancamento1.jpeg" class="rounded-t-lg" alt="agendado">
        <div class="bg-white rounded-b-lg p-4 flex flex-col ">
          <p class=" text-lg text-zinc-800 font-medium">
            Bleach TWBW Season 4 (2026)
          </p>
          <span class="text-zinc-600 text-sm mt-2">
            &Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti amet possimus facilis impedit accusantium
            quisquam reprehenderit aspernatur inventore nihil hic nesciunt temporibus rem quia velit ut ipsum,
            voluptatem culpa. Aliquam.
          </span>
        </div>
      </div>

      <!-- card 2 -->
      <div class="w-[350px] rounded-lg bg-white shadow-lg shadow shadow-lg shadow-black/50">
        <img src="./lancamento2.jpeg" class="rounded-t-lg" alt="agendado">
        <div class="bg-white rounded-b-lg p-4 flex flex-col ">
          <p class=" text-lg text-zinc-800 font-medium">
            Demon Slayer: Kimetsu no Yaiba – Castelo Infinito (2025)
          </p>
          <span class="text-zinc-600 text-sm mt-2">
            &Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti amet possimus facilis impedit accusantium
            quisquam reprehenderit aspernatur inventore nihil hic nesciunt temporibus rem quia velit ut ipsum,
            voluptatem culpa. Aliquam.
          </span>
        </div>
      </div>


      <!-- card 3 -->
      <div class="w-[350px] rounded-lg bg-white shadow-lg shadow shadow-lg shadow-black/50">
        <img src="./lancamento3.jpg" class="rounded-t-lg" alt="agendado">
        <div class="bg-white rounded-b-lg p-4 flex flex-col ">
          <p class=" text-lg text-zinc-800 font-medium">
            My Hero Academia: Final Season (2025)
          </p>
          <span class="text-zinc-600 text-sm mt-2">
            &Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti amet possimus facilis impedit accusantium
            quisquam reprehenderit aspernatur inventore nihil hic nesciunt temporibus rem quia velit ut ipsum,
            voluptatem culpa. Aliquam.
          </span>
        </div>
      </div>
    </div>
  </section>
  <section class=" mt-[20%] bg-gray-900 text-white py-20 px-4">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

      <!-- Imagem ou mockup -->
      <div class="flex justify-center">
        <img src="./devices.png" alt="Dispositivos" class="w-full max-w-md rounded-xl shadow-lg">
      </div>

      <!-- Texto -->
      <div>
        <h2 class="text-4xl font-bold mb-6">Assista de qualquer dispositivo</h2>
        <p class="text-lg text-gray-300 mb-6">
          Curta seus animes favoritos onde estiver: no celular, tablet, computador ou até mesmo na sua TV. Nosso site é
          totalmente responsivo e otimizado para qualquer tela.
        </p>

        <ul class="space-y-3 text-base text-gray-200">
          <li class="flex items-center">
            <svg class="w-6 h-6 text-green-400 mr-2" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path d="M9 12l2 2 4-4" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Compatível com Android e iOS
          </li>
          <li class="flex items-center">
            <svg class="w-6 h-6 text-green-400 mr-2" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path d="M9 12l2 2 4-4" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Navegadores modernos (Chrome, Firefox, Safari)
          </li>
          <li class="flex items-center">
            <svg class="w-6 h-6 text-green-400 mr-2" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path d="M9 12l2 2 4-4" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Compatível com Smart TVs e consoles
          </li>
        </ul>
      </div>
    </div>
  </section>
  <section class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="text-center">
      <h2 class="text-3xl font-bold mb-2">Obtenha mais com o Premium</h2>
      <p class="text-gray-600 mb-8">Os membros aproveitam uma série de vantagens de anime.</p>

      <div class="flex flex-col lg:flex-row justify-center items-center gap-6">

        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm border border-gray-200">
          <div class="mb-6">
            <div data-t="product-icon" class="bg-gray-900 text-white rounded-full w-20 h-20">
              <svg title="Prêmio" xmlns="http://www.w3.org/2000/svg" class="s-1krag50-FanProductIcon edh7c060">
                <path fill="none"
                  d="M25.9995805 2.1706845L15.5442004 17.9313712 2.0056328 11.2757714 9.2325257 33.8h34.15535L50.0715 11.2378527l-13.615663 6.6935002L25.9995805 2.1706845z">
                </path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">FÃ</h3>
            <p class="text-3xl font-bold text-green-500">FREE</p>
          </div>
          <button
            class="text-gray-900 py-3 px-6 rounded-md font-semibold w-full mb-6 hover:text-gray-700 transition duration-300">
            INICIAR </button>
          <ul class="text-left text-gray-700 space-y-2">
            <li class="flex items-center">
              <span class="text-green-500 mr-2">&#10003;</span> Sem anúncios
            </li>
            <li class="flex items-center">
              <span class="text-green-500 mr-2">&#10003;</span> Acesso ilimitado à biblioteca Crunchyroll
            </li>
          </ul>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm border-4 border-blue-400 relative">
          <div
            class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-blue-400 text-white text-xs font-bold px-3 py-1 rounded-full">
            MELHOR NEGÓCIO!
          </div>
          <div class="mb-6">
            <img src="https://via.placeholder.com/60x60" alt="Coroa" class="mx-auto mb-4">
            <h3 class="text-xl font-semibold mb-2">MEGA FÃ (1 mês)</h3>
            <p class="text-3xl font-bold text-gray-800">R$ 19,99 / mês</p>
            <p class="text-sm text-gray-500">+ IMPOSTOS APLICÁVEIS</p>
          </div>
          <button
            class="bg-orange-500 text-white py-3 px-6 rounded-md font-semibold w-full mb-3 hover:bg-orange-600 transition duration-300">
            COMECE O TESTE GRATUITO DE 7 DIAS
          </button>
          <button
            class="text-orange-500 py-3 px-6 rounded-md font-semibold w-full mb-6 hover:text-orange-600 transition duration-300">
            PULAR TESTE GRATUITO
          </button>
          <ul class="text-left text-gray-700 space-y-2">
            <li class="flex items-center">
              <span class="text-green-500 mr-2">&#10003;</span> Sem anúncios
            </li>
            <li class="flex items-center">
              <span class="text-green-500 mr-2">&#10003;</span> Acesso ilimitado à biblioteca Crunchyroll
            </li>
            <li class="flex items-center">
              <span class="text-green-500 mr-2">&#10003;</span> Novos episódios logo após o Japão
            </li>
            <li class="flex items-center">
              <span class="text-green-500 mr-2">&#10003;</span> Transmita em 4 dispositivos ao mesmo tempo
            </li>
            <li class="flex items-center">
              <span class="text-green-500 mr-2">&#10003;</span> Visualização offline
            </li>
            <li class="flex items-center">
              <span class="text-green-500 mr-2">&#10003;</span> Acesse o Crunchyroll Game Vault, um catálogo de jogos
              gratuitos
            </li>
            <li class="flex items-center">
              <span class="text-green-500 mr-2">&#10003;</span> 16% de desconto no Plano Mensal<br>(cobrado a cada 12
              meses)
            </li>
          </ul>
        </div>


      </div>
      <p class="text-xs text-gray-500 mt-8">*A disponibilidade na Loja Crunchyroll pode variar de acordo com o país.</p>
    </div>
  </section>





</body>

</html>