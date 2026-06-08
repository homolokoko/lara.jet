<div class="border overflow-hidden rounded gap-5 divide-y ">
    <div class="flex p-5 justify-between">
        <h3 class="font-bold text-xl">PERSONAL INFORMATION</h3>
        <button @click="closeDetailView()" class="btn btn-circle btn-sm btn-error">
            <x-heroicon-o-x class="w-5 h-5" />
        </button>
    </div>
    <table class="table table-normal w-full">
        <tbody>
            <tr>
                <td>
                    <ul>
                        <li>
                            <label class="label-text-alt uppercase" x-text="`Name : ${selectedView.name_kh}`"></label>
                        </li>
                        <li>
                            <label class="label-text-alt uppercase" x-text="`Name : ${selectedView.name_en}`"></label>
                        </li>
                    </ul>
                </td>
                <td>
                    <ul>
                        <li>
                            <label class="label-text-alt uppercase" x-text="`Sex : ${selectedView.gender}`"></label>
                        </li>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`Date Of Birth : ${selectedView.official_dob}`"></label>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>BIRTH PLACE</th>
                <th>CURRENT PLACE</th>
            </tr>
            <tr>
                <td>
                    <ul>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`Village : ${selectedView.birth_address.name}`"></label>
                        </li>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`Commune : ${selectedView.birth_address.city.name}`"></label>
                        </li>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`District : ${selectedView.birth_address.state.name}`"></label>
                        </li>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`Proving : ${selectedView.birth_address.zip.name}`"></label>
                        </li>
                    </ul>
                </td>
                <td>
                    <ul>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`Village : ${selectedView.current_address.name}`"></label>
                        </li>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`Commune : ${selectedView.current_address.city.name}`"></label>
                        </li>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`District : ${selectedView.current_address.state.name}`"></label>
                        </li>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`Proving : ${selectedView.current_address.zip.name}`"></label>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>FATHER INFORMATION</th>
                <th>MOTHER INFORMATION</th>
            </tr>
            <tr>
                <td>
                    <ul>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`Name : ${selectedView.father_info.name}`"></label>
                        </li>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`Profession : ${selectedView.father_info.job}`"></label>
                        </li>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`Main Number : ${selectedView.father_info.main_number}`"></label>
                        </li>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`Seconday Number : ${selectedView.father_info.subs_number}`"></label>
                        </li>
                    </ul>
                </td>
                <td>
                    <ul>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`Name : ${selectedView.mother_info.name}`"></label>
                        </li>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`Profession : ${selectedView.mother_info.job}`"></label>
                        </li>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`Main Number : ${selectedView.mother_info.main_number}`"></label>
                        </li>
                        <li>
                            <label class="label-text-alt uppercase"
                                x-text="`Seconday Number : ${selectedView.mother_info.subs_number}`"></label>
                        </li>
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="flex justify-center items-center p-5">
        <button @click="closeDetailView()" class="btn btn-ghost">Close</button>
    </div>
</div>