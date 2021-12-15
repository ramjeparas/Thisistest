<?php
$page_query = $_SERVER["QUERY_STRING"];
parse_str($page_query, $page_query_list);
unset($page_query_list["pg"]);
$page_query = [];
foreach ($page_query_list as $key => $value) {
    $page_query[] = "$key=$value";
}

if (empty($page_query)) {
    $page_url = home_url() . "/submissions?pg=";
} else {
    $page_url = home_url() . "/submissions?" . implode("&", $page_query) . "&pg=";
}
?>
<div class="pagination">
    <select data-pagination>
        <?php for ($x = 1; $x <= $total_pages; $x++) {
            $selected = ($x == $page) ? 'selected' : '';
            echo "<option $selected value='{$page_url}{$x}'>Page {$x} of {$total_pages}</option>";
        } ?>
    </select>
</div>
