@extends('master')
@section('content')
    <form action="{{ route('poll.store') }}" method="POST" class="mt-5">
        @csrf
        <div id="form">
            @error('answers')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Atenção!!!</strong> Sua Enquete deve ter no mínimo 2 respostas/máximo 10 respostas
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
            <div class="form-group mb-3">
                <label for="title" class="form-label">Título da Enquete</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    value="{{ old('title') }}" required>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group  mb-3">
                <label for="answers" class="form-label">Resposta 1</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="answers[]"
                    value="{{ old('answers[]') }}" required>
            </div>
        </div>
        <button type="button" class="btn btn-danger" id="addField">Adicionar Mais Respostas</button>
        <button type="submit" class="btn btn-primary">Salvar Enquete</button>
    </form>
@endsection
