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