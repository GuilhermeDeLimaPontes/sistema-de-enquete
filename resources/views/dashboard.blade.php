@extends('master')
@section('content')
    <h1 class="display-4 mt-5">Sua(s) Enquete(s)</h1>
    <table class="table mt-5">
        <thead class="table-dark">
            <tr>
                <th scope="col">Título da Enquete</th>
                <th scope="col">Criada em: </th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($pollsUser))
                @foreach ($pollsUser as $pollUser)
                    <tr>
                        <td>{{ $pollUser->title }}</td>
                        <td>{{ $pollUser->created_at }}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="{{ route('poll.show', ['poll' => $pollUser->id,'slug'=>$pollUser->slug]) }}"
                                        class="btn btn-primary">Mostrar Enquete</a></li>
                                <li class="list-inline-item"><a href="{{ route('poll.edit',['poll'=> $pollUser->id,'slug'=>$pollUser->slug]) }}" class="btn btn-info">Editar</a></li>
                                <li class="list-inline-item">
                                    <form method="POST" action="{{ route('poll.destroy', ['poll' => $pollUser->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                    </form>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
