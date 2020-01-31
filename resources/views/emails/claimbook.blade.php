<table>
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Razón Social</th>
			<th>Teléfono</th>
			<th>Documento</th>
			<th>Correo Electrónico</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>{{$claimBook->name}}</td>
			<td>{{$claimBook->last_name}}</td>
			<td>{{$claimBook->nrs}}</td>
			<td>{{$claimBook->phone_number}}</td>
			<td>{{$claimBook->doc_number}}</td>
			<td>{{$claimBook->email}}</td>
		</tr>
	</tbody>
</table>
<br>
<table>
	<tbody>
		<tr>
			<td>Motivo del Reclamo</td>
		</tr>
		<tr>
			<td>{{$claimBook->reason}}</td>
		</tr>
		<tr>
			<td>Detalle del Reclamo</td>
		</tr>
		<tr>
			<td>{{$claimBook->detail}}</td>
		</tr>
		<tr>
			<td>Solicitud del Cliente</td>
		</tr>
		<tr>
			<td>{{$claimBook->request_client}}</td>
		</tr>
	</tbody>
</table>