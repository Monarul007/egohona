<?php 
/*******Multi Level Category******* */
function connect(){
    $connection = mysqli_connect('localhost','root','','egohona');
    if(!$connection){
      die('Failed to connect to the database');
    }
    return $connection;
}
function display_categories(){
    $connection  = connect();
    
    $categories = "";
    $categories .= multilevel_category($connection);

    return "<ul class='category-menu'>".$categories."</ul>";
}

function multilevel_category($connection, $parent_id=0){
    
    $category = "";

    if($parent_id=0){
        $sql = "SELECT * FROM categories WHERE parent_id = '0'";
    }else{
        $sql = "SELECT * FROM categories WHERE parent_id = $parent_id";
    }
    $result = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            if($row["parent_id"]){
                $category .= "<li><a href='category.php?cat_id=".$row['id']."'>".$row['cat_name']."</a>";
            }else{
                $category .= "<li><a href='category.php?cat_id=".$row['id']."' class='active'>".$row['cat_name']."</a>";
            }
            
            
            $row_id = $row["id"];
            $sql_b = "SELECT * FROM categories WHERE parent_id = $row_id";
            $count = mysqli_query($connection, $sql_b);            
            if($count->num_rows > 0){
                $category .= "<ul>".multilevel_category($connection, $row["id"])."</ul>";
            }else{
                $category .= multilevel_category($connection, $row["id"]);
            }
            
            $category .= "</li>";
        }
    
    return $category;
}
?>