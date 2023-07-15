<?php
$current_page = $_SERVER['SCRIPT_NAME'];
$lastSlash = strrpos($current_page, "/");
$current_page = substr($current_page, $lastSlash, strlen($current_page) - $lastSlash);

if (str_contains($current_page, "manage_in_vehicle")) {
    $current_page = $_GET['type'] ?? "in";
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <div class="container-fluid d-flex flex-column">
        <?php
        include "config.php";
        $sql = "SELECT * FROM settings where meta_key='site_name' order by site_id desc  limit 1";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {


        ?>
                <a class="navbar-brand" href="#"><?php echo $row['meta_value'] ?></a>
        <?php  }
        } ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class=" mt-5 collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav d-flex flex-column">
                <li class="nav-item ">
                    <a class="nav-link <?php echo str_contains($current_page, "index") ? "active" : ""; ?>" aria-current="page" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link <?php echo str_contains($current_page, "vehical") ? "active" : ""; ?>" aria-current="page" href="vehical.php">vehicals</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link <?php echo str_contains($current_page, "category") ? "active" : ""; ?>" href="category.php">category</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link <?php echo str_contains($current_page, "parking") ? "active" : ""; ?>" href="parking.php">parking</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link <?php echo ($current_page == "in") ? "active" : ""; ?>" href="manage_in_vehicle.php?type=in">Manage in vehical</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link <?php echo ($current_page == "out") ? "active" : ""; ?>" href="manage_in_vehicle.php?type=out">Manage out vehical</a>
                </li>




                <li class="nav-item ">
                    <a class="nav-link <?php echo str_contains($current_page, "setting") ? "active" : ""; ?>" href="setting.php">Settings</a>
                </li>





            </ul>
        </div>
    </div>
</nav>