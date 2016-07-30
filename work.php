<?php
    $title = "Absolute Agency | Our Work";
    include_once "header.php";

    function linkify($title){
        $lower = strtolower($title);
        return str_replace(" ", "-", $lower) . ".php";
    }    
?>

<div class="work-container">
   <?php 

        $sql = "SELECT * FROM portfoliolist";
        $result = mysqli_query($dbconnect, $sql);

		while($row = mysqli_fetch_array($result)){
                    
            echo "<div class='portfolio-image-container'>";
			echo "<a title=\"" . $row["portfolioTitle"] . "\" href=\"casestudy.php?id=" . $row["ID"] . "\">";
            echo "<img src='" .  $row["coverImage"] . "'/>";
            echo "<div class='portfolio-text-container'>";
            echo "<h4 class='portfolio-text-label'>" . $row["portfolioTitle"] . "</h4></a>";
            echo "</div></div>";
        }
    ?> 
    </div>


<?php include_once "footer.php"; ?>