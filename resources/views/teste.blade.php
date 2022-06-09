@extends('adminlte::page')


@section('title', 'Adicionar Doutor')

@section('content_header')
<h1>Adicionar Pessoa</h1>
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <h5>OCORREU UM ERRO</h5>
          @foreach ($errors->all() as $error )
            <li> {{$error}}</li>
          @endforeach
    </div>
@endif

    <div class="card card-info">
        <form class="form-horizontal" method="POST" action="{{route('testeAction')}}">
            @csrf

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nome:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control  @error('name1')is-invalid @enderror" name="name" placeholder="Nome...">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">CPF:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control  @error('cpf')is-invalid @enderror" id="cpf" name="cpf" placeholder="cpf">
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control  @error('email')is-invalid @enderror" name="email" placeholder="Email...">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nascimento:</label>
                    <div class="col-sm-10">
                        <input type="date" id="date" class="form-control  @error('birthdate')is-invalid @enderror" name="birthdate" placeholder="Nome...">
                    </div>
                </div>
            </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info">Salvar</button>
        </div>

        </form>
    </div>

    </div>

    <script src="https://unpkg.com/imask"></script>
    <script>
        IMask(
            document.getElementById('cpf'),
            {
                mask: '000.000.000-00'
            }

        );
    </script>
@endsection
