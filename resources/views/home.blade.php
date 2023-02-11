@extends('layouts.app')

@section('content')
    <main>
        @include('sections.landing')
        @include('sections.projects')
        @include('sections.small_projects')
    </main>
@endsection
