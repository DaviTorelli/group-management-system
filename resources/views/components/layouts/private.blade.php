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
      <flux:navbar.item icon="flag" href="/brands">Bandeiras</flux:navbar.item>
      <flux:navbar.item icon="building-office" href="/units">Unidades</flux:navbar.item>
      <flux:navbar.item icon="briefcase" href="/employees">Colaboradores</flux:navbar.item>
      <flux:separator vertical variant="subtle" class="my-2" />
      <flux:navbar.item icon="chart-pie" href="#">Relatórios</flux:navbar.item>
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
      <flux:profile avatar="https://api.dicebear.com/7.x/pixel-art/svg?seed={{ urlencode(Auth::user()->name) }}" />

      <flux:menu>
        <flux:navmenu.item href="#" icon="user">{{ Auth::user()->name }}</flux:navmenu.item>

        <flux:menu.separator />

        <flux:menu.item icon="arrow-right-start-on-rectangle">Sair</flux:menu.item>
      </flux:menu>
    </flux:dropdown>
  </flux:header>

  <flux:sidebar stashable sticky class="border-r lg:hidden bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <flux:brand href="#" logo="https://static.vecteezy.com/system/resources/thumbnails/024/071/650/small_2x/glowing-neon-circle-for-your-decoration-neon-light-round-frame-blank-space-for-text-ultraviolet-spectrum-ring-symbol-halo-png.png" name="GMS" class="px-2" />

    <flux:navlist variant="outline">
      <flux:navlist.item icon="home" href="#" current>Home</flux:navlist.item>
      <flux:navlist.item icon="wallet" href="#">Grupos</flux:navlist.item>
      <flux:navlist.item icon="flag" href="#">Bandeiras</flux:navlist.item>
      <flux:navlist.item icon="building-office" href="#">Unidades</flux:navlist.item>
      <flux:navlist.item icon="briefcase" href="#">Colaboradores</flux:navlist.item>
      <flux:separator variant="subtle" class="my-2" />
      <flux:navlist.item icon="chart-pie" href="#">Relatórios</flux:navlist.item>
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