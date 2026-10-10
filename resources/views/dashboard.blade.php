@extends('layouts.app')

@section('content')
    <div class="container mx-auto text-white max-w-[1024px] px-10 min-h-screen p-5">
        <a href="{{ route('home') }}">@include('components._header', [$text = 'Dashboard'])</a>
        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full mb-10 shadow-lg">
            <h2 class="text-3xl text-secondary text-shadow-pink pb-5 text-center">Project Groot <a class="float-right" href="{{ route('project.create', ['is_small' => 0]) }}"><i class="fa-solid fa-plus"></i></a></h2>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead class="border-b">
                        <tr>
                            <th class="px-3">Titel</th>
                            <th class="px-3">Text</th>
                            <th class="px-3">Site</th>
                            <th class="px-3">github</th>
                            <th class="px-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr class="border-b">
                                <td class="px-3">{{ $project->title }}</td>
                                <td class="px-3">{{ Str::limit($project->text) }}</td>
                                <td class="px-3">
                                    @if (isset($project->site))
                                        <a href="{{ $project->site }}"> site</a>
                                    @endif
                                </td>
                                <td class="px-3">
                                    @if (isset($project->github))
                                        <a href="{{ $project->github }}"> github</a>
                                    @endif
                                </td>
                                <td class="px-3">
                                    <a class="inline-block" href="{{ route('project.edit', [$project->getKey()]) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('project.destroy', [$project->getKey()]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-block" href="">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full  mb-10">
            <h2 class="text-3xl text-secondary text-shadow-pink pb-5 text-center">Project Klein <a class="float-right" href="{{ route('project.create', ['is_small' => 1]) }}"><i class="fa-solid fa-plus"></i></a></h2>
            <div class="overflow-x-auto">
                <table class="table-auto  w-full">
                    <thead class="border-b">
                        <tr>
                            <th class="px-3">Titel</th>
                            <th class="px-3">Text</th>
                            <th class="px-3">Site</th>
                            <th class="px-3">github</th>
                            <th class="px-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects_sm as $project)
                            <tr class="border-b">
                                <td class="px-3">{{ $project->title }}</td>
                                <td class="px-3">{{ Str::limit($project->text) }}</td>
                                <td class="px-3">
                                    @if (isset($project->site))
                                        <a href="{{ $project->site }}"> site</a>
                                    @endif
                                </td>
                                <td class="px-3">
                                    @if (isset($project->github))
                                        <a href="{{ $project->github }}"> github</a>
                                    @endif
                                </td>
                                <td class="px-3">
                                    <a class="inline-block" href="{{ route('project.edit', [$project->getKey()]) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('project.destroy', [$project->getKey()]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-block" href="">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full mb-10 shadow-lg">
            <h2 class="text-3xl text-secondary text-shadow-pink pb-5 text-center">Over Mij <a class="float-right" href="{{ route('aboutText.create') }}"><i class="fa-solid fa-plus"></i></a></h2>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead class="border-b">
                        <tr>
                            <th class="px-3">Titel</th>
                            <th class="px-3">Subtitel</th>
                            <th class="px-3">Text</th>
                            <th class="px-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aboutTexts as $text)
                            <tr class="border-b">
                                <td class="px-3">{{ $text->title }}</td>
                                <td class="px-3">
                                    @if (isset($text->subtitle))
                                        <a href="{{ $text->subtitle }}"> Subtitel</a>
                                    @endif
                                </td>
                                <td class="px-3">{{ Str::limit($text->text) }}</td>
                                <td class="px-3">
                                    <a class="inline-block" href="{{ route('aboutText.edit', [$text->getKey()]) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('aboutText.destroy', [$text->getKey()]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-block" href="">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full mb-10 shadow-lg">
            <h2 class="text-3xl text-secondary text-shadow-pink pb-5 text-center">Project Details <a class="float-right" href="{{ route('projectDetail.create') }}"><i class="fa-solid fa-plus"></i></a></h2>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead class="border-b">
                        <tr>
                            <th class="px-3">Project</th>
                            <th class="px-3">Titel</th>
                            <th class="px-3">Subtitel</th>
                            <th class="px-3">Text</th>
                            <th class="px-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projectDetails as $detail)
                            <tr class="border-b">
                                <td class="px-3">{{ $detail->project->title }}</td>
                                <td class="px-3">{{ $detail->title }}</td>
                                <td class="px-3">{{ $detail->subtitle }}</td>
                                <td class="px-3">{{ Str::limit($detail->text) }}</td>
                                <td class="px-3">
                                    <a class="inline-block" href="{{ route('projectDetail.edit', [$detail->getKey()]) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('projectDetail.destroy', [$detail->getKey()]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-block" href="">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full mb-10 shadow-lg">
            <h2 class="text-3xl text-secondary text-shadow-pink pb-5 text-center">Categorieën <a class="float-right" href="{{ route('category.create') }}"><i class="fa-solid fa-plus"></i></a></h2>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead class="border-b">
                        <tr>
                            <th class="px-3">Naam</th>
                            <th class="px-3">Icoon</th>
                            <th class="px-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="border-b">
                                <td class="px-3">{{ $category->name }}</td>
                                <td class="px-3">{{ $category->icon }}</td>
                                <td class="px-3">
                                    <a class="inline-block" href="{{ route('category.edit', [$category->getKey()]) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('category.destroy', [$category->getKey()]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-block">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full mb-10 shadow-lg">
            <h2 class="text-3xl text-secondary text-shadow-pink pb-5 text-center">Vaardigheden <a class="float-right" href="{{ route('skill.create') }}"><i class="fa-solid fa-plus"></i></a></h2>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead class="border-b">
                        <tr>
                            <th class="px-3">Naam</th>
                            <th class="px-3">Categorie</th>
                            <th class="px-3">Icoon</th>
                            <th class="px-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skills as $skill)
                            <tr class="border-b">
                                <td class="px-3">{{ $skill->name }}</td>
                                <td class="px-3">{{ $skill->category->name }}</td>
                                <td class="px-3">{{ $skill->icon }}</td>
                                <td class="px-3">
                                    <a class="inline-block" href="{{ route('skill.edit', [$skill->getKey()]) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('skill.destroy', [$skill->getKey()]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-block">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full mb-10 shadow-lg">
            <h2 class="text-3xl text-secondary text-shadow-pink pb-5 text-center">Werkgevers <a class="float-right" href="{{ route('employer.create') }}"><i class="fa-solid fa-plus"></i></a></h2>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead class="border-b">
                        <tr>
                            <th class="px-3">Naam</th>
                            <th class="px-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employers as $employer)
                            <tr class="border-b">
                                <td class="px-3">{{ $employer->name }}</td>
                                <td class="px-3">
                                    <a class="inline-block" href="{{ route('employer.edit', [$employer->getKey()]) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('employer.destroy', [$employer->getKey()]) }}" method="POST" onsubmit="return confirm('Werkgever en bijbehorende ervaringen verwijderen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-block">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full mb-10 shadow-lg">
            <h2 class="text-3xl text-secondary text-shadow-pink pb-5 text-center">Ervaringen <a class="float-right" href="{{ route('experience.create') }}"><i class="fa-solid fa-plus"></i></a></h2>
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead class="border-b">
                        <tr>
                            <th class="px-3">Werkgever</th>
                            <th class="px-3">Functie</th>
                            <th class="px-3">Periode</th>
                            <th class="px-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($experiences as $experience)
                            <tr class="border-b">
                                <td class="px-3">{{ $experience->employer->name }}</td>
                                <td class="px-3">{{ $experience->function }}</td>
                                <td class="px-3">{{ $experience->start_date->format('m-Y') }} - {{ $experience->end_date?->format('m-Y') ?? 'Heden' }}</td>
                                <td class="px-3">
                                    <a class="inline-block" href="{{ route('experience.edit', [$experience->getKey()]) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('experience.destroy', [$experience->getKey()]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-block">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
