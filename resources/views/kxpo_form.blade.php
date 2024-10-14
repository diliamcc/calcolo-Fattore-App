<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcolo KXPO</title>

    <!-- Añadir la metaetiqueta CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Calcola Fattore KXPO</h2>
        <form id="kxpo-form" method="POST" action="/api/calculate-kxpo">
            @csrf
            <div class="mb-3">
                <label for="length" class="form-label">Lunghezza della nave (m)</label>
                <input type="number" step="0.01" class="form-control" id="length" name="length" required>
            </div>
            <div class="mb-3">
                <label for="t_sc" class="form-label">Pescaggio a Pieno Carico (T_sc) (m)</label>
                <input type="number" step="0.01" class="form-control" id="t_sc" name="t_sc" required>
            </div>
            <div class="mb-3">
                <label for="vertical_shift" class="form-label">Posizione verticale (m)</label>
                <input type="number" step="0.01" class="form-control" id="vertical_shift" name="vertical_shift"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Calcola KXPO</button>
        </form>

        <!-- Tabella per mostrare il risultato -->
        <table class="table mt-4" id="result-table" style="display: none;">
            <thead>
                <tr>
                    <th>Parametro</th>
                    <th>Valore</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>KXPO</td>
                    <td id="kxpo-result"></td>
                </tr>
                <tr>
                    <td>Altezza CG_h (m)</td>
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

        <div id="error-message" class="alert alert-danger mt-4" style="display: none;"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Código dentro del evento DOMContentLoaded para asegurar que el DOM esté completamente cargado

            document.getElementById('kxpo-form').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevenir el comportamiento por defecto del formulario

                let formData = new FormData(this);

                // Obtener el token CSRF desde la metaetiqueta
                let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Enviar los datos a la API
                fetch('/api/calculate-kxpo', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Incluir el token CSRF en los encabezados
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
                        // Mostrar el resultado en la tabla
                        document.getElementById('kxpo-result').innerHTML = data.kxpo.toFixed(4);
                        document.getElementById('cg-h-result').innerHTML = (data.length > 200 ? 15 :
                            10); // Lógica para CG_h
                        document.getElementById('result-table').style.display = 'table';
                    })
                    .catch(error => {
                        // Mostrar errores de validación
                        let errorMessage = '';
                        if (error.errors) {
                            for (let field in error.errors) {
                                errorMessage += error.errors[field].join('<br>') + '<br>';
                            }
                        } else {
                            errorMessage = 'Ocurrió un error inesperado.';
                        }
                        document.getElementById('error-message').innerHTML = errorMessage;
                        document.getElementById('error-message').style.display = 'block';
                    });

            });
        });
    </script>
</body>

</html>
