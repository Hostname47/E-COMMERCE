<div class="left-side-panel">
    <?php
        /* $categories = exec("config/background.sh");

        echo $categories; */
    ?>

    <!-- Left pannel: Categories section -->
    <div>
        <p class="left-pannel-section-title">Department</p>
        <div class="departments-container">
            <a href="#" class="container-item-link">Video games</a>
            <a href="#" class="container-item-link">TV & Shows</a>
            <div class="sub-container-item-links">
                <a href="#" class="container-item-link">TV shows</a>
                <a href="#" class="container-item-link">TV</a>
                <a href="#" class="container-item-link">Movies & films</a>
            </div>
            <a href="#" class="container-item-link">Replacement Upright Vacuum Bags</a>
        </div>
    </div>

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