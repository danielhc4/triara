<!doctype html>
<html class="no-js w-100 h-100" lang="es">
<head>

	<meta charset="utf-8">
		<title>Proyecto Triara</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Normalize CSS -->
		<link rel="stylesheet" href="css/normalize.css">

		<!-- Main Style Boilerplate -->
		<link rel="stylesheet" href="css/main.css">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

		<!-- Angular -->
		<script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js'></script>

		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

		<!-- Main Style Boilerplate -->
		<link rel="stylesheet" href="css/style.css">

		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="js/jquery-3.3.1.min.js"><\/script>')</script>

	</head>

	<body class="w-100 h-100">

		<!--[if IE]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
		<![endif]-->

		
		<div ng-app="triara" ng-controller="indexCtrl" class="container-fluid p-0 m-0">

			<!-- Navbar -->
			<nav class="navbar navbar-light bg-light">
				<a class="navbar-brand" href="#">Proyecto Triara</a>
				<form class="form-inline">
					<button class="btn btn-outline-success" type="button" data-toggle="modal" data-target="#crearContacto">Añadir Contacto</button>
				</form>
			</nav>

			<!-- Tabla de contactos -->
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">NOMBRE</th>
						<th scope="col">PRIMER APELLIDO</th>
						<th scope="col">SEGUNDO APELLIDO</th>
						<th scope="col">ALIAS</th>
						<th scope="col">FECHA DE NACIMIENTO</th>
						<th scope="col">FECHA DE REGISTRO</th>
						<th scope="col">VER CONTACTO</th>
						<th scope="col">ELIMINAR</th>
						<th scope="col">EDITAR</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="contact in contactsArray">
						<td scope="row"><% contact.ID %></td>
						<td><% contact.NOMBRE %></td>
						<td><% contact.APELLIDO_PATERNO %></td>
						<td><% contact.APELLIDO_MATERNO %></td>
						<td><% contact.ALIAS %></td>
						<td><% contact.FECHA_NACIMIENTO %></td>
						<td><% contact.FECHA_CREACION %></td>
						<td><button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#verContacto" ng-model='viewButton' ng-click="loadTmp(contact)">Ver</button></td>
						<td><button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#eliminarContacto" ng-model='deleteButton' ng-click="loadTmp(contact)">Eliminar</button></td>
						<td><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#editarContacto" ng-model='editButton' ng-click="loadTmp(contact)">Editar</button></td>
					</tr>
				</tbody>
			</table>

			<!-- Modal para crear -->
			<div class="modal fade" id="crearContacto" tabindex="-1" role="dialog" aria-labelledby="crearContacto" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Añadir Contacto</h5>
							<button type="button" class="close" data-dismiss="modal" ng-click="unloadTmp()" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<!-- Cuerpo de modal -->
						<div class="modal-body">
							<div class="row">
								<div class="col-6">

									<!-- Form para llenar información personal -->
									<h4>Información Personal</h4>
									<form>
										<div class="form-row mb-3">
											<input type="text" class="form-control" ng-model="createNombre" placeholder="Nombre">
										</div>
										<div class="form-row mb-3">
											<input type="text" class="form-control" ng-model="createPrimerApellido" placeholder="Primer Apellido">
										</div>
										<div class="form-row mb-3">
											<input type="text" class="form-control" ng-model="createSegundoApellido" placeholder="Segundo Apellido">
										</div>
										<div class="form-row mb-3">
											<input type="text" class="form-control" ng-model="createAlias" placeholder="Alias">
										</div>
										<div class="form-row mb-3">
											<input type="date" id="createFechaNacimiento" class="form-control" ng-model="createFechaNacimiento" placeholder="Fecha de Nacimiento">
										</div>
									</form>
								</div>
								<div class="col-6">
									<div class="row">
										<div class="col-12 mb-3">

											<!-- Tabla para mostrar telefonos -->
											<h4>Teléfonos</h4>
											<table class="table table-striped table-bordered triara-table">
												<thead>
													<tr>
														<th>TELÉFONO</th>
														<th>ETIQUETA</th>
													</tr>
												</thead>
												<tbody>
													<tr ng-show="createTelefonosArray.length > 0" ng-repeat="telefono in createTelefonosArray">
														<td><i class="far fa-times-circle" ng-click="createRemoveNumber(telefono)"></i> <% telefono.TELEFONO %></td>
														<td><% telefono.ETIQUETA %></td>
													</tr>
												</tbody>
											</table>

											<!-- Form para llenar telefonos-->
											<form class="form">
												<div class="form-row">
													<div class="col-4">
														<input type="text" ng-model="createTelefono" id="createTelefono" maxlength="10" onkeyup="allowOnlyNumbers(this)" class="form-control" placeholder="Teléfono">
													</div>
													<div class="col-5">
														<input type="text" ng-model="createTelefonoEtiqueta" id="createTelefonoEtiqueta" maxlength="10" class="form-control" placeholder="Etiqueta">
													</div>
													<div class="col-3">
														<button type="button" class="btn btn-success" ng-click="createAddNumber()">Agregar</button>
													</div>
												</div>
											</form>
										</div>
										<div class="col-12">

											<!-- Tabla para mostrar correos -->
											<h4>Correos Electrónicos</h4>
											<table class="table table-striped table-bordered triara-table">
												<thead>
													<tr>
														<th>CORREO ELECTRÓNICO</th>
													</tr>
												</thead>
												<tbody>
													<tr ng-show="createCorreosArray.length > 0" ng-repeat="correo in createCorreosArray">
														<td><i class="far fa-times-circle" ng-click="createRemoveEmail(correo)"></i> <% correo.CORREO %></td>
													</tr>
												</tbody>
											</table>

											<!-- Tabla para llenar correos -->
											<form>
												<div class="form-row">
													<div class="col-9">
														<input type="text" ng-model="createEmail" id="createEmail" maxlength="256" class="form-control" placeholder="Correo Electrónico">
													</div>
													<div class="col-3">
														<button type="button" class="btn btn-success" ng-click="createAddEmail()">Agregar</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" ng-click="unloadTmp()" data-dismiss="modal">Cerrar</button>
							<button type="button" class="btn btn-success" ng-click="createContact()" data-dismiss="modal">Añadir</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal para ver -->
			<div class="modal fade" id="verContacto" tabindex="-1" role="dialog" aria-labelledby="verContacto" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Ver Contacto</h5>
							<button type="button" class="close" data-dismiss="modal" ng-click="unloadTmp()" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-4">
									<img src="/storage/<% contactTmp.IMAGEN %>" alt="Contacto">
								</div>
								<div class="col-4">
									<table class="table table-striped table-dark triara-table">
										<thead>
											<th colspan="2">PERFIL</th>
										</thead>
										<tbody>
											<tr>
												<th>ID</th>
												<td><% contactTmp.ID %></td>
											</tr>
											<tr>
												<th>NOMBRE</th>
												<td><% contactTmp.NOMBRE %></td>
											</tr>
											<tr>
												<th>APELLIDO PATERNO</th>
												<td><% contactTmp.APELLIDO_PATERNO %></td>
											</tr>
											<tr>
												<th>APELLIDO MATERNO</th>
												<td><% contactTmp.APELLIDO_MATERNO %></td>
											</tr>
											<tr>
												<th>ALIAS</th>
												<td><% contactTmp.ALIAS %></td>
											</tr>
											<tr>
												<th>FECHA NACIMIENTO</th>
												<td><% contactTmp.FECHA_NACIMIENTO %></td>
											</tr>
											<tr>
												<th>FECHA REGISTRO</th>
												<td><% contactTmp.FECHA_CREACION %></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-4">
									<table class="table table-striped table-dark triara-table">
										<thead>
											<tr>
												<th>TELÉFONO</th>
												<th>ETIQUETA</th>
											</tr>
										</thead>
										<tbody>
											<tr ng-repeat="telefono in contactTmp.TELEFONOS">
												<td ng-show="contactTmp.TELEFONOS.length > 0"><%telefono.TELEFONO%></td>
												<td ng-show="contactTmp.TELEFONOS.length > 0"><%telefono.ETIQUETA%></td>
												<td ng-show="contactTmp.TELEFONOS.length == 0">NONE</td>
												<td ng-show="contactTmp.TELEFONOS.length == 0">NONE</td>
											</tr>
										</tbody>
									</table>
									<table class="table table-striped table-dark triara-table">
										<thead>
											<tr>
												<th colspan="2">CORREO ELECTRÓNICO</th>
											</tr>
										</thead>
										<tbody>
											<tr ng-repeat="correo in contactTmp.CORREOS">
												<td colspan="2"><%correo.CORREO%></td>
												<td colspan="2" ng-show="contactTmp.TELEFONOS.length == 0">NONE</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" ng-click="unloadTmp()" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal para editar -->
			<div class="modal fade" id="editarContacto" tabindex="-1" role="dialog" aria-labelledby="editarContacto" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Editar Contacto</h5>
							<button type="button" class="close" data-dismiss="modal" ng-click="unloadTmp()" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-6">
									<h4>Información Personal</h4>
									<form>
										<div class="form-row mb-3">
											<input type="text" class="form-control" ng-model="editNombre" placeholder="Nombre">
										</div>
										<div class="form-row mb-3">
											<input type="text" class="form-control" ng-model="editPrimerApellido" placeholder="Primer Apellido">
										</div>
										<div class="form-row mb-3">
											<input type="text" class="form-control" ng-model="editSegundoApellido" placeholder="Segundo Apellido">
										</div>
										<div class="form-row mb-3">
											<input type="text" class="form-control" ng-model="editAlias" placeholder="Alias">
										</div>
										<div class="form-row mb-3">
											<input type="text" class="form-control datepicker" ng-model="editFechaNacimiento" placeholder="Fecha de Nacimiento">
										</div>
										<div class="form-row mb-3">
											<input type="file" class="form-control" ng-model="editImage" name="editImage" onchange="angular.element(this).scope().uploadImage(this.files)" placeholder="Imágen">
										</div>
									</form>
								</div>
								<div class="col-6">
									<div class="row">
										<div class="col-12 mb-3">
											<h4>Teléfonos</h4>
											<table class="table table-striped table-bordered triara-table">
												<thead>
													<tr>
														<th>TELÉFONO</th>
														<th>ETIQUETA</th>
													</tr>
												</thead>
												<tbody>
													<tr ng-show="contactTmp.TELEFONOS.length > 0" ng-repeat="telefono in contactTmp.TELEFONOS">
														<td><i class="far fa-times-circle" ng-click="removeNumber(telefono)"></i> <% telefono.TELEFONO %></td>
														<td><% telefono.ETIQUETA %></td>
													</tr>
												</tbody>
											</table>
											<form class="form">
												<div class="form-row">
													<div class="col-4">
														<input type="text" ng-model="editTelefono" id="editTelefono" maxlength="10" onkeyup="allowOnlyNumbers(this)" class="form-control" placeholder="Teléfono">
													</div>
													<div class="col-5">
														<input type="text" ng-model="editTelefonoEtiqueta" id="editTelefonoEtiqueta" maxlength="10" class="form-control" placeholder="Etiqueta">
													</div>
													<div class="col-3">
														<button type="button" class="btn btn-success" ng-click="addNumber()">Agregar</button>
													</div>
												</div>
											</form>
										</div>
										<div class="col-12">
											<h4>Correos Electrónicos</h4>
											<table class="table table-striped table-bordered triara-table">
												<thead>
													<tr>
														<th>CORREO ELECTRÓNICO</th>
													</tr>
												</thead>
												<tbody>
													<tr ng-show="contactTmp.CORREOS.length > 0" ng-repeat="correo in contactTmp.CORREOS">
														<td><i class="far fa-times-circle" ng-click="removeEmail(correo)"></i> <% correo.CORREO %></td>
													</tr>
												</tbody>
											</table>
											<form>
												<div class="form-row">
													<div class="col-9">
														<input type="text" ng-model="editEmail" id="editEmail" maxlength="256" class="form-control" placeholder="Correo Electrónico">
													</div>
													<div class="col-3">
														<button type="button" class="btn btn-success" ng-click="addEmail()">Agregar</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" ng-click="unloadTmp()" data-dismiss="modal">Cerrar</button>
							<button type="button" class="btn btn-primary" ng-click="editContact()" data-dismiss="modal">Editar</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal para eliminar -->
			<div class="modal fade" id="eliminarContacto" tabindex="-1" role="dialog" aria-labelledby="eliminarContacto" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Eliminar Contacto</h5>
							<button type="button" class="close" data-dismiss="modal" ng-click="unloadTmp()" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>¿Deseas eliminar al contacto <% contactTmp.NOMBRE %> <% contactTmp.APELLIDO_PATERNO %> <% contactTmp.APELLIDO_MATERNO %>?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" ng-click="unloadTmp()" data-dismiss="modal">Cerrar</button>
							<button type="button" class="btn btn-danger" ng-click="deleteContact()" data-dismiss="modal">Eliminar</button>
						</div>
					</div>
				</div>
			</div>

		</div>

		<!-- Modernizr -->
		<script src="js/modernizr-3.7.1.min.js"></script>

		<!-- Boilerplate Plugin JS -->
		<script src="js/plugins.js"></script>

		<!-- Bootstrap JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<!-- Main Js -->
		<script src="js/main.js"></script>


	</body>

</html>