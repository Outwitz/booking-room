<?php
    // เชื่อมต่อดาต้าเบส
    include('config/db.php');

    // Check if booking ID is passed as a parameter in the URL
    if (isset($_GET['booking_id'])) {
        $booking_id = $_GET['booking_id'];

        // SQL อัพเดทสถานะในฐานข้อมูล เป็น ยกเลิก
        $sql_update = "UPDATE data_rec SET bookingsts = 'ยกเลิก' WHERE test_id = $booking_id";

        if ($connect->query($sql_update) === TRUE) {
            // ยกเลิกการจองสำเร็จ
            echo "<script>alert('การยกเลิกการจองสำเร็จ');</script>";
            echo "<script>window.location.href = 'booking_list.php';</script>"; // กลับไปหน้าเดิม
            exit();
        } else {
            // ถ้าเกิดข้อผิดพลาด
            echo "<script>alert('เกิดข้อผิดพลาดในการยกเลิกการจอง: " . $connect->error . "');</script>";
            echo "<script>window.location.href = 'booking_list.php';</script>"; // กลับไปหน้าเดิม
            exit();
        }
    } else {
        // Handle case where booking ID parameter is not provided
        echo "<script>alert('ไม่พบรหัสการจอง');</script>";
        echo "<script>window.location.href = 'booking_list.php';</script>"; // กลับไปหน้าเดิม
        exit();
    }

    $connect->close();
?>