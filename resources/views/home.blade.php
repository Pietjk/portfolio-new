@extends('layouts.app')

@section('content')
    <main>
        @include('sections.landing')
        @include('sections.projects')
        @include('sections.small_projects')
        @include('sections.about')
        @include('sections.footer')
    </main>
@endsection
