# Plan de Pruebas - Sistema de Gestión de Cine

## 1. Introducción y Alcance

Este documento define la estrategia y los casos de prueba necesarios para validar el funcionamiento básico del sistema de gestión de funciones y entradas de cine.

* **El alcance abarca:**
  * **Pruebas Unitarias / Integración:** Validación de la lógica de negocio (registro de funciones, emisión de entradas, capacidad de sala y validaciones).
  * **Pruebas de Funcionalidad Básica:** Verificación de flujos correctos y manejo de datos inválidos.

## 2. Estrategia de Pruebas y Herramientas

* **Nivel de Pruebas:**
  * Pruebas unitarias e integración sobre las entidades principales (`Función` y `Entrada`).

* **Framework Sugerido:**
  * `unittest` / `pytest` (para Python) o `Jest` (para JavaScript), según la tecnología de implementación.

* **Criterio de Éxito:**
  * Todos los casos de prueba deben ejecutarse de manera automatizada y finalizar en estado exitoso (PASS).

## 3. Casos de Prueba Automatizados

### CP-01: Registro Exitoso de Función (RF-01 / CA-01)

* **Objetivo:**
  * Verificar que una función con datos válidos se crea correctamente en el sistema.

* **Datos de entrada:**
  * Película: "Avatar 2"
  * Sala: "Sala 1"
  * Fecha/Hora: "2026-11-10 18:00"
  * Precio: 15000

* **Resultado Esperado:**
  * La función se registra exitosamente con un ID asignado.

### CP-02: Rechazo de Función con Precio Inválido (RF-01 / CA-02)

* **Objetivo:**
  * Comprobar que el sistema impida el registro de funciones con precio menor o igual a cero.

* **Datos de entrada:**
  * Película: "Batman"
  * Sala: "Sala 2"
  * Fecha/Hora: "2026-11-10 20:00"
  * Precio: -5000 (o 0)

* **Resultado Esperado:**
  * El sistema rechaza el registro y muestra un mensaje de error indicando que el precio debe ser positivo.

### CP-03: Emisión Exitosa de Entrada (RF-04 / CA-05)

* **Objetivo:**
  * Verificar que se pueda generar una entrada vinculada a una función existente.

* **Datos de entrada:**
  * Función ID: 1
  * Cliente: "Juan Pérez"
  * Asiento: "A-12"

* **Resultado Esperado:**
  * La entrada se genera vinculada a la función especificada y se retorna un código o ID de entrada válido.

### CP-04: Control de Capacidad Máxima de la Sala (RF-07 / CA-08)

* **Objetivo:**
  * Validar que no se puedan registrar más entradas que el número límite de asientos asignados a la sala.

* **Datos de entrada:**
  * Capacidad asignada a la función: 2 asientos.
  * Intentar registrar 3 entradas para esa misma función.

* **Resultado Esperado:**
  * Las primeras 2 entradas se crean correctamente; el registro de la tercera entrada es rechazado por falta de cupo disponible.

## 4. Criterios de Aceptación del Plan de Pruebas

* **CA-01: Implementación de casos de prueba**
  * Todos los casos de prueba descritos deben encontrarse implementados mediante scripts ejecutables.

* **CA-02: Ejecución exitosa de pruebas**
  * La suite de pruebas debe ejecutarse sin errores y validar tanto los casos de éxito como el manejo de errores, incluyendo precios negativos y sobrecupo.