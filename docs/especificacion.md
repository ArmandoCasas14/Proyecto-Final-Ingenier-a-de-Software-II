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

### CA-01: Registro exitoso de una función
* **Dado** que el usuario ingresa un título de película, sala, fecha, hora y un precio válido.
* **Cuando** presiona el botón de guardar.
* **Entonces** la función se almacena en la base de datos y se muestra en la lista general.

### CA-02: Validación de precio negativo o cero
* **Dado** que el usuario intenta registrar una función con un precio menor o igual a cero.
* **Cuando** presiona el botón de guardar.
* **Entonces** el sistema rechaza el registro y muestra un mensaje de error indicando que el precio debe ser positivo.

### CA-03: Emisión exitosa de una entrada
* **Dado** que existe una función seleccionada y se ingresa el nombre del cliente y asiento.
* **Cuando** se confirma el registro de la entrada.
* **Entonces** la entrada queda vinculada a la función seleccionada y disponible para verificación.

### CA-04: Búsqueda y verificación de entrada
* **Dado** un código de entrada o nombre de cliente válido registrado previamente.
* **Cuando** el usuario realiza la consulta.
* **Entonces** el sistema muestra los detalles de la entrada y confirma el acceso a la sala.