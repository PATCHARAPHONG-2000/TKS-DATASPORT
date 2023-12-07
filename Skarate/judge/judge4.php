<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUDGE 1 Score</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css">

    <style>
        body {
            overflow: hidden;
            user-select: none;
        }

        .line {
            margin-top: 2rem;
            max-height: 20rem;
            border-right: 0.2px solid black;
            height: 100vh;
        }

        .container {
            display:flow-root;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .score {
            margin-top: 18%;
        }

        /* .col-md-5 {
            padding: 0 1rem; 
        } */
    </style>

</head>

<body>

    <div class="container mt-5">
        <div class="text-center mt-5" >
            <h1>KARATE</h1>
        </div>
        <div class="row score">
            <!-- Left Side -->
            <div class="col-md-5 mt-5 mx-auto">
                <h2 class="mb-4 text-center">AKA</h2>
                <form>
                    <div class="mb-3">
                        <label for="aka_judge1_number1" class="form-label">JUDGE 4 :</label>
                        <input type="number" class="form-control" id="aka_judge1_number1" tabindex="1" step="0.1" min="0" max="10"
                            onkeydown="moveToNextInput(event, 'aka_judge1_number2')">
                    </div>
                    <button type="button" class="btn btn-primary btn-block">SUM</button>
                    <button type="button" class="btn btn-secondary btn-block mt-2"
                        onclick="clearInputs('aka_judge1')">Clear</button>
                </form>
            </div>

            <span class="line mx-auto"></span>

            <!-- Right Side -->
            <div class="col-md-5 mt-5 mx-auto">
                <h2 class="mb-4 text-center">AO</h2>
                <form>
                    <div class="mb-3">
                        <label for="ao_judge1_number1" class="form-label">JUDGE 4 :</label>
                        <input type="number" class="form-control" id="ao_judge1_number1" tabindex="1" step="0.1" min="0" max="10"
                            onkeydown="moveToNextInput(event, 'ao_judge1_number2')">
                    </div>
                    <button type="button" class="btn btn-primary btn-block">SUM</button>
                    <button type="button" class="btn btn-secondary btn-block mt-2"
                        onclick="clearInputs('ao_judge1')">Clear</button>
                </form>
            </div>
        </div>
    </div>

    <!-- scripts -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../assets/js/adminlte.min.js"></script>

    <script>
        function moveToNextInput(event, nextInputId) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById(nextInputId).focus();
            }
        }

        function checkAndSum(judgeId) {
            const numbers = [
                parseFloat(document.getElementById(`${judgeId}_number1`).value),
            ];

            document.getElementById(`result_${judgeId}`).innerHTML = `
                <!-- Adjusted output for JUDGE 1 -->
                <p>Minimum Value: ${minValue.toFixed(2)}</p>
                <p>Maximum Value: ${maxValue.toFixed(2)}</p>
                <p>Final Sum: ${finalSum.toFixed(2)}</p>
                <p>Max Sum: ${sumOfAllNumbers.toFixed(2)}</p>
            `;

            localStorage.setItem(`${judgeId}_finalSum`, finalSum.toFixed(2));
        }

        function clearInputs(judgeId) {

            document.getElementById(`${judgeId}_number1`).value = '';
            document.getElementById(`result_${judgeId}`).innerHTML = '';
        }
    </script>

</body>

</html>