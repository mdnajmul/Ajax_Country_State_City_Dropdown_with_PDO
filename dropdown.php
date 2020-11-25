<?php

    include('db.php');
    $sql="SELECT id,name FROM country";
    $stmt=$con->prepare($sql);
    $stmt->execute();
    $arrCity=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>PHP Ajax Country State City Dropdown.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h1>PHP Ajax Country State City Dropdown</h1>
		<form>
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label for="country">Country</label>
						<select class="form-control" id="country">
							<option value="-1">Select Country</option>
							<?php
                                foreach($arrCity as $country){
                                    ?>
                                    <option value="<?php echo $country['id']?>"><?php echo $country['name']?></option>
                                    <?php
                                }
                            ?>
						</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label for="state">State</label>
						<select class="form-control" id="state">
							<option>Select State</option>
						</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label for="city">City</label>
						<select class="form-control" id="city">
							<option>Select City</option>
						</select>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div id="divLoading"></div>
	<style>
	#divLoading	{
		display : none;
	}
	#divLoading.show{
		display : block;
		position : fixed;
		z-index: 100;
		background-image : url('img/ajax-loader.gif');
		background-color:#666;
		opacity : 0.4;
		background-repeat : no-repeat;
		background-position : center;
		left : 0;
		bottom : 0;
		right : 0;
		top : 0;
	}
	#loadinggif.show {left : 50%;
		top : 50%;
		position : absolute;
		z-index : 101;
		width : 32px;
		height : 32px;
		margin-left : -16px;
		margin-top : -16px;
	}
	</style>
	
	<script>
        $(document).ready(function(){
            
            $('#country').change(function(){
                var id=$(this).val();
                if(id=='-1'){
                  $('#state').html('<option value="-1">Select State</option>');
                  $('#city').html('<option value="-1">Select City</option>'); 
                }else{
                    $('#divLoading').addClass('show');
                    $('#state').html('<option value="-1">Select State</option>');
                    $('#city').html('<option value="-1">Select City</option>'); 
                    $.ajax({
                        url:'get_data.php',
                        type:'post',
                        data:'id='+id+'&type=state',
                        success:function(result){
                            $('#divLoading').removeClass('show');
                            $('#state').append(result);
                        }
                    });
                }
            });
            
            $('#state').change(function(){
                var id=$(this).val();
                if(id=='-1'){
                  $('#city').html('<option value="-1">Select City</option>');  
                }else{
                    $('#divLoading').addClass('show');
                    $('#city').html('<option value="-1">Select City</option>');
                    $.ajax({
                        url:'get_data.php',
                        type:'post',
                        data:'id='+id+'&type=city',
                        success:function(result){
                            $('#divLoading').removeClass('show');
                            $('#city').append(result);
                        }
                    });
                }
            });
            
        });
    </script>

</body>
</html>