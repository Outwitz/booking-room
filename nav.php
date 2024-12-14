<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">ระบบจองห้องประชุม</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
            
            <?php if (isset($_SESSION['userId'])) : ?>
              <li class="nav-item dropdown">
          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            เมนู
          </button>
          <?php if ($_SESSION['userRank'] != 0) : ?>
            <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="admin_app.php">รายการจอง</a></li>
            <li><a class="dropdown-item" href="member_list.php">ข้อมูลผู้ใช้งาน</a></li>
            <li><a class="dropdown-item" href="room_list.php">ข้อมูลห้องประชุม</a></li>
            </ul>
          <?php else: ?>
            <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="table.php">จองห้องประชุม</a></li>
            <li><a class="dropdown-item" href="booking_list.php">รายการจองของฉัน</a></li>
            </ul>
          <?php endif; ?>
        </li>
        <?php endif; ?>

        </ul>
        <div> class="d-flex">
            <?php if (isset($_SESSION['userId'])) : ?>
            <a href="edit_profile.php" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16">
  <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
</svg> แก้ไขข้อมูลส่วนตัว</a>
            <a href="logout.php" class="btn btn-danger me-2"><i class="bi bi-box-arrow-in-right"></i> ออกจากระบบ</a>
            <?php else: ?>
            <a href="login.php" class="btn btn-primary me-2"><i class="bi bi-box-arrow-in-right"></i> เข้าสู่ระบบ</a>
            <a href="register.php" class="btn btn-primary"><i class="bi bi-person-plus"></i> สมัครสมาชิก</a>
            <?php endif; ?>
        </div>
        </div>
    </div>
</nav>
