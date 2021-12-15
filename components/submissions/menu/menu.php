<div class="menu">
    <h4 class="menu__title">
        <b>Filters</b>
    </h4>
    <form action="" method="post">
        <div class="menu__container">
            <h6><b>Timestamp</b></h6>
            <label>
                Min Date
                <input type="date" name="min_date" value="<?php echo ($min_date_input ?? ""); ?>" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
            </label>
            <label>
                Max Date
                <input type="date" name="max_date" value="<?php echo ($max_date_input ?? ""); ?>" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
            </label>
        </div>
        <div class="menu__container">
            <h6><b>Campaign</b></h6>
            <select name="campaign">
                <option value="">All Campaigns</option>
                <?php
                foreach ($campaign_list as $form_id) {
                    $selected = (!empty($campaign) && strtolower($form_id) === $campaign) ? "selected" : "";
                    echo
                    '<option value="' . $form_id . '" '. $selected .'>' . $form_id . '</option>';
                } ?>
            </select>
        </div>
        <button type="submit" class="button button--blue" name="filter_submit">
            <b>Filter Submissions</b>
        </button>
        <div class="menu__container text-center">
            <a href="<?php echo home_url(); ?>/submissions">
                Clear Filters
            </a>
        </div>
    </form>
    <hr>
    <form method="post" action="">
        <button class="button button--blue" type="submit" name="export">
            <b>Export Current to CSV</b>
        </button>
    </form>
</div>