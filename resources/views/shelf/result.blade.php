@extends('layouts.shelf')
@section('content')

<div class="container">
	<div class="page-header">
		<h2>{{$current->course}}</h2>
	</div>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">

				<a class="btn btn-default navbar-text" href="{{ url('shelf/courses') }}">Voltar</a>

				<button type="button" class="navbar-toggle collapsed navbar-text" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				    <span class="sr-only">Toggle navigation</span>
				    <span class="icon-bar"></span>
				    <span class="icon-bar"></span>
				    <span class="icon-bar"></span>
				</button>
			</div>
			
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-text">
					<li>
				 		<p>Módulo</p>
						<select class="selectpicker" id="select-module">
							<option value="0">Todos</option>
							@for ($i = 1; $i <= $current->number_of_modules; $i++)
								@if ($current->module_id == $i)
									<option value="{{ $i }}" selected>{{ $i }}</option>
								@else
									<option value="{{ $i }}">{{ $i }}</option>
								@endif
							@endfor
						</select>
					</li>
					<li>
						<p>Objeto</p>
						<select class="selectpicker" id="select-type">
							<option value="0">Todos</option>
							@foreach ($current->object_types as $type)								
								@if ($current->type_id == $type->id)
									<option value="{{$type->id}}" selected>{{$type->name}}</option>
								@else
									<option value="{{$type->id}}">{{$type->name}}</option>
								@endif
							@endforeach
						</select>
					</li>
				</ul>
				<form class="navbar-form navbar-right navbar-text">
					<div class="input-group">
						{{-- <input type="text" class="form-control" placeholder="Busca"> --}}
						<input type="text" class="form-control search" placeholder="Busca">

						{{-- //Botões de Ordenação//

						<button class="sort" data-sort="title">Título</button>
						<button class="sort" data-sort="course">Curso</button>
						<button class="sort" data-sort="module">Modulo</button>

						--}}

						<div class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<i class="fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</nav>

	<div id="learning_objects" class="annotated-list">
		<ul class="row list">
			@forelse($learning_objects as $learning_object)
				<li class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
					<div class="thumbnail no-shadow" type="button" data-toggle="modal" data-target="#myModal">
						<span class="label label-default">
							<div class="icon"></div>
							{{ $learning_object->type->name }}
						</span>
						<div class="wrap-image">
							<img class="max-size" src="/covers/{{ $learning_object->cover}}" alt="Image do objeto">
						</div>
						<div class="caption">
							<h3>{{ $learning_object->title }}
								@if (Auth::check())
									<a href="/learning_objects/{{$learning_object->id}}/edit">[editar]</a>
								@endif
							</h3>
						</div>
					</div>
				
				
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
									<img class="modal-image" src="/covers/{{ $learning_object->cover}}" alt="Imagem do objeto">
									<div class="modal-caption">
										<h3 class="modal-title">{{ $learning_object->title }}</h3>
										<p class="modal-author">{{ $learning_object->author }}</p>
									</div>
								</div>
								<div class="modal-body">
									<a class="btn btn-default" href="{{ $learning_object->link }}" role="button">Abrir</a>
									<p><strong>Resumo:</strong><br>
										{{ $learning_object->summary }}
									</p>
								</div>
							</div>
						</div>
					</div>
				</li>

			@empty
				<div>Não há materiais nessa categoria.</div>
			@endforelse
		</ul>
		<ul class="pagination"></ul>
	</div>
	<div><small> {{$current->course}} / {{$current->module}} / {{$current->type}} </small></div>
</div>

@endsection


@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>

<script>
	$('#myModal').on('shown.bs.modal', function () {
		$('#myInput').focus();
	});

	$('#select-module').on('change', function(){
		params = document.location.href.split('/');
		document.location.href = '/shelf/course/'+ params[5] +'/module/'+ this.value +'/type/'+ params[9];
	});

	$('#select-type').on('change', function(){
		params = document.location.href.split('/');
		document.location.href = '/shelf/course/'+ params[5] +'/module/'+ params[7] +'/type/'+ this.value;
	});

//	$('#select-type').
	


	var options = {
		valueNames: ['modal-title', 'modal-body'],
		page: 9,
		pagination: true
	};

	var learning_objectList = new List('learning_objects', options);
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

@endsection
