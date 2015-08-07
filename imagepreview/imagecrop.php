<html>
	<head>
		<title>Image Preview</title>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<link  href="https://cdn.rawgit.com/fengyuanchen/cropper/v0.10.1/dist/cropper.min.css" rel="stylesheet">		
		<style>
			#preview{
				
			}
		</style>
	</head>
	<body>
		<form class="upload-crop-image-form" enctype="multipart/form-data">
			x:<input name="x" type="text"> <br>
			y:<input name="y" type="text"> <br>   
			width:<input name="width" type="text">   <br>
			height:<input name="height" type="text">    <br>
			rotate:<input name="rotate" type="text"><br>
		
		<input type="file" name="myImage" multiple="true" id="myImage">
		

		<div class="row">
		  <div class="col-xs-6 col-md-3">
		  <div id="photo-controls" class="mb10" style="display: none">
		          <div class="docs-toolbar">
		            <div class="btn-group">
		              <button class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In" type="button">
		                <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Zoom In">
		                  <span class="glyphicon glyphicon-zoom-in"></span>
		                </span>
		              </button>
		              <button class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out" type="button">
		                <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Zoom Out">
		                  <span class="glyphicon glyphicon-zoom-out"></span>
		                </span>
		              </button>
		              <button class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate Left" type="button">
		                <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Rotate Right">
		                  <span class="glyphicon glyphicon-repeat docs-flip-horizontal"></span>
		                </span>
		              </button>
		              <button class="btn btn-primary" data-method="rotate" data-option="90" title="Rotate Right" type="button">
		                <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Right Left">
		                  <span class="glyphicon glyphicon-repeat"></span>
		                </span>
		              </button>
		            </div>
		            <button class="btn-xs btn-primary" id="crop">Crop</button>
		          </div>
		      </div>

		    <a href="#" class="thumbnail">
		     <div id="preview"></div>
		    </a>
		  </div>
		 
		</div>
		<!-- <input type="submit" value="Upload Image" class="btn btn-primary"> -->
		</form>
	</body>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="jPreview.min.js"></script>
	<script src="loadImage.js"></script>

<script src="https://cdn.rawgit.com/fengyuanchen/cropper/v0.10.1/dist/cropper.min.js"></script>
	<script src="bstrp-filestyle.js"></script>
	<script>
	$(":file").filestyle({
		input:false
	
	});
	

	$("#myImage").on("change",function(e){

		loadImage(e.target.files[0],function(img){
			
			$("#preview").html(img);

			$("#preview canvas").cropper({
                        /*aspectRatio: 7 / 9,*/
                        dashed: false,
                        zoomable: true,
                        resizable: true,
                        done: function(data) {
                            // Crop image with the result data.
                        }
                    });
			$("#photo-controls").show();

		},{maxWidth:285,canvas:true});

		$("#preview").css({
			height:"300px",
			width:"auto"

		});
	});

	$("#crop").click(function(e){
		e.preventDefault();
		var canvase=$("#preview canvas").cropper('getCroppedCanvas');
		console.log(canvase);
		$("#preview").html(canvase);


		  var cropData = $('#photo-container canvas').cropper("getData");
        var $form = $('.upload-crop-image-form');

        // if no crop data - perhaps unsupported browser
        if(cropData.length === 0)
        {
            cropData = {x: 0, y: 0, width: -1, height: -1, rotate: 0}
        }
        $form.find('input[type=text]').each(function(index, el){
            if(['x', 'y', 'width', 'height', 'rotate'].indexOf(el.name) !== -1)
            {
                $(el).val(cropData[el.name]);
                console.log($(el).val());
            }
        });
    });

	$(document).on("click", "[data-method]", function () {
        var data = $(this).data();
        var $image = $('#photo-container canvas');
        data.method && $image.cropper(data.method, data.option);
    });

    $('form').on('submit', function(e){
    	
    });


  
	</script>
</html>
