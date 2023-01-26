@extends('layouts.app')

@section('title')
    | Type/Project
@endsection

@section('content')

<div class="container mt-5">

    <table class="table">
        <thead>
          <tr>
            <th scope="col">Type</th>
            <th scope="col">Project</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($types as $type)
            <tr>
                <td>{{$type->name}}</td>
                <td>
                    <ul>
                        @foreach ($type->projects as $project)
                        <li>
                            <a href="{{route('admin.project.show', $project)}}">
                                {{$project->name}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </td>

            </tr>
            @empty
                <td colspan="4"><h4>Non ci sono risultati</h4></td>
            @endforelse
        </tbody>
      </table>
</div>


@endsection
