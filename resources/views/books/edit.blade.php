@extends('layouts.app')
@section('content')

<!-- CABEÇALHO -->
<section class="content-header">
  <h1>
    Livros
    <small>Editar</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-book"></i> Livros</li>
    <li><a href="{{ route('books.index') }}"><i class="fa fa-list"></i> Listagem</a></li>
    <li class="active"><i class="fa fa-edit"></i> Editar</li>
  </ol>
</section>
<!-- FIM CABEÇALHO -->

<!-- EDITAR LIVRO -->
<section class="content">
  <div class="row">
    <section class="col-md-12">
      <div class="box box-ldi">
        <div class="box-body">
          @if ($errors->any())
          <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
          @endif

          <form method="POST" action="{{ route('books.update', $book->id) }}" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('books/form', [
            'submitButtonLabel' => 'Atualizar',
            'book' => $book,				
            ])
          </form>
        </div>
      </div>
    </section>
  </div>
</section> <!-- FIM EDITAR LIVRO -->

@endsection
