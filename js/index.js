function getGrados(a,o,s){$("#grados").load("index_ajax.php",{xAccion:"getGrados",cveRito:a,cveClasificacion:o,nombreClasificacion:s},function(){$("#novedades").css("display","none"),$("#grados").css("display","block"),$("#productos").css("display","block")})}function getProductos(a,o,s,i,c){$("#productos").load("index_ajax.php",{xAccion:"getProductos",cveRito:a,cveClasificacion:o,cveGrado:s,cveClasProducto:i,nombreClasProducto:c},function(){$("body").on("hidden.bs.modal",".modal",function(){$(this).removeData("bs.modal")})})}function addToShoppingCart(a){$("#ajax_msg").load("php/agregacar.php",{xCveProducto:a},function(a){"NO_SESSION"===a?($("#ajax_msg").html('Debe iniciar sesión para poder agregar productos al carrito de compras.&nbsp;<a href="php/login_cliente.php" target="_self">Iniciar sesión</a>'),$("#ajax_msg").removeClass("alert-success"),$("#ajax_msg").addClass("alert-warning")):($("#ajax_msg").removeClass("alert-warning"),$("#ajax_msg").addClass("alert-success")),$("#ajax_msg").fadeIn()})}function logout(){$("#xAccion").val("logout"),$("#frmLogOut").submit()}function finalizarPedido(){$("#xAccionPedido").val("finalizarPedido"),$("#frmFinalizarPedido").submit()}