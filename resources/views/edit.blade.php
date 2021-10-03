@extends('master')

@section('content')
    @if (!empty($pollAnswers) && !empty($pollTitle))
        <form action="{{ route('poll.update', ['poll' => $id]) }}" method="POST" class="mt-5">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group mb-3">
                <label for="title" class="form-label">Título da Enquete</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $pollTitle }}" required>
            </div>
            @for ($i = 0; $i < $numberOfResponses; $i++)
                <label for="title" class="form-label">Resposta {{ $i + 1 }}</label>
                <input type="text" class="form-control" name="{{ $pollAnswers[$i]->id }}" id="answers"
                    value="{{ $pollAnswers[$i]->name }}" required>
            @endfor
            <button type="submit" class="btn btn-success mt-3">Salvar Alterações</button>
    @endif


    </form>

@endsection
