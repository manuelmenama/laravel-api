@extends('layouts.app')

@section('title')
    | Type Editor
@endsection

@section('content')

<div class="container mt-5">


    @if (session('message'))

        <div class="alert alert-success">
            {{session('message')}}
        </div>
    @endif

    <form action="{{route('admin.types.store')}}" method="POST">
        @csrf
        <div class="input-group mb-3 w-50">
            <input type="text" class="form-control" placeholder="Nuovo tipo..." name="name">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Add <i class="fa-solid fa-circle-plus"></i></button>
        </div>

    </form>

    <table class="table w-50">
        <thead>
            <tr>
                <th scope="col">Type Edit</th>
                <th scope="col" class="text-center ">
                    <p>
                        Project count
                    </p>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <td class="d-flex">
                        <form action="{{route('admin.types.update', $type)}}" method="POST" class="d-flex">
                            @csrf
                            @method('PATCH')
                            <input type="text" class="form-control border-0 me-2" value="{{$type->name}}" name="name">
                            <button type="submit" class="btn btn-warning me-2"><i class="fa-solid fa-arrow-rotate-left"></i></button>
                        </form>
                        @include('admin.partials.confirm-delete', [
                            'route'=>'types',
                            'message'=>"Confermi l'eliminazione del tipo: $type->name",
                            'entity'=>$type
                        ])
                    </td>
                    <td class="text-center">
                        <span class="badge rounded-pill text-bg-secondary text-center">{{count($type->projects)}}</span>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

@endsection
