@extends('layouts.app')

@section('content')
    @include('sections.landing')
    @include('sections.about')
    @include('sections.skills')
    @include('sections.experience')
    @include('sections.car')
    <div>
        @include('sections.projects')
        @include('sections.small_projects')
    </div>
    @include('sections.footer')
@endsection
