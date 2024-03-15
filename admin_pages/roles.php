<?php


require "app/connection.php";

$response = $connection->query("SELECT * FROM admins ORDER BY admin_id DESC");
$data = $response->fetch_all(MYSQLI_ASSOC);

$current_admin_password = $_SESSION["password"];
// var_dump($current_admin_password === $data[0]["admin_pwd"]);

$admins2output = [];

for ($i = 0; $i < count($data); $i++) {
    if ($data[$i]["admin_pwd"] !== $current_admin_password) {
        array_push($admins2output, $data[$i]);
    }
}


$password_rows = "";

if (!empty($admins2output)) {
    for ($i = 0; $i < count($admins2output); $i++) {
        $password_rows .= 
                '
                <div class="passwords_container_row">
                    <div class="password_container_item">
                        '.$admins2output[$i]["admin_name"].'
                    </div>
                    <div class="password_container_item">
                        '.$admins2output[$i]["role"].'
                    </div>
                    <div class="password_container_item passwords2copy">
                        '.$admins2output[$i]["admin_pwd"].'
                    </div>
                    <div class="password_container_item">
                        <button class="control_button copy_button copy_btn">
                            <svg class="control_button_image" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                                <path d="M360-240q-33 0-56.5-23.5T280-320v-480q0-33 23.5-56.5T360-880h360q33 0 56.5 23.5T800-800v480q0 33-23.5 56.5T720-240H360Zm0-80h360v-480H360v480ZM200-80q-33 0-56.5-23.5T120-160v-560h80v560h440v80H200Zm160-240v-480 480Z"/>
                            </svg>
                        </button>
                        <button class="control_button delete_button delete_btn" data-href="app/delete.php?admin='.$admins2output[$i]["admin_id"].'" title="Zugangscode löschen" data-object="Zuganscode von '.$admins2output[$i]["admin_name"].'">
                            <svg class="control_button_image" xmlns="http://www.w3.org/2000/svg"viewBox="0 -960 960 960">
                                <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                ';
    }
} else {
    $password_rows = '<div class="np_container">Es gibt keine Zuganscode</div>';
}


echo 
    '<div class="roles_admin_container">
        <form method="post" action="app/create_admin.php" class="cp_container">
            <div class="cp_inputs_container">
                <input class="cp_input cp_input_left" type="text" name="name" placeholder="name">
                <input class="cp_input cp_input_right" type="text" name="password" placeholder="zugangscode">
            </div>
            <div class="cp_controls_container">
                <select name="role" class="cp_dropdown_list">
                    <option value="admin">Admin</option>
                    <option value="superadmin">Superadmin</option>
                </select>
                <input class="cp_submit_button" type="submit" value="Zugangscode erstellen">
            </div>
        </form>
        <div class="passwords_container">
            <div class="passwords_table_head">
                <div class="passwords_table_head_item">
                    Name
                </div>
                <div class="passwords_table_head_item">
                    Role
                </div>
                <div class="passwords_table_head_item">
                    Zugangscode
                </div>
                <div class="passwords_table_head_item">
                    Kopieren/Löschen
                </div>
            </div>
            '.$password_rows.'
        </div>
    </div>';