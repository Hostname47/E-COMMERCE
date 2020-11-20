<div class="left-side-panel">
    <?php
        /* $categories = exec("config/background.sh");

        echo $categories; */
    ?>

    <!-- Left pannel: Categories section -->
    <?php 
        /* Rather than using includes inside the api file and getting relative-absolute path problem, 
        I prefer to include files here instead and avoid the problem (temporarly at least)
        */
        include_once "config/DB.php";
        include_once "modules/category.php";
        echo "<div>";
        echo "<p class='left-pannel-section-title'>Department</p>";
        echo "<div class='departments-container'>";
        $result = include "api/category/read.php";
        $result = json_decode($result);

        foreach($result->data as $dt) {
            echo "<a href='shop.php?category=$dt->name' class='container-item-link'>" . $dt->name . "</a>";
        }
        echo "</div>";
        echo "</div>";
    ?>

    <!-- Left pannel: Rating avg. filtering section -->
    <div>
        <p class="left-pannel-section-title">Avg. Customer Review</p>
        <div class="rating-options-container">
            <a href="#" class="rating-item" id="rating-4-and-up">& up</a>
            <a href="#" class="rating-item" id="rating-3-and-up">& up</a>
            <a href="#" class="rating-item" id="rating-2-and-up">& up</a>
            <a href="#" class="rating-item" id="rating-1-and-up">& up</a>
        </div>
    </div>

    <!-- Left pannel: Price limit and range section -->
    <div>
    <p class="left-pannel-section-title">Price</p>
        <div class="price-container">
            <a href="#" class="container-item-link">Under 25$</a>
            <a href="#" class="container-item-link">25$ to 50$</a>
            <a href="#" class="container-item-link">50$ to 100$</a>
            <a href="#" class="container-item-link">100$ to 200$</a>
            <div class="price-range">
                <form action="" method="POST" class="min-max-form">
                    <input type="text" name="min" class="min" placeholder="min">
                    <input type="text" name="man" class="max" placeholder="max">
                    <input type="submit" value="Go" class="min-max-go" name="mi-max-go">
                </form>
            </div>
        </div>
    </div>

    <!-- Availability -->
    <div>
        <p class="left-pannel-section-title">Avg. Customer Review</p>
        <form action="" method="POST" id="availability-form">
            <input type="checkbox" value="availablity" name="availablity" id="availablity"> <label for="availablity">Include out of stock</label>
        </form>
    </div>

</div>