<?php

session_start();

require "layouts/main.php";

?>



<h4 class="text-center mt-3">setttings</h4>

<a class=" ms-5 btn btn-dark" href="meta_setting.php" role="button">Add a new settting</a>
<form action="save_settings.php" method="POST" enctype="multipart/form-data" class="col  g-5 mt-3 ms-5 mb-5 me-5 border p-3">

    <?php
    if (isset($_SESSION['msgs'])) {
        foreach ($_SESSION['msgs'] as $key => $msg) {

    ?>
            <div style="text-transform: capitalize;" class="alert alert-<?php echo $msg['code'] ?>">
                <?php echo $msg['msg']; ?>
            </div>
    <?php
        }
    }
    unset($_SESSION['msgs']);
    ?>



    <?php
    include "config.php";
    $sql = "SELECT * FROM settings";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($settings = mysqli_fetch_assoc($result)) {

            $sql_meta = "Select * from meta_settings where setting_id={$settings['site_id']}";
            $foundInMeta = false;
            if ($res = mysqli_query($conn, $sql_meta)) {

                if (mysqli_num_rows($res) > 0) {
                    $foundInMeta = true;
                    $sett_meta = [];
                    while ($smeta = mysqli_fetch_assoc($res)) {
                        $sett_meta[$smeta['meta_key']] = $smeta['meta_value'];
                    }
                } else {
                    // continue;
                    $foundInMeta = false;
                    $sett_meta['type'] = "text";
                }
            } else {
                continue;
            }


            switch ($sett_meta['type']) {
                case "text":
                    getTextField($sett_meta, $settings);
                    break;
                case "select":
                    getSelectField($sett_meta, $settings);
                    break;
                    case "radio":
                        getRadioCheckboxField($sett_meta, $settings);
                        
                        break;

                default:
                getTextField($sett_meta, $settings);
                    // case "radio":

            }
        }

    ?>
        <div class=" mt-2 col-12">
            <button type="submit" name="change" class="btn btn-primary">change</button>
        </div>
</form>

<?php
    }


    function getTextField($sett_meta, $settings)
    {
?>
    <div class="col-6">
        <label for="text" class="form-label"><?php echo  $settings['meta_key'] ?></label>
        <input name="<?php echo str_replace(" ", "_", $settings['meta_key']); ?>" type="<?php echo $sett_meta['type'] ?>" class="form-control" id="text" value="<?php echo $settings['meta_value'] ?>">
    </div>


<?php
    }


    function getSelectField($sett_meta, $settings)
    {
?>
    <div class="col-6">
        <label for="text" class="form-label"><?php echo  $settings['meta_key'] ?></label><br>
        <select name="<?php echo str_replace(" ", "_", $settings['meta_key']); ?>" class="form-control">
            <?php
            $options = isset($sett_meta['options']) ? $sett_meta['options'] : "";
            $options = explode(",", $options);

            foreach ($options as $opt) {
                $name= str_replace(" ", "_", $opt);
            ?>
                <option <?php echo $name==$settings['meta_value'] ? "selected":"";  ?> value="<?php echo $name;  ?>"><?php echo $opt; ?> </option>

            <?php
            }

            ?>
        </select>
    </div>


<?php
    }


    function getRadioCheckboxField($sett_meta, $settings){
        ?>
    <div class="col-6">
        <label for="text" class="form-label"><?php echo  $settings['meta_key'] ?></label><br>
          <?php
            $options = isset($sett_meta['options']) ? $sett_meta['options'] : "";
            $options = explode(",", $options);

            foreach ($options as $opt) {
                $name= str_replace(" ", "_", $opt);
            ?>
                <input name="<?php echo str_replace(" ", "_", $settings['meta_key']); ?>" type="<?php echo $sett_meta['type']; ?>" <?php echo $name==$settings['meta_value'] ? "checked":"";  ?> value="<?php echo $name;  ?>"><?php echo $opt; ?> </option>
<br>
            <?php
            }
            
            ?>
    </div>

<?php
    }
?>


<!-- <div class="col-6">
                <label for="inputimg" class="form-label">site_logo</label>
                <input name="site_logo" type="file" class="form-control" id="inputimg" placeholder="" value="">
                <img class="mt-2" width="120" src="layouts/logo/<?php echo $setting_data['site_logo'] ?>" alt="">
            </div> -->