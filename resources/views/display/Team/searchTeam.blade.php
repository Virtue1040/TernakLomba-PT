<x-layouts.default footer=false>
    <x-slot name="script">
        <script>
            $(document).ready(function() {
                $("input[name='team_code']").onEnter(function() {
                    search()
                })
            })

            function search() {
                let form = $("#form")
                let button = $("#" + $("input[name='team_code']").val())
                form.find("[name='team_code']").val("")
                form.find("[name='role']").val("")

                if (button.length == 0) {
                    spawnNotification(
                        "Gagal",
                        "Tim lomba tidak ditemukan",
                        "error",
                        1500,
                        () => {
                            console.log("confirmed")
                        },
                        () => {
                            console.log("denied")
                        },
                        () => {
                            
                        }
                    );
                    return
                }
                button.click()
            }

            function sync(teamCode) {
                let form = $("#form")
                form.find("[name='team_code']").val(teamCode)
            }

            function requestJoin() {
                let form = $("#form")
                let teamCode = form.find("[name='team_code']").val()
                let role = form.find("[name='role']").val()

                event.preventDefault()

                if (debounceAjax) {
                    return
                }

                debounceAjax = true

                $.ajax({
                    url: "/api/v1/lombaTeam/" + teamCode,
                    method: "POST",
                    data: {
                        team_code: teamCode,
                        role: role
                    },
                    success: function(data) {
                        debounceAjax = false
                        if (data.success) {
                            spawnNotification(
                                "Berhasil request join",
                                "Request join telah terkirim ke tim lomba",
                                "success",
                                1500,
                                () => {
                                    console.log("confirmed")
                                },
                                () => {
                                    console.log("denied")
                                },
                                () => {
                                    window.location.reload()
                                }
                            );
                        } else {
                            spawnNotification(
                                "Tidak dapat dilanjut",
                                data.message,
                                "error",
                                1500,
                                () => {
                                    console.log("confirmed")
                                },
                                () => {
                                    console.log("denied")
                                },
                                () => {
                                    
                                }
                            );
                        }
                    }
                })
            }
        </script>
    </x-slot>
    <div class="p-4 max-cards.h-screen bg-gradient-to-b from-[#822bf2] to-[#b378ff]">
        <x-nav-2 title="Compspace" ItemColor="text-white" />

        <h1
            class="text-2xl sm:text-3xl md:text-4xl lg:text-[48px] max-w-[300px] sm:max-w-[450px] md:max-w-[500px] lg:max-w-[600px] font-bold text-center text-white mx-auto my-3 mt-5 lg:leading-[120%]">
            Temukan Compspace dan
            Bergabung Dengan Tim
        </h1>
        <div class="flex justify-center my-8 mb-7">
            <x-finder name="team_code" :full=false
                class="lg:w-[671px] md:w-[500px] sm:w-[400px] lg:h-[60px] md:h-[55px] sm:h-[50px] h-[45px] !pr-[142px]"
                placeholder="Masukkan Kode Compspace untuk Join atau Cari dibawah ini">
                <x-slot name="icon">
                    <button onclick="search()"
                        class="flex justify-center items-center px-4 w-full h-8 text-sm font-bold text-white bg-black rounded-full lg:text-base sm:h-9 md:h-10 lg:h-11 sm:px-5 lg:px-6">
                        Lihat Hasil
                    </button>
                </x-slot>
            </x-finder>
        </div>
    </div>
    <div x-data="{ formOpen: false }" class="px-4 mx-auto w-full lg:max-w-[1200px]">
        {{-- <div class="flex overflow-x-auto gap-2 p-4">
            <div
                class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full whitespace-nowrap">
                All
            </div>
            <div
                class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full whitespace-nowrap">
                Finance
            </div>
            <div
                class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full whitespace-nowrap">
                Business
            </div>
            <div
                class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full whitespace-nowrap">
                Design
            </div>
            <div
                class="flex gap-4 justify-center items-center p-4 px-4 border-[#F0F0F0] border-[1px] w-auto h-[44px] rounded-full whitespace-nowrap">
                AI & Machine Learning
            </div>
        </div> --}}

        <div class="flex flex-row gap-4 justify-center px-4 pb-4 mx-auto mt-10 w-full max-w-6xl">
            @foreach ($lomba->getTeams as $compspace)
                @php
                    $isJoinable = $compspace->is_joinable();
                    $hasJoined = $user->check_isJoinedLomba($lomba->id_lomba);
                    $joinedTeamId = $user->get_lomba_joined_team($lomba->id_lomba);
                    $isMyTeam = $joinedTeamId === $compspace->id_team;
                @endphp
                
                <x-cards.team-card
                    team_name="{{ $compspace->team_name }}"
                    date="{{ $compspace->lomba->get_enddate() }}"
                    team_code="{{ $compspace->team_code }}"
                    description="Hai gais, kita lagi butuh anggota nih, ayo join team {{ $compspace->team_name }} kita"
                    participants="{{ $compspace->total_participants() }} / {{ $compspace->max_member }}"
                    :show_join="($isJoinable && !$hasJoined)"
                    :show_joined="(!$isJoinable || $hasJoined) && !$isMyTeam"
                />
            @endforeach
        </div>

        <div x-show="formOpen" x-cloak
            class="flex flex-col fixed inset-0 top-[-15px] z-50 justify-center items-center bg-black bg-opacity-50"
            @click.self="formOpen = false" name="form_requestJoin">
            <div class="bg-white rounded-[16px] w-full max-w-md mx-4 p-6 space-y-4">
                <h2 class="text-xl font-semibold">Join Compsace</h2>

                <form onsubmit="requestJoin()" method="POST" id="form">
                    <input hidden name="team_code" />
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="role">
                            Role Saya
                        </label>
                        <select name="role" id="role"
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
                            Note(Opsional)
                        </label>
                        <textarea name="message" id="message"
                            class="px-3 py-2 w-full h-24 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter your message here"></textarea>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button type="button" @click="formOpen = false"
                            class="px-5 py-2 text-black rounded-md border border-gray-500">
                            Batal
                        </button>
                        <button type="submit" onclick="$(`[name='form_requestJoin']`).css('display', 'none')"
                            class="px-4 py-2 text-white bg-gradient-to-b from-[#822bf2] to-[#b378ff] rounded-md">
                            Selanjutnya
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.default>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
