<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
 
    <!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
 
    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.0/css/froala_style.min.css" rel="stylesheet" type="text/css" />
    <!-- CSS rules for styling the element inside the editor such as p, h1, h2, etc. -->
    <link src="../js/froala_editor_2.7.0/css/froala_style.min.css" rel="stylesheet" type="text/css" />

  </head>
 
  <body>
    <!-- Create a tag that we will use as the editable area. -->
    <!-- You can use a div tag as well. -->
    <div>
        <form name="formulario" method="POST" action="">
            <textarea type="text" id="texto" name="texto" placeholder="" class="input-xlarge">
                
            </textarea>
            <div class = "container-fluid text-center">
                <!-- Button -->
                <div class="controls">
                    <button class="btn btn-success">Siguiente</button>
                </div>
                                
            </div>
        </form>
    </div>
    <!-- Include external JS libs. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
 
    <!-- Include Editor JS files. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.0/js/froala_editor.pkgd.min.js"></script>
    
    <script type="text/javascript" src="../js/froala_editor_2.7.0/js/languages/es.js"></script>

    <!-- Initialize the editor. -->
    <script> 
        $(function() { $('#texto').froalaEditor({
            language: 'es',
            imageUploadParam: 'image_param',
            imageUploadURL: '../controladores/demoControlador.php',
            imageUploadMethod: 'POST'})
            .on('froalaEditor.image.uploaded', function (e, editor, response) {
                // Image was uploaded to the server.
                console.log(response);
            })
            .on('froalaEditor.image.error', function (e, editor, error, response) {
                console.log(error.code);            
            });
        }); 
    </script>
  </body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] =='POST') {
        $texto = filter_var($_POST['texto'], FILTER_SANITIZE_STRING);
        #print_r($texto);
    }
?>