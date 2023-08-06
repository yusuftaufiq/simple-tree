@extends('components.templates.main')

@section('title', 'Family Tree')

@section('content')
    <div
        class="min-w-full space-y-5"
        x-data="familyTreeComponent"
        x-ref="familyTreeComponent"
    >
        <div class="tabs flex justify-center">
            <a
                class="tab tab-lifted"
                x-on:click="tableMenuOpened = true; treeMenuOpened = false"
                x-bind:class="{ 'tab-active': tableMenuOpened }"
                x-init="persons = {{ \Illuminate\Support\Js::from($persons) }}"
            >See in Table</a>
            <a
                class="tab tab-lifted"
                x-on:click="treeMenuOpened = true; tableMenuOpened = false"
                x-bind:class="{ 'tab-active': treeMenuOpened }"
            >See in Tree</a>
        </div>
        <div
            class="flex flex-col space-y-3"
            x-show="tableMenuOpened"
        >
            <div class="flex justify-center space-x-3">
                <label class="label">
                    <span class="label-text">Filter persons by name or gender</span>
                </label>
                <input
                    class="input input-bordered input-sm w-full max-w-xs"
                    type="text"
                    x-model="searchPersonKeyword"
                    placeholder="Type here"
                />
            </div>
            <div class="text-center">
                <button
                    class="btn btn-success btn-outline btn-sm"
                    onclick="footer__add_new_person_modal.showModal()"
                >Add New Person</button>
            </div>
        </div>
        <div
            class="flex justify-center space-x-3"
            x-show="treeMenuOpened"
        >
            <label class="label">
                <span class="label-text">Filter only children of</span>
            </label>
            <select
                class="select select-bordered select-sm"
                x-model="filterFamilyTreeByParent"
                placeholder="Filter persons by parent"
            >
                <option
                    value="0"
                    selected
                >ALL</option>
                <template
                    x-for="(person, index) in filteredPersons"
                    :key="person.id"
                >
                    <option
                        x-text="person.name"
                        x-bind:value="person.id"
                    ></option>
                </template>
            </select>
        </div>
        <div class="max-h-[60vh] overflow-y-auto">
            <table
                class="table table-pin-rows table-pin-cols table-md"
                x-show="tableMenuOpened"
            >
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Gender</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <template
                        x-for="(person, index) in filteredPersons"
                        :key="person.id"
                    >
                        <tr>
                            <th
                                class="text-right"
                                x-text="index + 1"
                            ></th>
                            <td x-text="person.name"></td>
                            <td class="text-center"><span
                                    class="badge"
                                    x-text="person.gender"
                                    x-bind:class="{
                                        'badge-error': person.gender === 'FEMALE',
                                        'badge-info': person.gender ===
                                            'MALE'
                                    }"
                                ></span></td>
                            <td class="flex justify-center space-x-1">
                                <button
                                    class="btn btn-info btn-outline btn-sm"
                                    onclick="footer__edit_person_modal.showModal()"
                                    x-on:click="selectedPerson = person"
                                >Edit</button>
                                <button
                                    class="btn btn-error btn-outline btn-sm"
                                    onclick="footer__delete_person_modal.showModal()"
                                    x-on:click="selectedPerson = person"
                                >Delete</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <ul
                class="menu rounded-box"
                x-show="treeMenuOpened"
                x-html="treePersonsHTML"
            >
            </ul>
        </div>

        <x-molecules.modal id="footer__add_new_person_modal">
            <x-slot:title>Add New Person</x-slot:title>

            <div class="form-control mb-5 flex w-full flex-col space-y-2">
                <form
                    id="footer__create_new_person_form"
                    action="{{ route('persons.store') }}"
                    method="POST"
                    x-on:submit="isLoading = true"
                >
                    @csrf

                    <div class="flex flex-col -space-y-1">
                        <label class="label">
                            <span class="label-text">Parent <small><i>- Optional</i></small></span>
                        </label>
                        <select
                            class="select select-bordered select-sm w-full"
                            name="parent_id"
                        >
                            <option
                                value=""
                                selected
                            >Choose here</option>

                            <template
                                x-for="(person, index) in persons"
                                :key="person.id"
                            >
                                <option
                                    x-text="person.name"
                                    x-bind:value="person.id"
                                ></option>
                            </template>
                        </select>
                    </div>
                    <div class="flex flex-col -space-y-1">
                        <label class="label">
                            <span class="label-text">Name</span>
                        </label>
                        <input
                            class="input input-bordered input-sm w-full"
                            name="name"
                            type="text"
                            placeholder="Type here"
                            maxlength="255"
                            required
                        />
                    </div>
                    <div class="flex flex-col -space-y-1">
                        <label class="label">
                            <span class="label-text">Gender</span>
                        </label>
                        <select
                            class="select select-bordered select-sm w-full"
                            name="gender"
                            required
                        >
                            @foreach ($genders as $gender)
                                <option>{{ $gender }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

            <x-slot:footer>
                <button
                    class="btn btn-neutral btn-sm"
                    form="footer__create_new_person_form"
                    type="submit"
                    x-show="!isLoading"
                >Create</button>
                <x-atoms.loading-button x-show="isLoading" />
            </x-slot:footer>
        </x-molecules.modal>

        <x-molecules.modal id="footer__edit_person_modal">
            <x-slot:title>Edit Person</x-slot:title>

            <div class="form-control mb-5 flex w-full flex-col space-y-2">
                <form
                    id="footer__edit_person_form"
                    method="POST"
                    x-bind:action="'{{ route('persons.update', '?') }}'.replace('?', selectedPerson?.id)"
                    x-on:submit="isLoading = true"
                >
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col -space-y-1">
                        <label class="label">
                            <span class="label-text">Parent <small><i>- Optional</i></small></span>
                        </label>
                        <select
                            class="select select-bordered select-sm w-full"
                            name="parent_id"
                        >
                            <option
                                value=""
                                selected
                            >Choose here</option>

                            <template
                                x-for="(person, index) in persons.filter((person) => person.id !== selectedPerson?.id)"
                                :key="person.id"
                            >
                                <option
                                    x-text="person.name"
                                    x-bind:value="person.id"
                                    x-bind:selected="person.id === selectedPerson?.parent_id"
                                ></option>
                            </template>
                        </select>
                    </div>
                    <div class="flex flex-col -space-y-1">
                        <label class="label">
                            <span class="label-text">Name</span>
                        </label>
                        <input
                            class="input input-bordered input-sm w-full"
                            name="name"
                            type="text"
                            placeholder="Type here"
                            x-bind:value="selectedPerson?.name"
                            maxlength="255"
                            required
                        />
                    </div>
                    <div class="flex flex-col -space-y-1">
                        <label class="label">
                            <span class="label-text">Gender</span>
                        </label>
                        <select
                            class="select select-bordered select-sm w-full"
                            name="gender"
                            required
                        >
                            <option
                                disabled
                                selected
                            >Choose here</option>
                            @foreach ($genders as $gender)
                                <option x-bind:selected="'{{ $gender }}' === selectedPerson?.gender">
                                    {{ $gender }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

            <x-slot:footer>
                <button
                    class="btn btn-neutral btn-sm"
                    form="footer__edit_person_form"
                    type="submit"
                    x-show="!isLoading"
                >Update</button>
                <x-atoms.loading-button x-show="isLoading" />
            </x-slot:footer>
        </x-molecules.modal>

        <x-molecules.modal id="footer__delete_person_modal">
            <x-slot:title>Delete Person?</x-slot:title>

            <p class="py-4">Are you sure you want to remove this person? If this person has children, all children are
                removed
                recursively.</p>

            <form
                id="footer__edit_delete_form"
                method="POST"
                x-bind:action="'{{ route('persons.destroy', '?') }}'.replace('?', selectedPerson?.id)"
                x-on:submit="isLoading = true"
            >
                @csrf
                @method('DELETE')
            </form>

            <x-slot:footer>
                <button
                    class="btn btn-error btn-sm"
                    form="footer__edit_delete_form"
                    type="submit"
                    x-show="!isLoading"
                >Delete</button>
                <x-atoms.loading-button x-show="isLoading" />
            </x-slot:footer>
        </x-molecules.modal>
    </div>
@endsection

@section('footer')
    @if ($errors->any())
        <x-molecules.toast class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-molecules.toast>
    @endif

    @if (session('success'))
        <x-molecules.toast class="alert-success">
            {{ session('success') }}
        </x-molecules.toast>
    @endif
@endsection
