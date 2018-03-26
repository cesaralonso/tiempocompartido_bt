<!doctype html>
<html class="no-js" lang="">
    <head>
        <?php include("includes/top.php"); ?>
        <?php include("includes/conexion.php"); ?>
        <?php include("includes/idiomas.php"); ?>
        <?php include("includes/labels.php"); ?>
        <?php include("includes/publicidad.php"); ?>
        <?php include("includes/metas.php"); ?>
        <?php include("includes/header.php"); ?>
        <?php include("includes/principal.php"); ?>
        <?php include("includes/comunes.php"); ?>
        <?php include("includes/columnaderecha.php"); ?>
        <?php include("includes/footer.php"); ?>
        <?php include("includes/contenido.php"); ?>
        <?php include("includes/listados.php"); ?>
        <?php include("includes/listadosgenerales.php"); ?>

        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

<?php if(isset($_GET['listado']) && $_GET['listado'] !== null) { ?>
        <title><? echo $title; ?></title>
        <meta name="description" content="<? echo $description ?>">
<?php } else { ?>
        <title><? echo $meta['title'] ?></title>
        <meta name="description" content="<?php echo $meta['description'] ?>">
<?php }  ?>

        <meta name="keywords" content="<?php echo $meta['keywords'] ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="verify-v1" content="lvXhAFj9OCHsUPhK2JKPrLiOptwuebDtwKK7imNJ4Rc=" />
        <meta name="google-site-verification" content="puQ3lMSi_zumD6Ed9HKGyQwoW56FVqE31CFrIyIe85Y" />

        <link rel="manifest" href="site.webmanifest">
        <link rel="apple-touch-icon" href="icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="<?=HOST?>css/normalize.css">
        <link rel="stylesheet" href="<?=HOST?>css/main.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	    <link rel="stylesheet" href="<?=HOST?>css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />

        <link rel="stylesheet" href="<?=HOST?>css/override.css">

    </head>
    <body>
        <!--
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=175502865867328";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        -->

        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <div class="container">
            <header>
                <?php main_header(); ?>
            </header>
            <section class="main_section">

            <!-- ERROR 404 Y 301 -->
            <? if(isset($_GET['error']) and $_GET['error']==404){ ?>
                    <div class="alert alert-primary" role="alert">
                    Error 404: <? echo $label[$_SESSION[idioma]]['El Articulo Ya No Existe en Nuestro Sistema, Explora Otras Opciones'] ?>
                    </div>
            <? } ?>
            <? if(isset($_GET['error']) and $_GET['error']==301){ ?>
                    <div class="alert alert-primary" role="alert">
                    Error 404: <? echo $label[$_SESSION[idioma]]['El Articulo Ya No Existe en Nuestro Sistema, Explora Otras Opciones'] ?>
                    </div>
            <? } ?>
            <!-- FIN ERROR 404 Y 301 -->

            <!-- MENSAJE DE PAYPAL -->              
                <? if(isset($_POST['custom'])){ ?>
                    <div class="alert alert-success" role="alert">
                    Tu membresia con el id: <?=$_POST['custom']?> ha sido destacada!.\n\nAhora se encontrara en la seccion 'Destacados' en portada y en los primeros resultados de las busquedas por <?=$_POST['option_selection1']?>.\n\nSe ha enviado un e-mail con los datos de tu compra al correo que diste de alta en PayPal (<?=$_POST['payer_email']?>).
                    </div>

                    <div class="alert alert-primary" role="alert">
                    Debes esperar unos minutos mientras tu solicitid es procesada para ver los cambios.\n\nGracias.
                    </div>
                <? } ?>        
            <!-- FIN MENSAJE DE PAYPAL -->     

                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12">
                    <?php

                        if (isset($_GET['listado']) && $_GET['listado'] === 'cat') {
                            echo "listados especiales";
                        } else if (isset($_GET['it_nombre']) && $_GET['id'] !== null) {
                            contenido();
                        } else if(isset($_GET['listado']) && $_GET['listado'] !== null) {
                            listadosgenerales($_GET['listado']);
                        } else {
                            principal();
                        }
                    ?>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                    <?php 
                        if (isset($_GET['it_nombre']) && $_GET['id'] !== null) {
                            promociones();
                            publicidad_derecha();
                            membresias_relacionadas();
                        } else if (isset($_GET['listado']) && $_GET['listado'] === null) {
                            filtros();
                        } else {
                            promociones();
                            publicidad_derecha();
                            // bolsa_de_trabajo();
                            membresias_mas_visitadas();
                            paginas_amigas();
                            otras_secciones();
                        }
                    ?>
                    </div>
                </div>
            </section>

            <footer>    
                <? footer(); ?>
            </footer>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

        <!-- 
        <script src="js/vendor/modernizr-{{MODERNIZR_VERSION}}.min.js"></script>
        <script src="https://code.jquery.com/jquery-{{JQUERY_VERSION}}.min.js" integrity="{{JQUERY_SRI_HASH}}" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-{{JQUERY_VERSION}}.min.js"><\/script>')</script>
         -->
        <script src="<?=HOST?>js/plugins.js"></script>
        <script src="<?=HOST?>js/main.js"></script>

        <?php if (isset($_GET['it_nombre']) && $_GET['id'] !== null) { ?>


        <script type="text/javascript"> 
            $(document).ready(function(){ 
                $('#comentarios_').maxlength(); 
            }); 
        </script>
                
        <script>
            $(document).ready(function(){ 
                $("#form-contactar").submit(function(e){
                    e.preventDefault();

                    var $form = $(this);
                    var $inputs = $form.find("input, select, button, textarea");
                    var serializedData = $form.serialize();
                    $inputs.prop("disabled", true);
                    request = $.ajax({
                        url: "./contacto/contacto-email.php",
                        type: "post",
                        data: serializedData
                    })
                    .done(function (response, textStatus, jqXHR){
                        response = JSON.parse(response);
                        alert(response.msg);
                    })
                    .fail(function (jqXHR, textStatus, errorThrown){
                        console.error(
                            "The following error occurred: "+
                            textStatus, errorThrown
                        );
                    })
                    .always(function () {
                        $inputs.prop("disabled", false);
                    });
                });
            }); 
        </script>

	    <script type="text/javascript" src="<?=HOST?>js/jquery.maxlength-min.js"></script>
	    <script src="<?=HOST?>js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>

        <script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyAbAjqtjoZv3JPUupkEWkQ2Xbqx5ZlwXU8&callback=initMap'></script>
        <!-- <script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAUerinaHtBTOP9BSS-H8i0BRTIYXhwconXZbP5t0_ETgcwBr8hhRoIss7KjjHSQqj4CNWtsxYu3xCOw" type="text/javascript"></script>-->
        <?php } ?>

        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID.
        <script type="text/javascript">
            var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
            document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
        </script> 
        <script type="text/javascript">
            try {
            var pageTracker = _gat._getTracker("UA-10015835-1");
            pageTracker._trackPageview();
            } catch(err) {}
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async defer></script>
         -->
    </body>
</html>
