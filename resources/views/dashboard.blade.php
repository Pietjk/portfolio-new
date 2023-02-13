@extends('layouts.app')

@section('content')
    <a href="{{ route('home') }}">@include('components._header', [$text = 'Dashboard'])</a>
    <div class="container mx-auto text-white max-w-[1024px] px-10 min-h-screen p-5">
        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full mb-10 shadow-lg">
            <h2 class="text-3xl text-[#E00496] text-shadow-pink pb-5 text-center">Project Groot <a class="float-right" href="{{ route('project.create', ['is_small' => 0]) }}"><i class="fa-solid fa-plus"></i></a></h2>
            <div class="overflow-x-auto">
                <table class="table-auto over">
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

        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full  ">
            <h2 class="text-3xl text-[#E00496] text-shadow-pink pb-5 text-center">Project Klein <a class="float-right" href="{{ route('project.create', ['is_small' => 1]) }}"><i class="fa-solid fa-plus"></i></a></h2>
            <div class="overflow-x-auto">
                <table class="table-auto">
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
    </div>
@endsection
