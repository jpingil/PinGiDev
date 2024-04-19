<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController {

    static function main() {
    session_start();                
                                
    if (!isset($_SESSION['usuario'])) {
        Route::add('/AboutMe',
            function () {
                $controlador = new \Com\Daw2\Controllers\AboutMeController();
                $controlador->seeView();
            }
            , 'get');

        Route::pathNotFound(
            function () {
                header('location: /AboutMe');
            }
        );    
            
        }
    else{
        //Rutas que están disponibles para todos
        Route::add('/',
                function () {
                    $controlador = new \Com\Daw2\Controllers\InicioController();
                    $controlador->index();
                }
                , 'get');
        
         Route::add('/logout',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                    $controlador->logout();
                }
                , 'get');

        Route::add('/demos/login',
            function () {
                $controlador = new \Com\Daw2\Controllers\InicioController();
                $controlador->demoLogin();
            }
            , 'get');
            
        Route::add('/demos/usuarios-sistema',
            function () {
                $controlador = new \Com\Daw2\Controllers\InicioController();
                $controlador->demoUsuariosSistema();
            }
            , 'get');
            
        Route::add('/demos/usuarios-sistema/add',
            function () {
                $controlador = new \Com\Daw2\Controllers\InicioController();
                $controlador->demoUsuariosSistemaAdd();
            }
            , 'get');                               
            
                                       
        if(strpos($_SESSION['permisos']['usuarios_sistema'], 'r') !== false){                
            #Gestión de usuarios del sistema:
            Route::add('/usuarios-sistema',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                        $controlador->mostrarTodos();
                    }
                    , 'get');
            
        }
        
        if(strpos($_SESSION['permisos']['usuarios_sistema'], 'd') !== false){                
            Route::add('/usuarios-sistema/delete/([0-9]+)',
                    function ($id) {
                        $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                        $controlador->delete($id);
                    }
                    , 'get');

            Route::add('/usuarios-sistema/baja/([0-9]+)',
                    function ($id) {
                        $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                        $controlador->baja($id);
                    }
                    , 'get');
        }

        if(strpos($_SESSION['permisos']['usuarios_sistema'], 'w') !== false){                
                Route::add('/usuarios-sistema/edit/([0-9]+)',
                        function ($id) {
                            $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                            $controlador->mostrarEdit($id);
                        }
                        , 'get');

                Route::add('/usuarios-sistema/edit/([0-9]+)',
                        function ($id) {
                            $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                            $controlador->edit($id);
                        }
                        , 'post');        

                Route::add('/usuarios-sistema/add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                            $controlador->mostrarAdd();
                        }
                        , 'get');

                Route::add('/usuarios-sistema/add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\UsuarioSistemaController();
                            $controlador->add();
                        }
                        , 'post');
                
            }
    
                                        
            # Gestion de categorías
            if(strpos($_SESSION['permisos']['categorias'], 'r') !== false){
                Route::add('/categorias',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\CategoriaController();
                            $controlador->mostrarTodos();
                        }
                        , 'get');

                Route::add('/categorias/view/([A-Za-z0-9]+)',
                        function ($id) {
                            $controlador = new \Com\Daw2\Controllers\CategoriaController();
                            $controlador->view($id);
                        }
                        , 'get');
            }
            if(strpos($_SESSION['permisos']['categorias'], 'd') !== false){
                Route::add('/categorias/delete/([A-Za-z0-9]+)',
                    function ($id) {
                        $controlador = new \Com\Daw2\Controllers\CategoriaController();
                        $controlador->delete($id);
                    }
                , 'get');
            }
            
            if(strpos($_SESSION['permisos']['categorias'], 'w') !== false){
                Route::add('/categorias/edit/([A-Za-z0-9]+)',
                        function ($id) {
                            $controlador = new \Com\Daw2\Controllers\CategoriaController();
                            $controlador->mostrarEdit($id);
                        }
                        , 'get');

                Route::add('/categorias/edit/([A-Za-z0-9]+)',
                        function ($id) {
                            $controlador = new \Com\Daw2\Controllers\CategoriaController();
                            $controlador->edit($id);
                        }
                        , 'post');

                Route::add('/categorias/add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\CategoriaController();
                            $controlador->mostrarAdd();
                        }
                        , 'get');

                Route::add('/categorias/add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\CategoriaController();
                            $controlador->add();
                        }
                        , 'post');

                Route::add('/categorias/cant_add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\CategoriaController();
                            $controlador->cant_add();
                        }
                        , 'get');
            
            }
            


                # Gestion de productos

            if(strpos($_SESSION['permisos']['productos'], 'r') !== false){
                Route::add('/productos',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\ProductoController();
                            $controlador->mostrarTodos();
                        }
                        , 'get');
                Route::add('/productos/view/([A-Za-z0-9]+)',
                        function ($codigo) {
                            $controlador = new \Com\Daw2\Controllers\ProductoController();
                            $controlador->view($codigo);
                        }
                        , 'get');
            }
            if(strpos($_SESSION['permisos']['productos'], 'd') !== false){

                Route::add('/productos/delete/([A-Za-z0-9]+)',
                        function ($codigo) {
                            $controlador = new \Com\Daw2\Controllers\ProductoController();
                            $controlador->delete($codigo);
                        }
                        , 'get');
            }
            if(strpos($_SESSION['permisos']['productos'], 'w') !== false){

                Route::add('/productos/edit/([A-Za-z0-9]+)',
                        function ($codigo) {
                            $controlador = new \Com\Daw2\Controllers\ProductoController();
                            $controlador->mostrarEdit($codigo);
                        }
                        , 'get');

                Route::add('/productos/edit',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\ProductoController();
                            $controlador->processEdit();
                        }
                        , 'post');

                Route::add('/productos/add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\ProductoController();
                            $controlador->mostrarAdd();
                        }
                        , 'get');

                Route::add('/productos/add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\ProductoController();
                            $controlador->processAdd();
                        }
                        , 'post');
                                     
            }

                # Gestion de proveedores

            if(strpos($_SESSION['permisos']['proveedores'], 'r') !== false){
                Route::add('/proveedores',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\ProveedorController();
                            $controlador->mostrarTodos();
                        }
                        , 'get');

                Route::add('/proveedores/view/([A-Za-z0-9]+)',
                        function ($cif) {
                            $controlador = new \Com\Daw2\Controllers\ProveedorController();
                            $controlador->view($cif);
                        }
                        , 'get');
            }
            
            if(strpos($_SESSION['permisos']['proveedores'], 'd') !== false){
                Route::add('/proveedores/delete/([A-Za-z0-9]+)',
                        function ($cif) {
                            $controlador = new \Com\Daw2\Controllers\ProveedorController();
                            $controlador->delete($cif);
                        }
                        , 'get');
            }
            
            if(strpos($_SESSION['permisos']['proveedores'], 'w') !== false){

                Route::add('/proveedores/edit/([A-Za-z0-9]+)',
                        function ($cif) {
                            $controlador = new \Com\Daw2\Controllers\ProveedorController();
                            $controlador->mostrarEdit($cif);
                        }
                        , 'get');

                Route::add('/proveedores/edit/([A-Za-z0-9]+)',
                        function ($cif) {
                            $controlador = new \Com\Daw2\Controllers\ProveedorController();
                            $controlador->edit($cif);
                        }
                        , 'post');

                Route::add('/proveedores/add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\ProveedorController();
                            $controlador->mostrarAdd();
                        }
                        , 'get');

                Route::add('/proveedores/add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\ProveedorController();
                            $controlador->add();
                        }
                        , 'post');

                Route::add('/proveedores/cant_add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\ProveedorController();
                            $controlador->cant_add();
                        }
                        , 'get');
            }
            
            Route::pathNotFound(
                function () {
                    $controller = new \Com\Daw2\Controllers\ErroresController();
                    $controller->error404();
                }
            );

            Route::methodNotAllowed(
                    function () {
                        $controller = new \Com\Daw2\Controllers\ErroresController();
                        $controller->error405();
                    }
            );
        }
                        
        

        Route::run();
    }

}
