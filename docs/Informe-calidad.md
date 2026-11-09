# Reporte de errores – CineManager

## BUG-001 – Botón lateral de consulta de entradas

**ID:** BUG-001  
**Requisito afectado:** RF-05 – Consultar / Verificar Entrada  
**Caso de prueba:** CP-05  
**Entorno:** CineManager · ambiente de desarrollo local · Google Chrome 157 · Windows 11

**Pasos para reproducir:**
1. Ingresar al sistema CineManager.
2. Ubicar el menú lateral de navegación.
3. Hacer clic en «Consultar entradas».

**Resultado esperado:**

El sistema debe abrir la vista de consulta de entradas, permitiendo buscar registros por código o nombre del cliente.

**Resultado obtenido:**

El sistema redirigía a la vista de inicio en lugar de mostrar la pantalla de consulta, debido a que el método `buscar()` del controlador exigía un parámetro de búsqueda incluso al ingresar por primera vez.

**Evidencia:**

Al acceder directamente a la ruta `entradas/buscar`, el sistema regresaba al inicio. Se corrigió la validación del método `buscar()` para permitir mostrar la vista sin realizar una búsqueda inicial.

**Justificación de severidad:**

Media. El error impedía acceder a la funcionalidad de consulta desde el menú lateral, afectando el uso de un requisito funcional del sistema.

**Justificación de prioridad:**

Media. Era necesario corregir el problema para permitir el acceso normal a la consulta de entradas.

---

## BUG-002 – Tarjeta de verificación de entradas

**ID:** BUG-002  
**Requisito afectado:** RF-05 – Consultar / Verificar Entrada  
**Caso de prueba:** CP-05  
**Entorno:** CineManager · ambiente de desarrollo local · Google Chrome 157 · Windows 11

**Pasos para reproducir:**
1. Ingresar al sistema CineManager.
2. Ubicarse en la pantalla de inicio.
3. Hacer clic en la tarjeta «Verificar entradas».

**Resultado esperado:**

El sistema debe redirigir a la vista de consulta de entradas para buscar y verificar el ingreso de los clientes.

**Resultado obtenido:**

La tarjeta no dirigía correctamente a la vista de consulta porque utilizaba `url('entradas.buscar')` en lugar de utilizar el nombre de la ruta registrada en Laravel.

**Evidencia:**

Se identificó que el enlace de la tarjeta utilizaba una dirección incorrecta. Se corrigió reemplazando `url('entradas.buscar')` por `route('entradas.buscar')` y se comprobó que el acceso funcionara correctamente.

**Justificación de severidad:**

Media. El error impedía utilizar uno de los accesos principales a la funcionalidad de verificación de entradas desde el dashboard.

**Justificación de prioridad:**

Media. Se debía corregir para garantizar que la tarjeta de acceso rápido cumpliera su función y permitiera navegar correctamente dentro del sistema.

## 3. Métricas de Control de Calidad

* **Resumen General de Defectos:**
  * **Total de errores reportados:** 2
  * **Total de errores resueltos:** 2
  * **Tasa de resolución:** 100% de los defectos identificados fueron subsanados antes del despliegue o entrega final.

* **Clasificación por Severidad:**
  * **Alta (Crítico / Bloqueante):** 0 (0%)
  * **Media (Funcionalidad limitada / Error de navegación):** 2 (100%)
  * **Baja (Cosmético / Menor):** 0 (0%)

* **Clasificación por Prioridad de Atención:**
  * **Alta (Atención inmediata):** 0 (0%)
  * **Media (Atención programada en el sprint):** 2 (100%)
  * **Baja (Deseable / Ajuste secundario):** 0 (0%)

* **Análisis de Impacto y Densidad de Errores:**
  * **Módulos afectados:** Módulo de navegación general (sidebar) y panel de control principal (dashboard).
  * **Causa raíz principal:** Mala referencia de rutas estáticas (`url()` vs `route()`) y falta de manejo de parámetros opcionales en el controlador de la interfaz de consulta (`buscar()`).
  * **Tiempo medio de resolución (MTTR):** Inmediato / Mismo ciclo de iteración.

## 4. Mantenimiento y Acciones Correctivas

* **Mantenimiento Correctivo (Soluciones Aplicadas):**
  * **Ajuste en la lógica de control (`EntradaController.php`):**
    * Se modificó el método `buscar()` para validar la presencia de parámetros de búsqueda (`$request->has('codigo')` o `$request->filled('q')`).
    * Se configuró el flujo para que, si no se envía ningún parámetro (acceso inicial a la vista), el controlador retorne la plantilla Blade con la lista completa o la vista de consulta limpia, en lugar de invocar una redirección forzada al `home`.

  * **Ajuste de enrutamiento en vistas Blade (`navigation.blade.php` / `dashboard.blade.php`):**
    * Se reemplazaron las direcciones escritas a mano (`url('entradas.buscar')`) por el helper nominal de Laravel (`route('entradas.buscar')`).
    * Se verificó la consistencia en los nombres de las rutas definidos en el archivo `routes/web.php`.

* **Mantenimiento Preventivo y Buenas Prácticas:**
  * **Estandarización de enrutamiento:**
    * Exigir el uso exclusivo del helper `route()` en todos los botones, enlaces y formularios del proyecto para evitar errores si la URI cambia en el futuro.

  * **Firmas de métodos flexibles:**
    * Asegurar que todos los métodos del controlador encargados de filtrado o búsqueda soporten parámetros opcionales o nulos sin romper la renderización de la vista base.

  * **Pruebas de navegación e integración (Feature Tests):**
    * Incorporar en la suite de PHPUnit pruebas de código HTTP `200 OK` al acceder directamente a las rutas `GET` del menú lateral para prevenir regresiones.