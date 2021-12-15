<section class="results">
    <div class="results__menu">
        <?php include __DIR__."./../menu/menu.php"; ?>
    </div>
    <div class="results__main">
        <h2 class="headline h4">
            <b>Submissions</b>
        </h2>
        <table class="results__table">
            <thead>
                <tr>
                    <?php 
                    foreach ($table_columns as $column_id => $column) {
                        if (is_array($column)) {
                            echo 
                                '<th width="10%">' .
                                    $column_id .
                                '</th>';
                        } else {
                            echo 
                                '<th width="'. (!empty($table_info->columns[$column_id]) ? $table_info->columns[$column_id]->width : 10) .'%">' .
                                    $column .
                                '</th>';
                        }
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($results as $row) {

                    $row_data = submissions_create_row($row);
                    $row_cells = "";

                    foreach ($row_data as $column_id => $column) {
                        if (is_array($column)) {
                            $sub_row = "";
                            foreach ($column as $sub_id => $sub_column) {
                                $sub_row .= 
                                    '<tr>' .
                                        '<td>'. $sub_id .'</td>' .
                                        '<td>'. $sub_column .'</td>' .
                                    '</tr>';
                            }

                            $row_cells .= 
                                '<td>' .
                                    '<table>' .
                                        $sub_row .
                                    '</table>' .
                                '</td>';
                        } else {
                            $row_cells .= 
                                '<td>' .
                                    $column .
                                '</td>';
                        }
                    }

                    echo 
                        '<tr>' .
                            $row_cells .
                        '</tr>';
                } ?>
            </tbody>
        </table>
        <?php 
        include __DIR__."./../tools/tools.php";
        ?>
    </div>
</section>