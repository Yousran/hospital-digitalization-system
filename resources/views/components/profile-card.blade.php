<!-- resources/views/components/profile-card.blade.php -->
<div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    {{ $menu ?? '' }}
    <div class="flex flex-col items-center">
        {{ $slot ?? '' }}
    </div>
</div>