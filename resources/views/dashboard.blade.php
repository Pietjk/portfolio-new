@extends('layouts.app')

@section('content')
    @include('components._header', [$text = 'Dashboard'])
    <div class="container mx-auto text-white max-w-[1024px] px-10 min-h-screen p-5">
        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full mb-10 shadow-lg">
            <h2 class="text-3xl text-[#E00496] text-shadow-pink pb-5 text-center">Project Groot</h2>
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
                    @foreach ($projects as $project)
                        <tr class="border-b">
                            <td class="px-3">{{ $project->title }}</td>
                            <td class="px-3">{{ Str::limit($project->text) }}</td>
                            <td class="px-3"><a href="{{ $project->site }}"> site</a></td>
                            <td class="px-3"><a href="{{ $project->github }}"> github</a></td>
                            <td class="px-3">
                                <a class="inline-block" href="{{ $project->github }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a class="inline-block" href="{{ $project->github }}">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mx-auto p-5 rounded-xl bg-[#170129] w-full">
            <h2 class="text-3xl text-[#E00496] text-shadow-pink pb-5 text-center">Project Klein</h2>
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
                            <td class="px-3"><a href="{{ $project->site }}"> site</a></td>
                            <td class="px-3"><a href="{{ $project->github }}"> github</a></td>
                            <td class="px-3">
                                <a class="inline-block" href="{{ $project->github }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a class="inline-block" href="{{ $project->github }}">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
@endsection
