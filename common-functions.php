<?php
function showSingleResultData($table, $columnLabelFields, $whereClause=''){
    global $connect;
    $columns = array_keys($columnLabelFields); // fetching all columns
    $sql="SELECT " . implode(",",$columns) . " FROM " . $table;
    if($whereClause != '') $sql.=" where " . $whereClause;
    $sql.=" limit 1";
    $result=mysqli_query($connect, $sql);

    if($result) {
        $row=mysqli_fetch_assoc($result); ?>

        <form method="POST">
            <?php
            foreach ($columnLabelFields as $db_column_name => $column_label ) { ?>
                <div class="form-group">
                    <label for="field"><?=$column_label?></label>
                    <input type="text" id="field" class="form-control" placeholder="Enter <?=$column_label?>" value="<?=$row[$db_column_name]?>">
                </div>
                <?php
            } ?>
            <input type="hidden" name="table" value="<?=$table?>"/>
            <input type="hidden" name="operation" value="save"/>
            <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </form>
        <?php
    }
}

function showMultipleResultsData($sql, $columns, $buttons="default"){

    if($buttons == "default"){ // check if the function is called with custom $buttons
        // using the default buttons otherwise
        $buttons=array(
            "update"=>array("color"=>"success","label"=>"Edit"),
            "delete"=>array("color"=>"danger","label"=>"Delete")
        );
    }

    global $connect;
    $result=mysqli_query($connect, $sql);

    if($result) {
        $_SESSION['previous_url'] = $_SERVER['REQUEST_URI']; ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <?php
                foreach($columns as $column){
                    echo "<th scope=\"col\">$column</th>";
                }
                $columnsLowercase = transformColumnsToLowercase($columns);
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            while($row=mysqli_fetch_assoc($result)) {
                extract($row);
                echo "<tr><th scope=\"row\">" . $id . "</th>";
                if($_SESSION['role'] == "admin"){
                    foreach($columnsLowercase as $column){
                        ?>
                        <td><?=$$column?></td>
                        <?php
                    }
                } else {
                    foreach($columnsLowercase as $column){
                        echo "<td>" . $$column . "</td>";
                    }
                }

                if($buttons!=null){
                ?>

                <td>
                    <p style = "line-height:1.4">
                        <?php
                            foreach($buttons as $button_command=>$button_attributes){
                                    echo '<button command-attr="'. $button_command .'" style="margin-right:10px;" id="'. $id .'" class="btn btn-'. $button_attributes['color'] .'"><a href="/College/update_handler.php?command='. $button_command .'&id=' . $id . '" class="text-light">' . $button_attributes['label'] . '</a></button>';
                            }
                        ?>
                    </p>
                </td>
                    <?php
                } ?>
                </tr>
                <?php
            } ?>
            </tbody>
        </table>
        <?php
    }
}

function transformColumnsToLowercase($columns){
    $resultLowercaseColumns = array_map('strtolower', $columns);
    return $resultLowercaseColumns;
}
?>
