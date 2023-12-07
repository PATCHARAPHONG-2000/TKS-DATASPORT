<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check and Sum</title>

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
            max-height: 30rem;
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
            /* margin-top: 18%; */
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="text-center mt-5">
            <h1>KARATE</h1>
        </div>
        <div class="row score">
            <div class="col-md-5 mt-5 mx-auto" style="background-color: red;">
                <h2 class="mb-4">Enter 7 Numbers</h2>

                <form>
                    <div class="mb-3">
                        <label for="number1" class="form-label">JUDGE 1 :</label>
                        <input type="number" class="form-control" id="number1" tabindex="1"
                            onkeydown="moveToNextInput(event, 'number2')">
                    </div>
                    <div class="mb-3">
                        <label for="number2" class="form-label">JUDGE 2 :</label>
                        <input type="number" class="form-control" id="number2" tabindex="2"
                            onkeydown="moveToNextInput(event, 'number3')">
                    </div>
                    <div class="mb-3">
                        <label for="number3" class="form-label">JUDGE 3 :</label>
                        <input type="number" class="form-control" id="number3" tabindex="3"
                            onkeydown="moveToNextInput(event, 'number4')">
                    </div>
                    <div class="mb-3">
                        <label for="number4" class="form-label">JUDGE 4 :</label>
                        <input type="number" class="form-control" id="number4" tabindex="4"
                            onkeydown="moveToNextInput(event, 'number5')">
                    </div>
                    <div class="mb-3">
                        <label for="number5" class="form-label">JUDGE 5 :</label>
                        <input type="number" class="form-control" id="number5" tabindex="5"
                            onkeydown="moveToNextInput(event, 'number6')">
                    </div>
                    <div class="mb-3">
                        <label for="number6" class="form-label">JUDGE 6 :</label>
                        <input type="number" class="form-control" id="number6" tabindex="6"
                            onkeydown="moveToNextInput(event, 'number7')">
                    </div>
                    <div class="mb-3">
                        <label for="number7" class="form-label">JUDGE 7 :</label>
                        <input type="number" class="form-control" id="number7" tabindex="7"
                            onkeydown="moveToNextInput(event, 'number1')">
                    </div>

                    <button type="button" class="btn btn-primary" onclick="checkAndSum()">SUM</button>
                    <button type="button" class="btn btn-secondary ml-2" onclick="clearInputs()">Clear</button>
                </form>
            </div>

            <span class="line mx-auto"></span>

            <div class="col-md-5 mt-5 mx-auto" style="background-color: blue;">
                <h2 class="mb-4">Enter 7 Numbers</h2>

                <form>
                    <div class="mb-3">
                        <label for="number1" class="form-label">JUDGE 1 :</label>
                        <input type="number" class="form-control" id="number1" tabindex="1"
                            onkeydown="moveToNextInput(event, 'number2')">
                    </div>
                    <div class="mb-3">
                        <label for="number2" class="form-label">JUDGE 2 :</label>
                        <input type="number" class="form-control" id="number2" tabindex="2"
                            onkeydown="moveToNextInput(event, 'number3')">
                    </div>
                    <div class="mb-3">
                        <label for="number3" class="form-label">JUDGE 3 :</label>
                        <input type="number" class="form-control" id="number3" tabindex="3"
                            onkeydown="moveToNextInput(event, 'number4')">
                    </div>
                    <div class="mb-3">
                        <label for="number4" class="form-label">JUDGE 4 :</label>
                        <input type="number" class="form-control" id="number4" tabindex="4"
                            onkeydown="moveToNextInput(event, 'number5')">
                    </div>
                    <div class="mb-3">
                        <label for="number5" class="form-label">JUDGE 5 :</label>
                        <input type="number" class="form-control" id="number5" tabindex="5"
                            onkeydown="moveToNextInput(event, 'number6')">
                    </div>
                    <div class="mb-3">
                        <label for="number6" class="form-label">JUDGE 6 :</label>
                        <input type="number" class="form-control" id="number6" tabindex="6"
                            onkeydown="moveToNextInput(event, 'number7')">
                    </div>
                    <div class="mb-3">
                        <label for="number7" class="form-label">JUDGE 7 :</label>
                        <input type="number" class="form-control" id="number7" tabindex="7"
                            onkeydown="moveToNextInput(event, 'number1')">
                    </div>

                    <button type="button" class="btn btn-primary" onclick="checkAndSum()">SUM</button>
                    <button type="button" class="btn btn-secondary ml-2" onclick="clearInputs()">Clear</button>
                </form>
            </div>
        </div>

        <div id="result" class="mt-4"></div>
        <a href="../score/" target="_blank">เปิดหน้า Score</a>
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
        function checkAndSum() {
            const numbers = [
                parseFloat(document.getElementById('number1').value),
                parseFloat(document.getElementById('number2').value),
                parseFloat(document.getElementById('number3').value),
                parseFloat(document.getElementById('number4').value),
                parseFloat(document.getElementById('number5').value),
                parseFloat(document.getElementById('number6').value),
                parseFloat(document.getElementById('number7').value),
            ];
            const sumOfAllNumbers = numbers.reduce((acc, value) => acc + value, 0);
            console.log(sumOfAllNumbers);

            // 1. ตรวจสอบคะแนนน้อยสุดและมากสุด
            const minValue = Math.min(...numbers);
            const maxValue = Math.max(...numbers);
            console.log(minValue);
            console.log(maxValue);

            // 2. ถ้ามีมากกว่า 1 ช่อง, ลบคะแนนช่องที่มากและน้อยที่สุดออกอย่างละ 1 ช่อง
            if (numbers.filter(value => value === minValue).length > 1 && numbers.filter(value => value === maxValue).length > 1) {
                // ตรวจสอบว่า numbers มีค่าที่มากสุดและน้อยสุด
                const hasMaxValue = numbers.includes(maxValue);
                const hasMinValue = numbers.includes(minValue);

                // ถ้ามีค่าที่มากสุดและน้อยสุด, ให้ลบออก 1 ตัว
                if (hasMaxValue && hasMinValue) {
                    numbers.splice(numbers.indexOf(minValue), 1);
                    numbers.splice(numbers.indexOf(maxValue), 1);

                }
            } else {
                // ถ้าไม่มีค่าที่ซ้ำมากกว่า 1 ครั้ง, ให้ลบค่ามากสุดน้อยสุดออก
                numbers.splice(numbers.indexOf(minValue), 1);
                numbers.splice(numbers.indexOf(maxValue), 1);
            }
            console.log(numbers);

            // 3. นำคะแนนที่เหลือจาก 5 ช่องมาบวกกัน
            const finalSum = numbers.reduce((acc, value) => acc + value, 0);

            // แสดงผลลัพธ์โดยตัดทศนิยมให้เหลือ 2 ตำแหน่ง
            document.getElementById('result').innerHTML = `
                <p>Minimum Value: ${minValue.toFixed(2)}</p>
                <p>Maximum Value: ${maxValue.toFixed(2)}</p>
                <p>Final Sum: ${finalSum.toFixed(2)}</p>
                <p>Max Sum: ${sumOfAllNumbers.toFixed(2)}</p>
            `;


            // เพิ่มข้อมูลคะแนนใน local storage
            localStorage.setItem('finalSum', finalSum.toFixed(2));

        }

        function clearInputs() {
            // คลีร์ค่าใน input fields
            document.getElementById('number1').value = '';
            document.getElementById('number2').value = '';
            document.getElementById('number3').value = '';
            document.getElementById('number4').value = '';
            document.getElementById('number5').value = '';
            document.getElementById('number6').value = '';
            document.getElementById('number7').value = '';

            // คลีร์ค่าที่อยู่ใน Local Storage
            localStorage.removeItem('finalSum');
            localStorage.removeItem('minValue');
            localStorage.removeItem('maxValue');
            localStorage.removeItem('allScores');

            //     // คลีร์ค่าที่แสดงในส่วน "Result"
            document.getElementById('result').innerHTML = '';
        }


    </script>

</body>

</html>