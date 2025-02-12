<?php
 use function Laravel\Folio\name;
name('user.name')
?>
<x-app-layout>
    <p class="dark:text-white">admin panel</p>
    @Volt('count')

<p>{{ $user }}</p>
    @endVolt
</x-app-layout>
