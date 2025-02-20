<x-layout>
    <h1 class="text-xl text-red-500">Hello world</h1>
    <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
        <flux:radio value="light" icon="sun" />
        <flux:radio value="dark" icon="moon" />
    </flux:radio.group>
</x-layout>