<table class="table w-full table-compact">
    <thead>
        <tr>
            <td class="border">ID</td>
            <td class="border border-black">Classroom Teacher</td>
            <td class="border border-black">Year Book</td>
            <td class="border border-black">Program Period</td>
            <td class="border border-black">Time Period</td>
            <td class="border border-black">Class Room</td>
            <td class="border border-black">Program Subjects</td>
            <td class="border border-black">Action</td>
        </tr>
    </thead>
    <tbody>
        <template x-for="(elem, index) in datatable.data" :key="elem.id">
            <tr>
                <td class="border border-black" x-text="elem.id"></td>
                <td class="border border-black" x-text="`${elem.detail.staff.name_en} (${elem.detail.staff.name_kh})`">
                </td>
                <td class="border border-black" x-text="elem.name"></td>
                <td class="border border-black" x-text="`${elem.detail.start_course}-${elem.detail.finish_course}`">
                </td>
                <td class="border border-black" x-text="`${elem.detail.start_session}-${elem.detail.finish_session}`">
                </td>
                <td class="border border-black" x-text="elem.detail.class_room"></td>
                <td class="border border-black">
                    <div class="flex flex-wrap gap-5 p-4">
                        <template x-for="subject in elem.subjects" :key="subject.id">
                            <span class="badge badge-sm badge-info"
                                x-text="`${subject.title.official_name} : ${subject.max_score}`"></span>
                        </template>
                    </div>
                </td>
                <td class="border border-black">
                    <div class="p-4">
                        <div class="flex overflow-hidden rounded-lg">
                            <button class="rounded-none btn btn-accent btn-xs">detail</button>
                            <button @click="showEditView(elem.id)"
                                class="rounded-none btn btn-info btn-xs">edit</button>
                            <button @click="remove(elem.id)" class="rounded-none btn btn-error btn-xs">delete</button>
                        </div>
                    </div>
                </td>
            </tr>
        </template>
    </tbody>
    <tfoot>
        <tr>
            <td class="border border-black" colspan="8">
                <div class="flex justify-between">
                    <div class="btn-group"></div>
                    <div class="btn-group">
                        <button :disabled="datatable.current_page===1" @click="goPage(1)"
                            class="btn btn-xs btn-secondary">First Page</button>
                        <template x-for="(link, indx) in datatable.links">
                            <button @click="goPage(link.page)" :disabled="link.active" class="btn btn-xs btn-secondary"
                                x-html="link.label"></button>
                        </template>
                        <button :disabled="datatable.current_page===datatable.last_page"
                            @click="goPage(datatable.last_page)" class="btn btn-xs btn-secondary">Last
                            Page</button>
                    </div>
                </div>
            </td>
        </tr>
    </tfoot>
</table>