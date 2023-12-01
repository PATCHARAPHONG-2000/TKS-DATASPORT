<?php 
/**
 **** AppzStory Back Office Management System Template ****
 * Connect Database PHP PDO
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
session_start();
error_reporting(E_ALL); 
date_default_timezone_set('Asia/Bangkok');

/** Class Database สำหรับติดต่อฐานข้อมูล */
class Database {
    /**
     * กำหนดตัวแปรแบบ private
     * Method Connect ใช้สำหรับการเชื่อมต่อ Database
     *
     * @var string|null
     * @return PDO
     */
    private $host = "localhost";
    private $dbname = "tkssport_tks_database";
    private $username = "tkssport_tks_database";
    private $password = "tks_database2566";
    private $conn = null;

    public function connect() {
        try{
            /** PHP PDO */
            $this->conn = new PDO('mysql:host='.$this->host.'; 
                                dbname='.$this->dbname.'; 
                                charset=utf8', 
                                $this->username, 
                                $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้: " . $exception->getMessage();
            exit();
        }
        return $this->conn;
    }
}

/**
 * ประกาศ Instance ของ Class Database
 */
// $Database = new Database();
// $connect = $Database->connect();
// <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel"
//     aria-hidden="true">
//     <div class="modal-dialog" role="document">
//         <div class="modal-content">
//             <div class="modal-header">
//                 <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
//                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//                     <span aria-hidden="true">&times;</span>
//                 </button>
//             </div>
//             <div class="modal-body">
//                 <!-- Add your notification content here -->
//                 <div class="card">
//                     <div class="card-body">
//                         <h5 class="card-title">Notification 1</h5>
//                         <p class="card-text">Some details about notification 1.</p>
//                     </div>
//                 </div>

//                 <div class="card mt-3">
//                     <div class="card-body">
//                         <h5 class="card-title">Notification 2</h5>
//                         <p class="card-text">Some details about notification 2.</p>
//                     </div>
//                 </div>

//                 <!-- Add more cards as needed -->
//             </div>

//             <div class="modal-footer">
//                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
//             </div>
//         </div>
//     </div>
// </div>