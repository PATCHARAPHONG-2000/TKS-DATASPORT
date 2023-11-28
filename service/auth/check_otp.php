<?php
// session_start();
// header('Content-Type: application/json');
require_once '../connect.php';

$Database = new Database();
$conn = $Database->connect();

function respondError($message)
{
    echo json_encode(['error' => $message]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted_otp = filter_input(INPUT_POST, 'otp', FILTER_SANITIZE_NUMBER_INT);

    if ($submitted_otp !== false) {
        if (isset($_SESSION['otp'], $_SESSION['registration_data']) && time() <= $_SESSION['otp_expiry']) {
            if ($_SESSION['otp'] == $submitted_otp) {
                $data = $_SESSION['registration_data'];

                try {
                    $stmt = $conn->prepare("INSERT INTO users (firstName, lastname, team, gender, email, tell, password) 
                                            VALUES (:firstName, :lastname, :team, :gender, :email, :tell, :password)");
                    
                    // Bind the user data to the prepared statement
                    $stmt->bindParam(':firstName', $data['firstName']);
                    $stmt->bindParam(':lastname', $data['lastname']);
                    $stmt->bindParam(':team', $data['team']);
                    $stmt->bindParam(':gender', $data['gender']);
                    $stmt->bindParam(':email', $data['email']);
                    $stmt->bindParam(':tell', $data['tell']);
                    $stmt->bindParam(':password', $data['password']);


                    $stmt->execute();

                    unset($_SESSION['otp'], $_SESSION['registration_data'], $_SESSION['otp_expiry']); // Clear session data

                    echo json_encode([
                        'status' => true,
                        'message' => 'Registration successful'
                    ]);
                    exit();
                } catch (PDOException $e) {
                    echo json_encode([
                        'status' => false,
                        'message' => 'Error during registration: ' . $e->getMessage(),
                    ]);
                    exit();
                }
            } else {
                http_response_code(401);
                echo json_encode([
                    'status' => false,
                    'message' => 'Invalid OTP',
                ]);
                exit();
            }
        } else {
            http_response_code(401);
            echo json_encode([
                'status' => false,
                'message' => 'OTP has expired or is missing',
            ]);
            exit();
        }
    } else {
        respondError('Invalid OTP format');
    }
}
