@extends('layouts.app')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			<span class="pull-left">Curso # {{ $course_type->id }}</span>

			<div class="btn-group btn-group-xs pull-right" role="group">
				<a href="{{ route('course_types.index') }}" class="btn btn-primary" title="Ver todos">
					<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
				</a>
				<a href="{{ route('course_types.edit', $course_type->id ) }}" class="btn btn-primary" title="Editar">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</a>
				<form method="POST" action="{!! route('course_types.destroy', $course_type->id) !!}" accept-charset="UTF-8" style="display: inline;" novalidate="novalidate">
					<input name="_method" value="DELETE" type="hidden">
					{{ csrf_field() }}
					<button type="submit" class="btn btn-danger btn-xs" title="Deletar" onclick="return confirm(&quot;Tem certeza que quer apagar?&quot;)" id="sometest">
					<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Apagar Curso"></span>
					</button>
				</form>
			</div>

		
		</div>
	</div>

	<div class="panel-body">
		<dl class="dl-horizontal">
			<dt>#id do Tipo de Curso</dt>
			<dd>{{ $course_type->id }}</dd>
			<dt>Nome</dt>
			<dd>{{ $course_type->name }}</dd>
		</dl>

@endsection
