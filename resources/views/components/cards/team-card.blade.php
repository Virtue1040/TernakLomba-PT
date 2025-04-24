@props(['teamName', 'date', 'description', 'participants'])

<div x-data="{ formOpen: false }" class="p-4 space-y-3 w-full max-w-xs bg-white rounded-[25px] border border-gray-200">
    <div class="flex justify-between items-center">
        <h3 class="text-sm sm:text-lg font-semibold">{{ $teamName }}</h3>
        <span
            class="px-1 whitespace-nowrap text-[12px] text-gray-500 bg-[#FCFCFD] border border-[#c1c1c1] rounded-full">{{ $date }}</span>
    </div>

    <p class="text-sm text-gray-600">
        {{ $description }}
    </p>

    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-2 bg-[#6B6CF70D] px-2 py-1 rounded-full text-[#6B6CF7]">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="8.5" cy="7" r="4" />
                <path d="M20 8v6" />
                <path d="M23 11h-6" />
            </svg>
            <span class="text-[12px]">{{ $participants }}</span>
        </div>

        <button @click="formOpen = true"
            class="px-2 py-1 whitespace-nowrap md:px-4 md:py-2 md:text-sm text-xs text-white bg-black rounded-full transition-colors hover:bg-gray-800">
            Request Join
        </button>
    </div>

    <div x-show="formOpen" x-cloak class="flex fixed inset-0 top-[-15px] z-50 justify-center items-center bg-black bg-opacity-50"
        @click.self="formOpen = false">
        <div class="bg-white rounded-[16px] w-full max-w-md mx-4 p-6 space-y-4">
            <h2 class="text-xl font-semibold">Request Join</h2>

            <form action="" method="POST">
                @csrf
                <input type="hidden" name="team_name" value="{{ $teamName }}">

                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="rolePosition">
                        Role Position
                    </label>
                    <select name="role_position" id="rolePosition"
                        class="px-3 py-2 w-full rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                        <option value="">Select the role need</option>
                        <option value="ui/ux">UI/UX Designer</option>
                        <option value="Front-End">Front End</option>
                        <option value="Back-End">Back End</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="message">
                        Add your message
                    </label>
                    <textarea name="message" id="message"
                        class="px-3 py-2 w-full h-24 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your message here" required></textarea>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" @click="formOpen = false"
                        class="px-4 py-2 text-red-500 rounded-full border border-red-500 hover:bg-red-50">
                        No, cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-white bg-black rounded-full hover:bg-gray-800">
                        Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
