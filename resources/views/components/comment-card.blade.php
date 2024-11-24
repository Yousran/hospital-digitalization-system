<div class="bg-light-600 dark:bg-dark-400 border border-light-700 dark:border-dark-300 rounded-lg shadow-lg p-4">
    <h2 class="text-lg font-medium text-dark-500 dark:text-light-500 mb-4">Comments</h2>
    @forelse ($comments as $comment)
        <div class="mb-4">
            <p class="text-sm text-dark-500 dark:text-light-500">{{ $comment->comment }}</p>
            <p class="text-xs text-dark-200 dark:text-light-800 mt-1">
                {{ $comment->medicalRecord->patient->user->name ?? 'Unknown' }} - 
                {{ $comment->created_at->format('d M Y, H:i') }}
            </p>
        </div>
    @empty
        <p class="text-sm text-dark-500 dark:text-light-500">No comments available.</p>
    @endforelse
</div>