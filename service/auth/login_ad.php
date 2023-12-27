<?php
header('Content-Type: application/json');
require_once '../connect.php';

$Database = new Database();
$conn = $Database->connect();

function respondError($message) {
    echo json_encode(['error' => $message]);
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $users = $_POST["user"];
    $password = $_POST["password"];

    try {
        // Check the role of the user in the users_t table
        $stmt = $conn->prepare("SELECT * FROM users_t WHERE users = :users");
        $stmt->bindParam(':users', $users);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user) {
            if(password_verify($password, $user['password'])) {
                // User exists in the users_t table, and the password is correct
                $_SESSION['AD_ID'] = $user['id'];
                $_SESSION['AD_USERNAME'] = $user['users'];
                $_SESSION['AD_ROLE'] = $user['Role'];

                $kkt = [
                    'KKTP1',
                    'KKTP2',
                    'KKTP3',
                    'KKTP4',
                    'KKTP5',
                ];
                $SP = [
                    'SPGOLF','SPARCH','SPFTBL','SPFUTS','SPVOLYB','SPTEKB','SPTENN','SPWMNG','SPSTEN','SPTENI','SPBDMT','SPBASK','SPTKWD','SPKADO','SPJUDO',
                    'SPBRDG','SPSILT','SPAERB','SPCHSS','SPBILR','SPPTNQ','SPESPT','SPKABD','SPWDBL','SPABXN','SPMUTH','SPVOLY','SPHNDL','SPWREST','SPYCHT',
                    'SPJUDO','SPCYCL','SPWTLF','SPARCH','SPROWG','SPHCKY','SPRUGB','SPFENC','SPMOTC','SPJTSK','SPROLS','SPGYMN','SPFGRS','SPEXTR','SPTRAT','SPDRAU','SPKCKB',
                ];
                
                $SPO = in_array($user['Role'], $SP);
                $KKTP = in_array($user['Role'], $kkt);

                if($_SESSION['AD_ROLE'] == 'superadmin') {
                    $_SESSION['id_city'] = [
                        'province' => $user['province'],
                        'users' => $user['users'],
                        'area' => $user['area'],
                    ];
                    echo json_encode([
                        'status' => true,
                        'users' => 'userad',
                        'role' => 'superadmin',
                        'province' => $_SESSION['id_city']['province'],
                        'message' => 'Admin Login Success'
                    ]);
                    exit();
                } else if($_SESSION['AD_ROLE']) {
                    $_SESSION['id_city'] = [
                        'province' => $user['province'],
                        'users' => $user['users'],
                        'area' => $user['area'],
                    ];

                    echo json_encode([
                        'status' => true,
                        'users' => 'userad',
                        'role' => 'userad',
                        'province' => $_SESSION['id_city']['province'],
                        'message' => 'Admin Login Success'
                    ]);
                    exit();
                } else if($KKTP) {
                    $_SESSION['id_city'] = [
                        'province' => $user['province'],
                        'users' => $user['users'],
                        'area' => $user['area'],
                    ];

                    echo json_encode([
                        'status' => true,
                        'users' => 'userad',
                        'role' => 'users',
                        'province' => $_SESSION['id_city']['province'],
                        'message' => 'Admin Login Success'
                    ]);
                    exit();
                } else if($SPO) {
                    $_SESSION['id_city'] = [
                        'province' => $user['province'],
                    ];

                    echo json_encode([
                        'status' => true,
                        'users' => 'userad',
                        'role' => 'sport',
                        'province' => $_SESSION['id_city']['province'],
                        'message' => 'Admin Login Success'
                    ]);
                    exit();
                } else {
                    respondError('ไม่มีสิทธิ์เข้าใช้งาน');
                }
            } else {
                respondError('Incorrect password');
            }
        } else {
            respondError('ไม่มี Username นี้ในระบบ');
        }
    } catch (PDOException $e) {
        respondError("An error occurred. Please try again later.");
    }
}
?>