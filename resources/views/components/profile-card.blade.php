<!-- resources/views/components/profile-card.blade.php -->
<div class="w-full bg-light-600 border border-light-700 rounded-lg shadow dark:bg-dark-400 dark:border-dark-300">
    {{ $menu ?? '' }}
    <div class="flex flex-col items-center">
        {{ $slot ?? '' }}
    </div>
</div>