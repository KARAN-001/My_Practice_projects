<?php
include "config/db.php";
dbcon();

$display_block = "<h1>My Categories</h1>
<p>Select category </p>";

$get_cat_sql = "SELECT id,cat_title,cat_desc FROM store_categories
               ORDER BY cat_title";

$get_cat_res = mysqli_query($con, $get_cat_sql)
    or die(mysqli_error($con));
if (mysqli_num_rows($get_cat_res) < 1) {
    $display_block = "<p><em>SORRY,No Category to browse</em></p>";
} else {
    while ($cats = mysqli_fetch_array($get_cat_res)) {
        $cat_id = $cats['id'];
        $cat_title = strtoupper(stripslashes($cats['cat_title']));
        $cat_desc = stripslashes($cats['cat_desc']);

        $display_block .= "<p><strong><a href=\"" . $_SERVER['PHP_SELF'] . "?cat_id=" . $cat_id . "\">" . $cat_title . "</a></strong><br/>" . $cat_desc . "</p>";

        if (isset($_GET['cat_id']) && ($_GET['cat_id'] == $cat_id)) {
            $safe_cat_id = mysqli_real_escape_string($con, $_GET['cat_id']);

            $get_items_sql = "SELECT id,item_title,item_price FROM store_items
         WHERE cat_id='" . $cat_id . "' ORDER BY item_title";

            $get_items_res = mysqli_query($con, $get_items_sql) or die(mysqli_error($con));

            if (mysqli_num_rows($get_items_res) < 1) {
                $display_block = "<p><em>Sorry, No items in this category</em></p>";
            } else {
                $display_block .= "<ul>";
                while ($items = mysqli_fetch_array($get_items_res))
                 { 
                    $item_id = $items['id'];
                    $item_title = stripslashes($items['item_title']);
                    $item_price = $items['item_price'];

                    $display_block .= "<li><a href=showitem.php?item_id=" .
                        $item_id . "\">" . $item_title . "</a>
                     (\$" . $item_price . ")</li>";
                }

                $display_block .= "</ul>";
            }
            //free results
            mysqli_free_result($get_items_res);
        }
    }
}

//free results
mysqli_free_result($get_cat_res);
//close connection to MySQL
mysqli_close($con);
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Categories</title>
</head>

<body>
    <?php echo $display_block; ?>
</body>

</html>