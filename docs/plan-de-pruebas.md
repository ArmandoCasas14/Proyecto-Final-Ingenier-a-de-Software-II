# Plan de Pruebas - Sistema de Gestión de Cine

## 1. Introducción y Alcance

Este documento define la estrategia y los casos de prueba necesarios para validar el funcionamiento básico del sistema de gestión de funciones y entradas de cine.

* **El alcance abarca:**
  * **Pruebas Unitarias / Integración:** Validación de la lógica de negocio (registro de funciones, emisión de entradas, capacidad de sala y validaciones).
  * **Pruebas de Funcionalidad Básica:** Verificación de flujos correctos y manejo de datos inválidos.

## 2. Herramientas y Entorno de Pruebas

* **Framework de Pruebas:** PHPUnit (integrado de forma nativa en Laravel) / Pest PHP.
* **Entorno de Base de Datos:** Base de datos SQLite en memoria (`:memory:`) para la ejecución rápida e aislada de pruebas automáticas.
* **Comandos de Ejecución:**
  * Ejecutar todas las pruebas: `php artisan test`
  * Ejecutar una suite específica: `php artisan test --testsuite=Feature`

## 3. Casos de Prueba Automatizados

* **CP-RF01: Registrar nueva función de cine**
  * **RF Asociado:** RF-01 (Registro de Funciones).
  * **Descripción:** Verificar que el sistema cree una función cuando los datos son válidos.
  * **Método / Ruta:** `POST /funciones`
  * **Datos de Entrada:**
    * `{"pelicula": "Batman", "sala": "Sala 1", "fecha": "2026-11-10", "hora": "18:00", "precio": 15000}`
  * **Resultado Esperado:**
    * Código HTTP `201 Created` o redirección exitosa, y confirmación en base de datos con `$this->assertDatabaseHas('funciones', ['pelicula' => 'Batman']);`.

* **CP-RF02: Listar funciones disponibles**
  * **RF Asociado:** RF-02 (Consulta / Listado de Funciones).
  * **Descripción:** Verificar que la vista o endpoint retorne el listado de funciones activas.
  * **Método / Ruta:** `GET /funciones`
  * **Datos de Entrada:**
    * Ninguno (se crean 2 funciones previas en el test con `Funcion::factory()`).
  * **Resultado Esperado:**
    * Código HTTP `200 OK` y presencia de los títulos registrados en la respuesta (`$response->assertSee(...)`).

* **CP-RF03: Editar/Eliminar función existente**
  * **RF Asociado:** RF-03 (Edición y Eliminación de Funciones).
  * **Descripción:** Verificar que se actualice la información de una función seleccionada.
  * **Método / Ruta:** `PUT /funciones/{id}`
  * **Datos de Entrada:**
    * `{"precio": 18000}`
  * **Resultado Esperado:**
    * Código HTTP `200 OK` y verificación en base de datos de que el precio cambió a `18000`.

* **CP-RF04: Emitir entrada para una función**
  * **RF Asociado:** RF-04 (Emisión de Entradas).
  * **Descripción:** Verificar el registro exitoso de una entrada asociada a un cliente y asiento.
  * **Método / Ruta:** `POST /entradas`
  * **Datos de Entrada:**
    * `{"funcion_id": 1, "cliente": "Juan Pérez", "asiento": "A5"}`
  * **Resultado Esperado:**
    * Código HTTP `201 Created` y registro en la tabla `entradas` vinculando el `funcion_id`.

* **CP-RF05: Consultar y verificar validez de una entrada**
  * **RF Asociado:** RF-05 (Búsqueda y Verificación de Entradas).
  * **Descripción:** Verificar que se consulten los datos de un boleto emitido mediante su código o ID.
  * **Método / Ruta:** `GET /entradas/{codigo}`
  * **Datos de Entrada:**
    * Código de entrada válido previamente generado.
  * **Resultado Esperado:**
    * Código HTTP `200 OK` retornando el nombre del cliente, sala y confirmación de estado activo.

* **CP-RF06: Anular o eliminar una entrada**
  * **RF Asociado:** RF-06 (Cancelar / Eliminar Entrada).
  * **Descripción:** Verificar la cancelación de una entrada previa.
  * **Método / Ruta:** `DELETE /entradas/{id}`
  * **Datos de Entrada:**
    * ID de una entrada existente.
  * **Resultado Esperado:**
    * Código HTTP `200 OK` (o `204 No Content`) y verificación de que la entrada cambió de estado o se eliminó de la base de datos (`$this->assertDatabaseMissing(...)`).

* **CP-RF07: Control y límite de capacidad de sala**
  * **RF Asociado:** RF-07 (Definir Capacidad de la Sala).
  * **Descripción:** Verificar que el sistema impida vender entradas si la función alcanzó la capacidad máxima.
  * **Método / Ruta:** `POST /entradas`
  * **Datos de Entrada:**
    * Intentar registrar la entrada N+1 en una sala con capacidad N.
  * **Resultado Esperado:**
    * Respuesta HTTP `422 Unprocessable Entity` (o mensaje de validación) indicando que la sala no tiene asientos disponibles.

## 4. Criterios de Aceptación del Plan de Pruebas

* **CA-01: Implementación de casos de prueba**
  * Todos los casos de prueba descritos deben encontrarse implementados mediante scripts ejecutables.

* **CA-02: Ejecución exitosa de pruebas**
  * La suite de pruebas debe ejecutarse sin errores y validar tanto los casos de éxito como el manejo de errores, incluyendo precios negativos y sobrecupo.