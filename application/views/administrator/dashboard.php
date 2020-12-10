<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&family=Arimo:wght@400;700&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="../assets/scss/style.css">
    <title>Backoffice - Tienda oficial de Enseco</title>
</head>
<body class="admin-body">
    <div class="admin-container">
        <aside class="admin-aside">
            <ul class="admin-list">
                <li class="admin-item">
                    <div class="item-content">
                        <img src="../assets/img/logo-transp.png" alt="">
                    </div>
                </li>
                <li class="admin-item sales is-active">
                    <div class="item-content">
                        <i class="fas fa-euro-sign"></i>
                        <p>Pedidos</p>
                    </div>
                </li>
                <li class="admin-item products">
                    <div class="item-content">
                        <i class="fas fa-box-open"></i>
                        <p>Productos</p>
                    </div>
                </li>
                <li class="admin-item claims">
                    <div class="item-content">
                        <i class="fas fa-paste"></i>
                        <p>Reclamaciones</p>
                    </div>
                </li>
                <li class="admin-item users">
                    <div class="item-content">
                        <i class="fas fa-users"></i>
                        <p>Usuarios</p>
                    </div>
                </li>
                <li class="admin-item dashboard">
                    <div class="item-content">
                        <i class="fas fa-chart-line"></i>
                        <p>Estadísticas</p>
                    </div>
                </li>
            </ul>
        </aside>
        <div class="center-container">
            <div class="admin-header">
                <h1>Estas en la zona de administración</h1>
                <p>Bienvenido, <?php echo ($_SESSION['nombre']); ?> <?php echo ($_SESSION['apellido']); ?></p>
                <form action="../controllers/validate.php" class="logout" type="post">
                    <input type="submit" value="Desconectarse" name="btn-logout" class="submit-button btn-original">
                </form>
            </div>
            <div id="btnActions" class="sales">
                <button id="btnSalesPending" type="button" class="sales__item">Pedidos pendientes</button>                
                <button id="btnSalesDone" type="button" class="sales__item">Pedidos entregados</button>
                <button id="btnSalesAll" type="button" class="sales__item">Todos los pedidos</button>
                <button id="btnSalesLookfor" type="button" class="sales__item">Buscar pedido</button>                
                <button id="btnSalesModify" type="button" class="sales__item">Modificar pedido</button>
                <button id="btnSalesCancel" type="button" class="sales__item">Anular pedido</button>
            </div>
            <div class="content-sales" data-id="btnSalesPending"><?php recoverQueryInnerJoin($host, $user, $pass, $db_name, "venta", "pendiente", "=", "si"); ?></div>
            <div class="content-sales" data-id="btnSalesDone"><?php recoverQueryInnerJoin($host, $user, $pass, $db_name, "venta", "pendiente", "=", "no"); ?></div>
            <div class="content-sales" data-id="btnSalesAll"><?php recoverQuery($host, $user, $pass, $db_name, "venta"); ?></div>
            <div class="content-sales" data-id="btnSalesLookfor">
                <div class="search-item">
                    <label for="search-sale">Buscar por modelo de producto:</label>
                    <input type="text" id="saleSearch" name="search-sale" class="search" placeholder="Buscar por nombre">                
                </div>
                <div class="search-item">
                    <label for="search-date">Buscar por fecha de pedido:</label>
                    <input type="date" id="dateSearch" name="search-date" class="search">
                </div>
                <div class="search-item">
                    <label for="search-date-delivery">Buscar por fecha de entrega:</label>
                    <input type="date" id="dateSearchDelivery" name="search-date-delivery" class="search">
                </div>
                <div id="resultAjax"></div>
            </div>           
            <div class="content-sales" data-id="btnSalesModify"><?php recoverQueryCondition($host, $user, $pass, $db_name, "venta", "pendiente", "=", "no"); ?></div>

            <div class="content-product" data-id=""><?php recoverQuery($host, $user, $pass, $db_name, "producto"); ?></div>
            <div class="content-user" data-id=""><?php recoverQuery($host, $user, $pass, $db_name, "usuario"); ?></div>
        </div>
    </div>
    <footer class="footer">
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="../assets/js/jquery-3.5.1.min.js"><\/script>')</script>     
        <script src="../assets/js/admin-panels-views.js"></script>        
        <script src="../assets/js/ajax-request.js"></script>
    </footer>
</body>
</html>