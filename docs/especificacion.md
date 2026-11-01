# Especificación de Requisitos y Criterios de Aceptación

## 1. Requisitos Funcionales (RF)

* **RF-01: Registrar Función**
  * El sistema debe permitir registrar una función de cine indicando: título de la película, sala, fecha, hora y precio de la entrada.
* **RF-02: Listar Funciones**
  * El sistema debe mostrar el listado de funciones disponibles con sus datos principales.
* **RF-03: Editar/Eliminar Función**
  * El sistema debe permitir actualizar los datos de una función o eliminarla del sistema.

* **RF-04: Registrar Entrada (Venta/Acceso)**
  * El sistema debe permitir generar una entrada asociada a una función existente, indicando el nombre del cliente y el número de asiento.
* **RF-05: Consultar / Verificar Entrada**
  * El sistema debe permitir buscar una entrada por su código o cliente para validar el ingreso a la sala de cine.
* **RF-06: Cancelar / Eliminar Entrada**
  * El sistema debe permitir anular o eliminar una entrada registrada.
* **RF-07: Definir Capacidad de la Sala**
  * El sistema debe permitir definir y modificar la capacidad máxima de personas (número de asientos disponibles) para cada sala o función registrada.

---

## 2. Requisitos No Funcionales (RNF)

* **RNF-01: Persistencia de Datos**
  * Toda la información de funciones y entradas debe almacenarse en una base de datos relacional.
* **RNF-02: Validaciones de Entrada**
  * El sistema debe validar que los campos obligatorios no se envíen vacíos y que los datos numéricos (como el precio o asiento) sean válidos.
* **RNF-03: Manejo de Errores**
  * El sistema debe mostrar mensajes claros al usuario ante fallos de validación o datos no encontrados.

---

## 3. Criterios de Aceptación (Dado / Cuando / Entonces)

CA-01: Registro exitoso de una función (RF-01)
Dado que el usuario ingresa un título de película, sala, fecha, hora y un precio válido.

Cuando presiona el botón de guardar.

Entonces la función se almacena en el sistema y se muestra en la lista general de funciones disponibles.

CA-02: Validación de precio negativo o cero (RF-01)
Dado que el usuario intenta registrar una función con un precio menor o igual a cero.

Cuando presiona el botón de guardar.

Entonces el sistema rechaza el registro y muestra un mensaje de error indicando que el precio debe ser un valor positivo.

CA-03: Visualización del listado de funciones (RF-02)
Dado que existen funciones registradas en la base de datos.

Cuando el usuario accede a la sección de funciones.

Entonces el sistema muestra una lista clara con el título, sala, fecha, hora y precio de cada función.

CA-04: Edición o eliminación de una función (RF-03)
Dado que el usuario selecciona una función previamente registrada.

Cuando modifica sus datos (o selecciona la opción de eliminar) y confirma la acción.

Entonces la información de la función se actualiza en el sistema (o se elimina correctamente de la lista).

CA-05: Emisión exitosa de una entrada (RF-04)
Dado que el usuario selecciona una función existente y proporciona el nombre del cliente y el número de asiento deseado.

Cuando confirma la compra o registro de la entrada.

Entonces el sistema genera y almacena la entrada asociada correctamente a esa función.

CA-06: Búsqueda y verificación de entrada (RF-05)
Dado que se ingresa un código de entrada o el nombre de un cliente con un boleto válido.

Cuando el usuario ejecuta la opción de consulta/verificación.

Entonces el sistema muestra los detalles del boleto y confirma que el acceso a la sala es válido.

CA-07: Cancelación o eliminación de una entrada (RF-06)
Dado que el usuario selecciona una entrada ya registrada.

Когда / Cuando presiona la opción de anular o eliminar y confirma la acción.

Entonces el sistema borra o invalida la entrada para que no pueda ser usada en el control de acceso.

CA-08: Definición de la capacidad de la sala (RF-07)
Dado que el usuario está creando o editando una función/sala de cine.

Cuando ingresa el número máximo de asientos disponibles para dicha sala y guarda los cambios.

Entonces el sistema almacena esta capacidad máxima para limitar el registro de entradas y evitar sobrecupos.