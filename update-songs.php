<?php
//if($_POST['adminname'] == '919387' && $_POST['adminpassword'] == 'sunithak'){
error_reporting(E_ALL);

$host = 'localhost';

$database = 'kannadar_remix';

$username = 'kannadar_remix';

$password = 'Sunithak@123';

try{
$pdo = new PDO("mysql:host=$host;dbname=$database;",$username,$password);
}catch(Exception $e){
	echo $e->getMessage();
}

// get all categories

$sql = "SELECT * FROM categories";

$sql = $pdo->prepare($sql);
try{
$sql->execute();
}catch(Exception $e){
	echo $e->getMessage();
}

$catRes = $sql->fetchAll();



//get all albums 

$sql = "SELECT * FROM albums order by id desc";

$sql = $pdo->prepare($sql);

$sql->execute();

$albRes = $sql->fetchAll();

if(isset($_POST))@extract($_POST);

	// save categories

	if(isset($categorysubmit)){

		$sql = "INSERT INTO categories (name) VALUES ('$categoryname')";

		$sql = $pdo->prepare($sql);

		$r = $sql->execute();

		if($r)$catMsg = '<font color="GREEN"><b>UPDATE SUCCESSFULL: $categoryname </b></font>';else $catMsg = '<font color="RED"><b>UPDATE FAILED</b></font>';

	}

	

	// save album

	if(isset($albumsubmit)){

		$sql = "INSERT INTO albums (category,name,author,image) VALUES ($category,'$album','$author','')";

		$sql = $pdo->prepare($sql);

		if ( ! $sql->execute())$done = 0;else $done = 1;

		$row = $sql->rowCount();

		$newId = $pdo->lastInsertId();

		if(isset($_FILES['image'])){

			if(mkdir('images/albums/'.$newId.'/',0777)){

				$uploadDir='images/albums/'.$newId.'/';

				$tmp_name = $_FILES["image"]["tmp_name"];

				$newName = explode('.',$_FILES['image']['name']);

				$newFileName = $uploadDir.'a_art.'.$newName[1];

				if(move_uploaded_file($tmp_name, $newFileName)){
				
					$sql = "UPDATE albums SET image = '".$newFileName."' WHERE id = ".$newId;

					$sql = $pdo->prepare($sql);
			
					if ( ! $sql->execute())$done = 0;else $done = 1;
					
				}
			}

			else

			{

				echo 'DIRECTORY CREATION FAILED';

			}

		}

		if($done>0)$albMsg = '<font color="GREEN"><b>UPDATE SUCCESSFULL: $album </b></font>';else $albMsg = '<font color="RED"><b>UPDATE FAILED</b></font>';

	}

	

	// save songs

	if(isset($songsubmit)){

		$slink = explode('=',$link);
		$song = ucwords(strtolower($song));
		$author = ucwords(strtolower($author));
		$sql = "INSERT INTO songs (album,name,author,slink) VALUES ($album,'$song','$author','$slink[1]')";

		$sql = $pdo->prepare($sql);

		if ( ! $sql->execute())$done = 0;else $done = 1;

		if($done>0)$sngMsg = '<font color="GREEN"><b>UPDATE SUCCESSFULL: $album </b></font>';else $sngMsg = '<font color="RED"><b>UPDATE FAILED</b></font>';

	}

?>



<style>

td{

 padding:25px;

 width:33%;

 

}

select, input, button{

 width:100%;

 padding:10px;

}

</style>

<center>

<h3>UDPATE DATA</h3>

<table>

	<tr>

		<th width="33%"> UPDATE CATEGORY </th>

		<th width="33%"> UPDATE NEW ALBUM </th>

		<th width="33%"> UPDATE SONGS </th>

		

	</tr>

	<tr>

	

	

	

		<td>

			<form method="post" action="" name="update-category"  runat="server" style="margin:0 auto;">

				<input type="text" placeholder="Category Name" name="categoryname" /><br>

				<span style="width:100%;"><?php echo isset($catMsg)?$catMsg:'';?></<br>

				<button name="categorysubmit">Save</button>

			</form>

		</td>

		

		

		

		

		

		<td>

			<form method="post" action="" name="update-album"  runat="server" style="margin:0 auto;" enctype="multipart/form-data">

				<select name="category">

					<option value="" selected="selected" disabled="disabled" readonly="readonly">Select Category</option>

				<?php foreach($catRes as $res){?>	

					<option value="<?php echo $res['id'];?>"><?php echo $res['name'];?></option>

				<?php }?>		

				</select><br>

				<input type="text" placeholder="Album Name" name="album" /><br>

				<input type="text" placeholder="Album Author Name" name="author" /><br>

				<input type="file" placeholder="Album Image" name="image" /><br>

				<span style="width:100%;"><?php echo isset($albMsg)?$albMsg:'';?></<br>

				<button name="albumsubmit">Save</button>

			</form>

		</td>

		

		

		

		

		

		

		<td>

			<form method="post" action="" name="update-songs"  runat="server" style="margin:0 auto;"  enctype="multipart/form-data">

				<!--<select name="category">

					<option value="" selected="selected" disabled="disabled" readonly="readonly">Select Category</option>

				<?php foreach($catRes as $res){?>	

					<option value="<?php echo $res['id'];?>"><?php echo $res['name'];?></option>

				<?php }?>		

				</select><br>-->

				<select name="album">

					<option value="" selected="selected" disabled="disabled" readonly="readonly">Select Album</option>

				<?php foreach($albRes as $res){?>	

					<option value="<?php echo $res['id'];?>"><?php echo $res['author'];?> &emsp;&emsp;&emsp; <?php echo $res['name'];?></option>

				<?php }?>		

				</select><br>

				<input type="text" placeholder="Song Name" name="song" /><br>

				<input type="text" placeholder="Song Author Name" name="author" /><br>

				<input type="text" placeholder="Song Link" name="link" /><br>

				<!--<input type="file" placeholder="Song Image" name="image" /><br>-->

				<span style="width:100%;"><?php echo isset($sngMsg)?$sngMsg:'';?></<br>

				<button name="songsubmit">Save</button>

			</form>

		</td>

		

		

		

		

	</tr>

</table>
</center>

<?php /*}else{?>
<center>
<form action="" method="post">
<h3>KRMP ADMIN LOGIN</h3>
<input type="password" name="adminname" />
<input type="password" name="adminpassword" />
<button type="submit" name="submit"></button>
</form> 
</center>
<?php }*/?>


