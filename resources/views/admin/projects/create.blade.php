@extends('layouts.app')

@section('title')

| Create

@endsection

@section('content')

<div class="container mt-5">

    @if ($errors->any())

    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
            @endforeach
        </ul>
    </div>

    @endif
    <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data">

        @csrf


        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Project name..." name="name" value="{{old('name')}}">
            @error('name')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="client_name" class="form-label">Client name</label>
            <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name" placeholder="Client name..." name="client_name" value="{{old('client_name')}}">
            @error('client_name')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Select type</label>
            <select class="form-select" aria-label="Default select example" id="type" name="type_id">
                <option>Seleziona il tipo</option>
                @foreach ($types as $type)
                    <option
                        @if ($type->id == old('type_id'))
                            selected
                        @endif
                        value="{{ $type->id }}">
                        {{ $type->name }}
                    </option>
                @endforeach

              </select>
        </div>

        <div class="mb-3">
            <p>Used tecnologies</p>

            @foreach ($tecnologies as $tecnology)
                <input
                    id="tec{{$loop->iteration}}"
                    type="checkbox"
                    name="tecnologies[]"
                    value="{{$tecnology->id}}"
                    @if (in_array($tecnology->id, old('tecnologies',[])))
                        checked
                    @endif>
                <label class="me-2" for="tec{{$loop->iteration}}">{{$tecnology->name}}</label>
            @endforeach

        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Cover image</label>
            <input
                onchange="showImage(event)"
                type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" placeholder="Image path..." name="cover_image" value="{{old('cover_image')}}">
            @error('cover_image')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
            <div>
                <img class="my-minature" id="output-image" src="" alt="">
            </div>
        </div>
        <div class="mb-3">
            <label for="summary" class="form-label">Summary</label>
            <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" rows="3" name="summary"></textarea>
            @error('summary')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Invia</button>
    </form>
</div>


<script>
    ClassicEditor
        .create( document.querySelector( '#summary' ), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        } )
        .catch( error => {
            console.error( error );
        } );

    function showImage(event){
        const targetImage = document.getElementById('output-image');
        targetImage.src = URL.createObjectURL(event.target.files[0]);
    }
</script>

@endsection
