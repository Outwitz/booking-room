<?php 

class Database {
    private $host = 'localhost';
    private $dbname = 'webapp7';
    private $username = 'root';
    private $password = 'root';
    private $conn;

    public function __construct() {

        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            // Set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function regUser($username, $password, $c_password, $MemberType, $Phone, $rank) {

        if (empty($username) || empty($password)) {
            $_SESSION['error'] = "Please fill in the form.";
            header("Location: register.php");
            return; 
        }

        $checkUser = $this->conn->prepare("SELECT COUNT(*) FROM Member WHERE Username = ?");
        $checkUser->execute([$username]);
        if ($checkUser->fetchColumn() > 0) {
            $_SESSION['error'] = "This username is already taken.";
            header("Location: register.php");
            return;
        } 

        if ($password == $c_password) {
            //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            try {
                $stmt = $this->conn->prepare("INSERT INTO Member(Username, Password, MemberType, Phone, Rank) VALUES(?, ?, ?, ?, ?)");
                $stmt->execute([$username, $password, $MemberType, $Phone, $rank]);

                if ($stmt) {
                    $_SESSION['success'] = "Registration successfully!";
                    header("Location: register.php");
                } else {
                    $_SESSION['error'] = "Something went wrong, please try again.";
                    header("Location: register.php");
                }
    
            } catch(PDOException $e) {
                $_SESSION['error'] = "Something went wrong, please try again.";
                header("Location: register.php");
                echo "Error: " . $e->getMessage();
            }
        } else {
            $_SESSION['error'] = "Password do not match, please try again.";
            header("Location: register.php");
        }
    }
    // Function to validate and log in the user
public function loginUser($username, $password) {
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Please fill in the form.";
        header("Location: login.php");
        exit();
    }

    try {
        $stmt = $this->conn->prepare("SELECT * FROM Member WHERE Username = ? AND Password = ?");
        
        $stmt->execute([$username, $password]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        
        if ($user) {
            $_SESSION['success'] = "Login successful!";
            $_SESSION['userId'] = $user['Username'];
            $_SESSION['userRank'] = $user['Rank'];
            $_SESSION['memberid'] = $user['MemberID'];

            $user_name = $_SESSION['userId'];

            $stmt2 = $this->conn->prepare("SELECT use_name FROM data_rec WHERE use_name = '$user_name'");
            $stmt2->execute();
            $data = $stmt2->fetch(PDO::FETCH_ASSOC);
            $_SESSION['datarec_name'] = $data['use_name'];
            

            
            if ($user['Rank'] == 1) {
                header("Location: member_list.php");
            } else {
                header("Location: index.php");
            }
            exit();
        }
        else {
            $_SESSION['error'] = "Invalid username or password";
            header("Location: login.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Something went wrong, please try again.";
        header("Location: login.php");
        exit();
    }
}

    public function getUser($userId) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM Member WHERE MemberID = ?");
            $stmt->execute([$userId]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                return $user;
            } else {
                echo "User not found.";
                return null;
            }

        } catch(PDOException $e) {
            $_SESSION['error'] = "Something went wrong, please try again.";
            echo "Error: " . $e->getMessage();
            header("Location: user.php");
        }
    }

}
?>