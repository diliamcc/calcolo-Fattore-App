<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculo Fattore KXPO</title>

    <!-- Añadir la metaetiqueta CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Incluir Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluir CSS personalizado -->
    <link href="/css/custom.css" rel="stylesheet">
</head>

<body>
    <div class="container custom-container">
        <h2 class="mb-4 text-center">Calcular el Fattore KXPO</h2>

        <!-- Formulario para ingresar los valores -->
        <form id="kxpo-form" method="POST" action="/api/calculate-kxpo">
            @csrf
            <!-- Longitud de la Nave -->
            <div class="form-group">
                <label for="length" class="form-label">Longitud de la Nave (m)</label>
                <input type="number" step="0.01" class="form-control" id="length" name="length" required>
            </div>

            <!-- Pescaggio a Pieno Carico (T_sc) -->
            <div class="form-group">
                <label for="t_sc" class="form-label">Pescaggio a Pieno Carico (T_sc) (m)</label>
                <input type="number" step="0.01" class="form-control" id="t_sc" name="t_sc" required>
            </div>

            <!-- Posición Vertical (Vertical Shift) -->
            <div class="form-group">
                <label for="vertical_shift" class="form-label">Posición Vertical (m)</label>
                <input type="number" step="0.0001" class="form-control" id="vertical_shift" name="vertical_shift"
                    required>
            </div>

            <!-- Altura del Centro de Gravedad (CG_h) - No editable -->
            <div class="form-group">
                <label for="cg_h" class="form-label">Altura del Centro de Gravedad (CG_h)</label>
                <input type="number" class="form-control" id="cg_h" readonly>
            </div>

            <!-- PitchAngle (fijo en 7.5 grados y convertido a radianes) - No editable -->
            <div class="form-group">
                <label for="pitch_angle" class="form-label">PitchAngle</label>
                <input type="number" class="form-control" value="7.5" readonly>
                <small>7.5 grados / <span id="pitch_angle_radians">0.1309</span> radianes</small>
            </div>

            <!-- AngularAccelerationPitch - No editable -->
            <div class="form-group">
                <label for="angular_acceleration_pitch" class="form-label">Angular Acceleration Pitch (rad/s²)</label>
                <input type="number" class="form-control" value="0.105" readonly>
            </div>

            <!-- Botones de Enviar (azul) y Limpiar (verde) -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Calcular KXPO</button>
                <button type="button" class="btn btn-secondary" id="reset-btn">Limpiar</button>
            </div>
        </form>

        <!-- Mensajes de error de validación -->
        <div id="error-message" class="alert alert-danger mt-4" style="display: none;">
            <button type="button" class="btn-close" id="close-error-btn"></button>
            <ul id="error-list"></ul>
        </div>
    </div>

    <!-- Modal de Bootstrap para mostrar la tabla de resultados -->
    <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- Centrar el modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Risultato del Calcolo Fattore KXPO</h5>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-responsive custom-table">
                        <thead>
                            <tr>
                                <th>Parámetro</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>KXPO</td>
                                <td id="kxpo-result"></td>
                            </tr>
                            <tr>
                                <td>Altura del CG_h (m)</td>
                                <td id="cg-h-result"></td>
                            </tr>
                            <tr>
                                <td>PitchAngle (grados)</td>
                                <td id="pitch-angle-result">7.5</td>
                            </tr>
                            <tr>
                                <td>AngularAccelerationPitch (rad/s²)</td>
                                <td id="angular-acceleration-result">0.105</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir Bootstrap 5 JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('kxpo-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevenir el comportamiento por defecto del formulario

            let formData = new FormData(this);
            document.getElementById('error-message').style.display = 'none'; // Limpiar mensajes anteriores
            document.getElementById('error-list').innerHTML = '';

            // Enviar los datos a la API
            fetch('/api/calculate-kxpo', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw err;
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    // Mostrar el resultado en la tabla del modal
                    document.getElementById('kxpo-result').innerHTML = data.kxpo.toFixed(4);
                    document.getElementById('cg-h-result').innerHTML = data.cg_h;

                    // Mostrar el modal con los resultados
                    let resultModal = new bootstrap.Modal(document.getElementById('resultModal'));
                    resultModal.show();
                })
                .catch(error => {
                    // Mostrar errores de validación
                    if (error.errors) {
                        Object.values(error.errors).forEach(errArray => {
                            errArray.forEach(err => {
                                const li = document.createElement('li');
                                li.textContent = err;
                                document.getElementById('error-list').appendChild(li);
                            });
                        });
                    } else {
                        document.getElementById('error-list').innerHTML =
                            '<li>Ocurrió un error inesperado.</li>';
                    }
                    document.getElementById('error-message').style.display = 'block';
                });
        });

        // Botón para cerrar mensajes de error
        document.getElementById('close-error-btn').addEventListener('click', function() {
            document.getElementById('error-message').style.display = 'none';
        });

        // Botón para limpiar el formulario
        document.getElementById('reset-btn').addEventListener('click', function() {
            document.getElementById('kxpo-form').reset(); // Limpiar los inputs
        });
    </script>
</body>

</html>
