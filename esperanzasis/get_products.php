<?php
    include "./config/conexion.php";
    
    $idClient = $_GET['id'];

    $query_show_products = mysqli_query($conexion, "SELECT * FROM assign_product INNER JOIN products ON assign_product.product_id = products.id 
    INNER JOIN clients ON clients.id = assign_product.client_id WHERE assign_product.client_id = '$idClient' AND products.status_deleted = 0 AND assign_product.status_deleted = 0");
    $result_products = '';

    ?>
    
    <?php 
        $result_products .= '<tr>';
            $result_products .= '<th>Cliente</th>';
            $result_products .= '<th>Producto</th>';
            $result_products .= '<th>Precio</th>';
            $result_products .= '<th>Tipo de unidad</th>';
            $result_products .= '<th>Cantidad</th>';
        $result_products .= '</tr>';

        while($row = mysqli_fetch_array($query_show_products)){
            $result_products .= '<tr>';
                $result_products .= '<td style="display:none;"><input type="hidden" name="product_id[]" value="' . $row['product_id'] . '" class="form-control"></td>';
                $result_products .= '<td>' . $row['name_client'] . '</td>';
                $result_products .= '<td>' . $row['name_product'] . '</td>';
                $result_products .= '<td><input type="text" name="price[]" readOnly value="' . number_format($row['price'], 2) . '" class="form-control"></td>';
                $result_products .= '<td><input type="text" name="unidad[]" readOnly value="' . $row['unidad'] . '" class="form-control"></td>';
                $result_products .= '<td><input type="text" name="quantity[]" value="0" class="form-control"></td>';
            $result_products .= '</tr>';
        }
    ?>

        <input type="hidden" name="id_client" value="<?php echo $idClient; ?>">
        <?php echo $result_products; ?>

            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                <label>Fecha de entrega: </label>
                <input type="date" name="date_send" class="form-control" required>
            </div>

            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                <label>Estatus de pago: </label>
                <select name="status_payment" class="form-control" required>
                    <option selected disabled>Estatus de pago</option>
                    <option value="credito">Crédito</option>
                    <option value="contado">Contado</option>
                </select>
            </div>
        
        <input type="submit" value="Guardar pedido" class="btn btn-dark mt-5" name="save">