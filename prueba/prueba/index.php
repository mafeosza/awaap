<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>A Simple Page with CKEditor</title>
        <!-- Make sure the path to CKEditor is correct. -->
		<script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
        <script type="text/javascript" src="ckfinder/ckfinder.js"></script>
        <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
    </head>
    <body>
        <form>
            <textarea cols="10" id="editor2" name="editor2" rows="10" >&lt;p&gt;This is some &lt;strong&gt;sample text&lt;/strong&gt;. You are using &lt;a href="http://ckeditor.com/"&gt;CKEditor&lt;/a&gt;.&lt;/p&gt;
	</textarea>
	<script type="text/javascript">
		window.onload = function (){
			editor = CKEDITOR.replace("editor2",
				{filebrowserImageBrowseUrl: '/prueba/ckfinder/ckfinder.html'}
				);
			CKFinder.setupCKEditor(editor,'/prueba/ckfinder')

		}
	</script>
	</script>
        </form>
    </body>
</html>