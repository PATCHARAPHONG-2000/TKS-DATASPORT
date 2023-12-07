<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUDGE 1 Score</title>
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
            display: flow-root;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .score {
            margin-top: 18%;
        }
    </style>

</head>

<body>

    <div class="container mt-5">
        <div class="text-center mt-5">
            <h1>KARATE</h1>
        </div>
        <div class="row score">
            <div class="col-md-5 mt-5 mx-auto" style="background-color: red;">
                <h2 class="mb-4 text-center">AKA</h2>
                <form id="judge1Form">
                    <div class="mb-3">
                        <label for="aka_judge1_number1" class="form-label">JUDGE 1 :</label>
                        <input type="number" class="form-control" id="aka_judge1_number1" tabindex="1" step="0.1"
                            min="0" max="10">
                    </div>
                    <button type="button" class="btn btn-primary btn-block"
                        onclick="sendToIndex('aka', 'judge1')">ส่ง</button>
                    <button type="button" class="btn btn-secondary btn-block mt-2"
                        onclick="clearInputs('aka_judge1')">ลบ</button>
                </form>
            </div>

            <span class="line mx-auto"></span>

            <div class="col-md-5 mt-5 mx-auto" style="background-color: blue;">
                <h2 class="mb-4 text-center">AO</h2>
                <form>
                    <div class="mb-3">
                        <label for="ao_judge1_number1" class="form-label">JUDGE 1 :</label>
                        <input type="number" class="form-control" id="ao_judge1_number1" tabindex="1" step="0.1" min="0"
                            max="10">
                    </div>
                    <button type="button" class="btn btn-primary btn-block"
                        onclick="sendToIndex('ao', 'judge1')">ส่ง</button>
                    <button type="button" class="btn btn-secondary btn-block mt-2"
                        onclick="clearInputs('ao_judge1')">ลบ</button>
                </form>
            </div>
        </div>
        <div class="col-md-5 mt-5 mx-auto" style="background-color: red;">
            <div id="scoreDisplay"></div>
        </div>
    </div>

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../assets/js/adminlte.min.js"></script>

    <script>
        function sendToIndex(category, judge) {
            var score = document.getElementById(category + '_judge' + judge + '_number1').value;

            var displayElement = document.getElementById('scoreDisplay');
            displayElement.innerHTML = 'คะแนน ' + category + ' จาก JUDGE ' + judge + ': ' + score;
            var data = {
                category: category,
                judge: judge,
                score: score
            };

            var jsonData = JSON.stringify(data);
            localStorage.setItem('judgesData', jsonData);
        }
    </script>




</body>

</html>