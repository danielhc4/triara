var triara = angular.module('triara', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

triara.controller('indexCtrl', function($scope, $http) {
	$scope.getAllContacts = null;
	$scope.loadTmp = null;
	$scope.unloadTmp = null;
	$scope.contactsArray = [];
	$scope.contactTmp = null;
	$scope.deleteContact = null;
	$scope.editTelefonoEtiqueta = null;
	$scope.removeNumber = null;
	$scope.editEmail = null;
	$scope.editNombre = null;
	$scope.editPrimerApellido = null;
	$scope.editSegundoApellido = null;
	$scope.editAlias = null;
	$scope.editFechaNacimiento = null;
	$scope.editTelefono = null;
	$scope.createNombre = null;
	$scope.createPrimerApellido = null;
	$scope.createSegundoApellido = null;
	$scope.createAlias = null;
	$scope.createFechaNacimiento = null;
	$scope.createAddNumber = null
	$scope.createAddEmail = null;
	$scope.createRemoveEmail = null;
	$scope.uploadImage = null;
	$scope.editDireccion = null;
	$scope.addDireccion = null;
	$scope.removeDireccion = null;
	$scope.createRemoveDireccion = null;
	$scope.createDireccion = null;

	$scope.createTelefonosArray = [];
	$scope.createCorreosArray = [];
	$scope.createDireccionArray = [];

	$scope.getAllContacts = function() {
		$http.get('/api/obtenerContactos').then(function(r) {
			$scope.contactsArray = r.data;
		});
	};

	// funciones para cargar contacto
	$scope.loadTmp = function(contacto) {
		$scope.contactTmp = contacto;

		$scope.editNombre = contacto.NOMBRE;
		$scope.editPrimerApellido = contacto.APELLIDO_PATERNO;
		$scope.editSegundoApellido = contacto.APELLIDO_MATERNO;
		$scope.editAlias = contacto.ALIAS;
		$scope.editFechaNacimiento = contacto.FECHA_NACIMIENTO;
	};

	$scope.unloadTmp = function() {
		$scope.contactTmp = null;

		$scope.editNombre = null;
		$scope.editPrimerApellido = null;
		$scope.editSegundoApellido = null;
		$scope.editAlias = null;
		$scope.editFechaNacimiento = null;
		$scope.editImage = null;

		$scope.editTelefono = null;
		$scope.editTelefonoEtiqueta = null;

		$scope.editEmail = null;

		$scope.createNombre = null;
		$scope.createPrimerApellido = null;
		$scope.createSegundoApellido = null;
		$scope.createAlias = null;
		$scope.createFechaNacimiento = null;

		$scope.createTelefono = null;
		$scope.createTelefonoEtiqueta = null;

		$scope.createTelefonosArray = [];
		$scope.createCorreosArray = [];
	};

	// funciones para eliminar contacto
	$scope.deleteContact = function() {
		$http.get('/api/borrarContacto/' + $scope.contactTmp.ID).then(function(){
			$scope.getAllContacts();
			$scope.unloadTmp();
		});
	};

	// funciones para editar
	$scope.editContact = function() {
		var data = {
			id: $scope.contactTmp.ID,
			nombre: $scope.editNombre,
			apellidoPaterno: $scope.editPrimerApellido,
			apellidoMaterno: $scope.editSegundoApellido,
			fechaNacimiento: $scope.editFechaNacimiento,
			alias: $scope.editAlias,
		};
		$http.post('/api/editarContacto', data).then(function(r) {
			$scope.getAllContacts();
			$scope.unloadTmp();
		});
	};

	// función para subir imagen
	$scope.uploadImage = function(file) {

		var fd = new FormData();

		fd.append("id", $scope.contactTmp.ID);
		fd.append("imagen", file[0]);

		$http.post('/api/editarContacto/', fd, {
			headers: {'Content-Type': undefined },
			transformRequest: angular.identity
		}).then(function() {
			$scope.getAllContacts();
		});
	};

	// funciones para numeros
	$scope.addNumber = function() {
		if( $scope.editTelefono !== null && $scope.editTelefonoEtiqueta !== null && $scope.editTelefono.length == 10 && $scope.editTelefonoEtiqueta.length > 0 ) {
			$('#editTelefono').removeClass('bg-danger');
			$('#editTelefonoEtiqueta').removeClass('bg-danger');
			var data = {
				idContacto: $scope.contactTmp.ID,
				telefono: $scope.editTelefono,
				etiqueta: $scope.editTelefonoEtiqueta,
			};
			$http.post("/api/crearTelefono", data).then(function(r) {
				if( $scope.contactTmp.TELEFONOS !== null ) {
					$scope.contactTmp.TELEFONOS[$scope.contactTmp.TELEFONOS.length] = r.data[0];
				}
				else {
					$scope.contactTmp.TELEFONOS = [r.data[0]];
				}
				$scope.getAllContacts();
				$scope.editTelefono = null;
				$scope.editTelefonoEtiqueta = null;
			});
		}
		else {
			$('#editTelefono').addClass('bg-danger');
			$('#editTelefonoEtiqueta').addClass('bg-danger');
		}
	};

	$scope.removeNumber = function(telefono) {
		$http.get('/api/borrarTelefono/' + telefono.ID + '/' + telefono.ID_CONTACTO).then(function(){
			$scope.getAllContacts();
			for(var i = 0; i < $scope.contactTmp.TELEFONOS.length; i++) {
				if($scope.contactTmp.TELEFONOS[i] == telefono) {
					$scope.contactTmp.TELEFONOS.splice(i, 1);
				}
			}
		});
	};

	// funciones para correo
	$scope.addEmail = function() {
		var email = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if( !email.test( $scope.editEmail ) ) {
			$('#editEmail').addClass('bg-danger');
		}
		else {
			$('#editEmail').removeClass('bg-danger');
			var data = {
				idContacto: $scope.contactTmp.ID,
				correo: $scope.editEmail
			};
			$http.post('/api/crearCorreo', data).then(function(r) {
				if( $scope.contactTmp.CORREOS !== null ) {
					$scope.contactTmp.CORREOS[$scope.contactTmp.CORREOS.length] = r.data[0];
				}
				else {
					$scope.contactTmp.CORREOS = [r.data[0]];
				}
				$scope.getAllContacts();
				$scope.editEmail = null;
			});
		}
	};

	$scope.removeEmail = function(correo) {
		$http.get('/api/borrarCorreo/' + correo.ID + '/' + correo.ID_CONTACTO).then(function(){
			$scope.getAllContacts();
			for(var i = 0; i < $scope.contactTmp.CORREOS.length; i++) {
				if($scope.contactTmp.CORREOS[i] == correo) {
					$scope.contactTmp.CORREOS.splice(i, 1);
				}
			}
		});
	};

	// funciones para direcciones
	$scope.addDireccion = function() {
		var data = {
			idContacto: $scope.contactTmp.ID,
			direccion: $scope.editDireccion
		};
		$http.post('/api/crearDirecciones', data).then(function(r) {
			if( $scope.contactTmp.DIRECCIONES !== null ) {
				$scope.contactTmp.DIRECCIONES[$scope.contactTmp.DIRECCIONES.length] = r.data[0];
			}
			else {
				$scope.contactTmp.DIRECCIONES = [r.data[0]];
			}
			$scope.getAllContacts();
			$scope.editDireccion = null;
		});
	};

	$scope.removeDireccion = function(direccion) {
		$http.get('/api/borrarDirecciones/' + direccion.ID + '/' + direccion.ID_CONTACTO).then(function(){
			$scope.getAllContacts();
			for(var i = 0; i < $scope.contactTmp.DIRECCIONES.length; i++) {
				if($scope.contactTmp.DIRECCIONES[i] == direccion) {
					$scope.contactTmp.DIRECCIONES.splice(i, 1);
				}
			}
		});
	};

	// funciones para crear
	$scope.createAddNumber = function() {
		if( $scope.createTelefono !== null && $scope.createTelefonoEtiqueta !== null && $scope.createTelefono.length == 10 && $scope.createTelefonoEtiqueta.length > 0 ) {
			$('#createTelefono').removeClass('bg-danger');
			$('#createTelefonoEtiqueta').removeClass('bg-danger');
			$scope.createTelefonosArray[$scope.createTelefonosArray.length] = {
				TELEFONO: $scope.createTelefono,
				ETIQUETA: $scope.createTelefonoEtiqueta
			};
			$scope.createTelefono = null;
			$scope.createTelefonoEtiqueta = null;
		}
		else {
			$('#createTelefono').addClass('bg-danger');
			$('#createTelefonoEtiqueta').addClass('bg-danger');
		}
	};

	$scope.createRemoveNumber = function(telefono) {
		for(var i = 0; i < $scope.createTelefonosArray.length; i++) {
			if($scope.createTelefonosArray[i] == telefono) {
				$scope.createTelefonosArray.splice(i, 1);
			}
		}
	};

	$scope.createAddEmail = function() {
		var email = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if( !email.test( $scope.createEmail ) ) {
			$('#createEmail').addClass('bg-danger');
		}
		else {
			$('#createEmail').removeClass('bg-danger');
			$scope.createCorreosArray[$scope.createCorreosArray.length] = {
				CORREO: $scope.createEmail,
			};
			$scope.createEmail = null;
		}
	};

	$scope.createRemoveEmail = function(correo) {
		for(var i = 0; i < $scope.createCorreosArray.length; i++) {
			if($scope.createCorreosArray[i] == correo) {
				$scope.createCorreosArray.splice(i, 1);
			}
		}
	};

	$scope.createContact = function() {
		if( $scope.createNombre !== null && $scope.createPrimerApellido !== null && $scope.createSegundoApellido !== null && $scope.createAlias !== null && $scope.createFechaNacimiento !== null ) {
			var data = {
				nombre: $scope.createNombre,
				apellidoPaterno: $scope.createPrimerApellido,
				apellidoMaterno: $scope.createSegundoApellido,
				alias: $scope.createAlias,
				fechaNacimiento: $scope.createFechaNacimiento,
				telefonos: $scope.createTelefonosArray,
				correos: $scope.createCorreosArray,
				direcciones: $scope.createDireccionArray,
			};
			$http.post('/api/crearContactoFull', data).then(function(r) {
				$scope.getAllContacts();
			});
		}
		$scope.unloadTmp();
	};

	$scope.createAddDireccion = function() {
		$scope.createDireccionArray[$scope.createDireccionArray.length] = {
			DIRECCION: $scope.createDireccion,
		};
		$scope.createDireccion = null;
	};

	$scope.createRemoveDireccion = function(direccion) {
		for(var i = 0; i < $scope.createDireccionArray.length; i++) {
			if($scope.createDireccionArray[i] == direccion) {
				$scope.createDireccionArray.splice(i, 1);
			}
		}
	};

	// init
	$scope.getAllContacts();

});

function allowOnlyNumbers(e) {
	var phone = new RegExp("^[0-9]+$");
	if( !phone.test( $(e).val() ) ) {
		var tmp = $(e).val();
		$(e).val(tmp.substring(0, tmp.length - 1));
	}
}