<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Group Management System</title>
  @vite('resources/css/app.css')
  @fluxAppearance

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
  <flux:header container class="border-b bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

    <flux:brand href="#" logo="https://static.vecteezy.com/system/resources/thumbnails/024/071/650/small_2x/glowing-neon-circle-for-your-decoration-neon-light-round-frame-blank-space-for-text-ultraviolet-spectrum-ring-symbol-halo-png.png" name="GMS" class="max-lg:hidden" />

    <flux:navbar class="-mb-px max-lg:hidden">
      <flux:navbar.item icon="home" href="/">Home</flux:navbar.item>
      <flux:navbar.item icon="wallet" href="/economic-groups">Grupos</flux:navbar.item>
      <flux:navbar.item icon="flag" href="/flags">Bandeiras</flux:navbar.item>
      <flux:navbar.item icon="building-office" href="/units">Unidades</flux:navbar.item>
      <flux:navbar.item icon="briefcase" href="/employees">Colaboradores</flux:navbar.item>
      <flux:separator vertical variant="subtle" class="my-2" />
      <flux:dropdown class="max-lg:hidden">
        <flux:navbar.item icon="chart-pie" icon-trailing="chevron-down">Relatórios</flux:navbar.item>

        <flux:navmenu>
          <flux:navmenu.item href="#">Marketing site</flux:navmenu.item>
        </flux:navmenu>
      </flux:dropdown>
    </flux:navbar>

    <flux:spacer />

    <flux:navbar class="mr-4">
      <flux:dropdown x-data>
        <flux:button variant="subtle" square class="group" aria-label="Preferred color scheme">
          <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini" class="text-zinc-500 dark:text-white" />
          <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini" class="text-zinc-500 dark:text-white" />
        </flux:button>

        <flux:menu>
          <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">Claro</flux:menu.item>
          <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">Escuro</flux:menu.item>
        </flux:menu>
      </flux:dropdown>
    </flux:navbar>

    <flux:dropdown position="top" align="start">
      @auth
      <flux:profile avatar="https://api.dicebear.com/7.x/pixel-art/svg?seed={{ urlencode(Auth::user()->name) }}" />
      @else
      <flux:profile avatar="https://api.dicebear.com/7.x/pixel-art/svg?seed=Guest" />
      @endauth

      <flux:menu>
        <flux:navmenu.item icon="user">{{ Auth::user()->name }}</flux:navmenu.item>

        <flux:menu.separator />

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
          @csrf
        </form>

        <flux:menu.item icon="arrow-right-start-on-rectangle" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Sair
        </flux:menu.item>
      </flux:menu>
    </flux:dropdown>
  </flux:header>

  <flux:sidebar stashable sticky class="border-r lg:hidden bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <flux:brand href="#" logo="https://static.vecteezy.com/system/resources/thumbnails/024/071/650/small_2x/glowing-neon-circle-for-your-decoration-neon-light-round-frame-blank-space-for-text-ultraviolet-spectrum-ring-symbol-halo-png.png" name="GMS" class="px-2" />

    <flux:navlist variant="outline">
      <flux:navlist.item icon="home" href="/">Home</flux:navlist.item>
      <flux:navlist.item icon="wallet" href="/economic-groups">Grupos</flux:navlist.item>
      <flux:navlist.item icon="flag" href="/flags">Bandeiras</flux:navlist.item>
      <flux:navlist.item icon="building-office" href="/units">Unidades</flux:navlist.item>
      <flux:navlist.item icon="briefcase" href="/employees">Colaboradores</flux:navlist.item>
      <flux:separator variant="subtle" class="my-2" />
      <flux:navlist.group expandable heading="Relatórios" icon="chart-pie">
        <flux:navlist.item href=" #">Marketing site</flux:navlist.item>
      </flux:navlist.group>
    </flux:navlist>

    <flux:spacer />

    <flux:navlist variant="outline">
      <flux:dropdown x-data>
        <flux:button variant="subtle" square class="group" aria-label="Preferred color scheme">
          <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini" class="text-zinc-500 dark:text-white" />
          <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini" class="text-zinc-500 dark:text-white" />
        </flux:button>

        <flux:menu>
          <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">Claro</flux:menu.item>
          <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">Escuro</flux:menu.item>
        </flux:menu>
      </flux:dropdown>
    </flux:navlist>
  </flux:sidebar>

  {{ $slot }}

  @fluxScripts
</body>

</html>