@extends('layouts.app')

@section('title')
| Show
@endsection

@section('content')
    <div class="container my-show-container mt-5">

        @if (session('message'))

        <div class="alert alert-success">
            {{session('message')}}
        </div>
        @endif
        <h2>{{ $project->name }}</h2>
        @if($project->type)
        <h6>Categoria: <span class="badge bg-info">{{ $project->type->name }}</span></h6>
        @if ($project->tecnologies)
            @foreach ($project->tecnologies as $tecnology)

            <span class="badge text-bg-warning">{{ $tecnology->name }}</span>

            @endforeach
        @endif
        @endif
        <ul>
            <li>
                {{$project->client_name}}
            </li>
        </ul>
        @if ($project->cover_image)
            <div>
                <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->image_original_name }}">
            </div>
            <small><i>{{ $project->image_original_name }}</i></small>
        @endif
        <p>
            {!!$project->summary!!}
        </p>
        <a href="{{ route('admin.project.index') }}" class="btn btn-success">Torna alla lista</a>
        <a href="{{ route('admin.project.edit', $project) }}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
    </div>

@endsection
