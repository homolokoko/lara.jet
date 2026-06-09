<table class="table w-full table-compact">
    <thead>
        <tr>
            <td class="border border-gray-500" class="border border-gray-500">Kh Name</td>
            <td class="border border-gray-500">En Name</td>
            <td class="border border-gray-500">Gender</td>
            <td class="border border-gray-500">Date Of Birth</td>
            <td class="border border-gray-500">Other</td>
            <td class="border border-gray-500">Shift</td>
            <td class="border border-gray-500">Class Room</td>
            <td class="border border-gray-500">Mentor</td>
            <td class="border border-gray-500">Action</td>
        </tr>
    </thead>
    <tbody>
        <template x-if="datatable.data.length === 0">
            <tr>
                <td class="border border-gray-500" colspan="9">
                    <div class=" w-full text-center">
                        <template x-for="i in 5">
                            <button class="animate-spin">
                                ⌛︎
                            </button>
                        </template>
                    </div>
                </td>
            </tr>
        </template>
        <template x-for="(elem, index) in datatable.data" x-bind:key="elem.id">
            <tr>
                <td class="border border-gray-500"><span x-text="elem.name_kh">Kh Name</span></td>
                <td class="border border-gray-500"><span x-text="elem.name_en">En Name</span></td>
                <td class="border border-gray-500"><span class="uppercase" x-text="elem.gender">Gender</span>
                </td>
                <td class="border border-gray-500"><span x-text="elem.official_dob">DoB</span></td>
                <td class="border border-gray-500"><span>Other</span></td>
                <td class="border border-gray-500"><span x-text="elem.shift_period"></td>
                <td class="border border-gray-500"><span x-text="elem.room">Class Room</span></td>
                <td class="border border-gray-500"><span x-text="elem.staff.name">Mentor</span></td>
                <td class="border border-gray-500">
                    <button @click="viewRecord(elem.id)" class="btn btn-xs btn-ghost border border-black">👀</button>
                    <button @click="editRecord(elem.id)" class="btn btn-xs btn-ghost border border-black">✏️</button>
                    <button @click="deleteRecord(elem.id)" class="btn btn-xs btn-ghost border border-black">🗑</button>
                </td>
            </tr>
        </template>
    </tbody>
    <tfoot>
        <tr>
            <td class="border border-gray-500" colspan="9">
                <div class="flex gap-5 items-center">
                    <div class="flex">
                        <a @click="triggerPage(1)" :disabled="datatable.current_page==1"
                            class="btn btn-sm btn-secondary rounded-none">⇦first</a>
                        <template x-for="(link,linkIndex) in datatable.links">
                            <a @click="triggerPage(link.page)" class="btn btn-sm btn-secondary rounded-none"
                                :disabled="link.active || !link.url" x-text="link.label"></a>
                        </template>
                        <a @click="triggerPage(datatable.last_page)"
                            :disabled="datatable.current_page==datatable.last_page"
                            class="btn btn-sm btn-secondary rounded-none">last⇨</a>
                    </div>
                    <div class="flex gap-2 items-center">
                        <h3>Per page</h3>
                        <select x-model="per_page" @change="selectedPerpage()" class="h-10 rounded-lg">
                            <option value>per page</option>
                            <option value=5>5</option>
                            <option value=10>10</option>
                            <option value=15>15</option>
                            <option value=25>25</option>
                            <option value=50>50</option>
                        </select>
                    </div>
                    <div class="badge badge-md" x-text="`Current page : ${datatable.current_page}`"></div>
                    <div class="badge badge-md" x-text="`From : ${datatable.from}`"></div>
                    <div class="badge badge-md" x-text="`To : ${datatable.to}`"></div>
                    <div class="badge badge-md" x-text="`Total : ${datatable.total}`"></div>
                </div>
            </td>
        </tr>
    </tfoot>
</table>