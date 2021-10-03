@extends('master')

@section('content')
    <form action="{{ route('poll.sum.vote') }}" method="POST">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @csrf

        <div class="row">
            <div class="col-sm-6">
                <h1 class="display-5 mt-5">{{ $pollTitle }}</h1>
                @for ($i = 0; $i < $numberOfResponses; $i++)
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="radio" name="name" value="{{ $pollAnswers[$i]->id }}"
                            required>
                        <label class="form-check-label" for="name">
                            {{ $pollAnswers[$i]->name }}
                        </label>
                    </div>
                @endfor
                <button type="submit" class="btn btn-success mt-3">Votar</button>
            </div>

            <div class="col-sm-6">
                <h1 class="display-6 mt-5">Resultado da Enquete | Total: {{ $votes }}</h1>
                @for ($i = 0; $i < $numberOfResponses; $i++)
                @php
                    $percent = ($pollAnswers[$i]->total_votes == 0 ? 0 : floor(($pollAnswers[$i]->total_votes * 100) / $votes) . '%');
                @endphp
                <h5>{{ $pollAnswers[$i]->name }}<h5>
                        <div class="progress mt-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $percent }}"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">{{ $percent }}</div>
                        </div>
            @endfor
            </div>
        </div>
    </form>
@endsection
