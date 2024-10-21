<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcolo Fattore KXPO</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="/css/custom.css" rel="stylesheet">
</head>

<body>
    <div class="container custom-container">
        <h2 class="mb-4 text-center">Calculate Factor KXPO</h2>

        <form id="kxpo-form">
            @csrf
            <!-- Longitud de la Nave -->
            <div class="form-group">
                <label for="length" class="form-label">Length Ship (m)</label>
                <input type="number" step="0.01" class="form-control" id="length" name="length" required>
            </div>

            <!-- Pescaggio a Pieno Carico (T_sc) -->
            <div class="form-group">
                <label for="t_sc" class="form-label">Pescaggio a Pieno Carico (T_sc) (m)</label>
                <input type="number" step="0.01" class="form-control" id="t_sc" name="t_sc" required>
            </div>

            <!-- Posición Vertical (Vertical Shift) -->
            <div class="form-group">
                <label for="vertical_shift" class="form-label">Vertical Shift (m)</label>
                <input type="number" step="0.0001" class="form-control" id="vertical_shift" name="vertical_shift" required>
            </div>

            <!-- PitchAngle -->
            <div class="form-group">
                <label for="PITCH_ANGLE" class="form-label">Pitch Angle</label>
                <input type="number" class="form-control" value="7.5" readonly>
                <small>7.5 grados / <span id="pitch_angle_radians">0.1309</span> radianes</small>
            </div>

            <!-- AngularAccelerationPitch -->
            <div class="form-group">
                <label for="ANGULAR_ACCELERATION_PITCH" class="form-label">Angular Acceleration (rad/s²)</label>
                <input type="number" class="form-control" value="0.105" readonly>
            </div>

            <div class="text-center">
                <button type="button" id="calculate_kxpo" class="btn btn-primary">Calculate KXPO</button>
                <button type="button" class="btn btn-secondary" id="reset-btn">Clean</button>
            </div>
        </form>

        <!-- Validation error messages -->
        <div id="error-message" class="alert alert-danger mt-4" style="display: none;">
            <button type="button" class="btn-close" id="close-error-btn"></button>
            <ul id="error-list"></ul>
        </div>

        <!-- Mensaje de Cargando -->
        <div id="loading-message" class="alert alert-info mt-4" style="display: block !important;">
            <strong>Calculating, please wait...</strong>
        </div>
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Factor KXPO Calculation Result</h5>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-responsive custom-table">
                        <thead>
                            <tr>
                                <th>Parameter</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>KXPO</td>
                                <td id="kxpo-result"></td>
                            </tr>
                            <tr>
                                <td>Height of CG_h (m)</td>
                                <td id="cg-h-result"></td>
                            </tr>
                            <tr>
                                <td>Pitch Angle (grades)</td>
                                <td id="pitch-angle-result">7.5</td>
                            </tr>
                            <tr>
                                <td>Angular Acceleration Pitch (rad/s²)</td>
                                <td id="angular-acceleration-result">0.105</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>

    <!-- JavaScript -->
    <script src="{{ asset('js/kxpo.js') }}"></script>
</body>

</html>
