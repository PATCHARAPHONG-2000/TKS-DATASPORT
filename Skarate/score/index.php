<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TKS SPORTDATA</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon.ico">
    <!-- stylesheet -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../../assets/css/score.css">

</head>

<body class="d-flex flex-column">

    <div class="container-fluid">
        <div class="row p-3">
            <div class="col-md-6 aka">
                <h1 class="text-white">AKA</h1>
                <p id="scoreResult" ></p>
            </div>
            <div class="col-md-6 blue">
                <h1 class="text-white">AO</h1>
            </div>
        </div>
    </div>

    <!-- scripts -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../assets/js/adminlte.min.js"></script>
    <script>
        function updateScore() {
            // ดึงค่าคะแนนจาก local storage
            const finalSum = localStorage.getItem('finalSum') || 0;
           

            // แสดงผลลัพธ์คะแนน
            document.getElementById('scoreResult').innerHTML = `
                ${finalSum}
             `;
    
        }

        // เริ่มต้นอัปเดตคะแนนทุก 1 วินาที
        updateScore(); // อัปเดตครั้งแรก
        const updateInterval = setInterval(updateScore, 1000); // 1 วินาที

        // ทำการหยุดการอัปเดตเมื่อกลับไปที่หน้าอื่น
        window.addEventListener('beforeunload', () => {
            clearInterval(updateInterval);
        });

    </script>
</body>

</html>