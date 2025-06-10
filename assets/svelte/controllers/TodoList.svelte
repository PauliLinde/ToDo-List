<script>
    export let actions = [];
</script>

<div>
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-16">
        <div class="px-4 py-2">
            <h1 class="text-gray-800 font-bold text-2xl uppercase">My To-Do List</h1>
        </div>

        <div class="flex gap-4">
            <a class="px-6 py-2 min-w-[120px] text-center text-white bg-violet-600 border border-violet-600 rounded active:text-violet-500 hover:bg-transparent hover:text-violet-600 focus:outline-none focus:ring"
               href="/svelte/actions/add">Add New Action</a>
        </div>

        {#if actions && actions.length > 0}
            <ul class="divide-y divide-gray-200 px-4">
                {#each actions as action}
                    <li class="py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="action-{action.id}" name="action-{action.id}" type="checkbox"
                                       class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                                <label for="action-{action.id}" class="ml-3 block text-gray-900">
                                    <span class="text-lg font-medium">{action.action}</span>
                                    <br>
                                    <span class="text-sm font-light text-gray-500">{action.dueDate}</span>
                                </label>
                            </div>
                            <div class="flex gap-2">
                                <a
                                    href="/svelte/actions/remove/{action.id}"
                                    onclick="console.log('Deleting ID:', {action.id}); return confirm('Are you sure you want to delete this task?')"
                                    class="bg-red-500 text-white px-3 py-1 rounded text-sm font-medium hover:bg-red-600 transition-colors">
                                    Delete
                                </a>
                                <a class="px-4 py-1 text-sm text-white bg-blue-600 border border-blue-600 rounded hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring"
                                   href="/svelte/actions/edit/{action.id}">Edit</a>
                            </div>
                        </div>
                    </li>
                {/each}
            </ul>
        {:else}
            <p class="px-4 py-8 text-center text-gray-500">No actions yet.</p>
        {/if}
    </div>
</div>
