@extends('template')
@section('content')
			<div class="column-group">
				<div class="all-100">
					<table id="races" class="ink-table bordered hover alternating" >
						<thead>
							<tr>
								<th class="align-left" data-sortable="true">Entité</th>
								<th data-sortable="true">Structure</th>
							</tr>
						</thead>
						<tbody>
							@foreach( $structures as $key => $structure )

							<tr>
								<td>{{ ucfirst( str_singular( $key ) ) }}</td>
								<td><pre>{{ print_r( $structure ) }}</pre></td>
							</tr>

							@endforeach
						</tbody>
					</table>
				</div>
			</div>
@stop
