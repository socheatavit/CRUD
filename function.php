<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php

try {
    $connection = new mysqli('localhost', 'root', '', 'db_product',3308);
    // $connection = new mysqli('sql207.infinityfree.com', 'if0_38913131', 'socheatavit', 'if0_38913131_db_product',3306);
} catch (\Throwable $th) {
    //throw $th;
}
function insertData()
{
    global $connection;
    if (isset($_POST['btnSave'])) {
        $name = $_POST['name'];
        $qty = $_POST['qty'];
        $price = $_POST['price'];
        $thumbnail = rand(1, 100000) . '-' . $_FILES['thumbnail']['name'];
        move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'image/' . $thumbnail);
        if (!empty($name) && !empty($qty) && !empty($price) && !empty($thumbnail)) {
            try {
                $sql = "INSERT INTO `tbl_infoproduct`(`name`, `qty`, `price`, `thumbnail`)
                    VALUES ('$name','$qty','$price','$thumbnail')";
                $row = $connection->query($sql);
            } catch (\Throwable $th) {
                //throw $th;
            }
            // if ($row) {
            //     echo '
            //     <script>
            //         $(document).ready(function(){
            //             swal({
            //                 title: "Good job!",
            //                 text: "You clicked the button!",
            //                 icon: "success",
            //                 button: "Aww yiss!",
            //             });
            //         })
            //     </script>
            //     ';
            // }
        } else {
            echo 00;
        }
    }
}
insertData();
function readData()
{
    global $connection;
    try {
        $sql = "SELECT * FROM `tbl_infoproduct` ORDER BY id DESC";
        $row = $connection->query($sql);
        while ($data = mysqli_fetch_assoc($row)) {
            echo '
            <tr>
                <td>' . $data['id'] . '</td>
                <td>' . $data['name'] . '</td>
                <td>' . $data['qty'] . '</td>
                <td>' . $data['price'] . '</td>
                <td>
                    <img src="image/' . $data['thumbnail'] . '" width="100" alt="' . $data['thumbnail'] . '">
                </td>
                <td>
                    <button id="openUpdate" class="btn btn-warning mx-2" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Update</button>
                    <button id="openDelete" type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#exampleModalDelete">Delete</button>
                </td>
            </tr>
            ';
        }
    } catch (\Throwable $th) {
        //throw $th;
    }
}

function deleteData()
{
    global $connection;
    if (isset($_POST['btnDelete'])) {
        $id = $_POST['tmp_id'];
        try {
            $sql = "DELETE FROM `tbl_infoproduct` WHERE id = '$id'";
            $result = $connection->query($sql);
            if ($result) {
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Good job!",
                            text: "You clicked the button!",
                            icon: "success",
                            button: "Aww yiss!",
                        });
                    })
                </script>
                ';
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
deleteData();
function updateData()
{
    global $connection;
    if (isset($_POST['btnUpdate'])) {
        $id = $_POST['hide_id'];
        $name = $_POST['name'];
        $qty = $_POST['qty'];
        $price = $_POST['price'];
        $thumbnail = $_FILES['thumbnail']['name'];
        if (!empty($thumbnail)) {
            $thumbnail = rand(1, 100000) . '-' . $thumbnail;
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'image/' . $thumbnail);
        } else {
            $thumbnail = $_POST['hide_thumbnail'];
        }
        if (!empty($name) && !empty($qty) && !empty($price) && !empty($thumbnail)) {
            try {
                $sql = "UPDATE `tbl_infoproduct` SET `name`='$name',`qty`='$qty',`price`='$price',`thumbnail`='$thumbnail' WHERE `id`='$id'";
                $row = $connection->query($sql);
            } catch (\Throwable $th) {
                //throw $th;
            }
            if ($row) {
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Good job!",
                            text: "You clicked the button!",
                            icon: "success",
                            button: "Aww yiss!",
                        });
                    })
                </script>
                ';
            }
        } else {
            echo 00;
        }

    }
}
updateData();