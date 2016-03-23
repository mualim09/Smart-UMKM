 <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">


<?php if(!isset($_GET['q'])):?>

<center><form name="form1" method="get" action=""> 
<table><td></td><td><input tyoe ="text" name="q" rows="1" id="q"></td><td><input class="btn  btn-success" type="submit" value="Search"/></td>
</table>
</form> </center>

<div id="result"></div>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
	var allow = true;
	$(document).ready(function(){
		$("#q").keyup(function(e){
			if(e.which == '13'){
				e.preventDefault();
					
				loadData();
			}else if($(this).val().length >= 0){
					
				loadData();
			}
		});
	});
	function loadData(){
	var query=document.getElementById('q').value;
		if(allow){
			allow = false;
			$("#result").html('loading...');
			$.ajax({
				url:'cari.php?q='+query,
				success:
					function (data){
					$("#result").html(data);
					allow = true;
				}
			});
		}
	}
</script>
<?php endif;?>
<style>
.highlight
{
background: #CEDAEB;
}

.highlight_important
{
background: #9afa95;
}
</style>

<?php 
//Fungsi Mark Teks
function hightlight($str, $keywords = '')
{
$keywords = preg_replace('/\s\s+/', ' ', strip_tags(trim($keywords))); // filter

$style = 'highlight';
$style_i = 'highlight_important';

/* Apply Style */

$var = '';

foreach(explode(' ', $keywords) as $keyword)
{
$replacement = "<span class='".$style."'>".$keyword."</span>";
$var .= $replacement." ";

$str = str_ireplace($keyword, $replacement, $str);
}
$str = str_ireplace(rtrim($var), "<span class='".$style_i."'>".$keywords."</span>", $str);
return $str;
}

//END Fungsi Mark Teks
if(isset($_GET['q']) && $_GET['q']){ 
 $conn =   mysql_connect("localhost", "root", ""); 
 mysql_select_db("umkm"); 
 $q = $_GET['q'];
 
//Menghitung Jumlah Yang Tampil 

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 6;
$mulai_dari = $limit * ($page - 1);
$sqlCount = "select count(id_user) from login where id_user like '%$q%' or id_user like '%$q%' or nama_umkm like '%$q%' ";
$rsCount =   mysql_fetch_array(  mysql_query($sqlCount));
$banyakData = $rsCount[0];
$sql = "select * from login where id_user like '%$q%' or id_user like '%$q%' or nama_umkm like '%$q%' order by id_user DESC limit $mulai_dari, $limit"; 
//Akhir Menghitung Jumlah Yang Tampil 
 $result =   mysql_query($sql);
 

 if(  mysql_num_rows($result) > 0){ 
 ?> 
 <?php if(isset($_GET['page'])):?>
<form name="form1" method="get" action=""> 
<table><td></td><td><textarea name="q" rows="1" id="q"></textarea></td><td><input type="submit" value="Cari"/></td>
</table>
</form> 
 <?php endif;?>
 <center><table border="1" width="700px"><tr bgcolor="silver"><td>ID UMKM</td><td>Nama UMKM</td><td>Nama Pemilik
 </td><td>Alamat</td><td>Jenis Usaha</td><td>Aksi</td></tr>
 <?php 
 while($row =   mysql_fetch_array($result)){?> 
 <tr> 
 <td><?php echo hightlight($row['id_user'],$q);?></td> 
 <td><?php echo hightlight($row['nama_umkm'],$q);?></td> 
 <td><?php echo hightlight($row['nama_pemilik'],$q);?></td>
 <td><?php echo hightlight($row['alamat'],$q);?></td>
 <td><?php echo hightlight($row['jenis_usaha'],$q);?></td>
 
 <td><a href="ubah.php?id_user='.$row['id_user'].'" title="Rubah Data"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
 <a href="index.php?aksi=delete&id_user='.$row['id_user'].'" title="Hapus Data" onclick="return confirm(\'Yakin?\')">
 	<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
</td>

  
 <td><?php 
 
  ?></td> 
 </tr> 
 <?php }?> 
 </table> </center>
 <?php 
 }else{ 
 echo 'Data Tidak Ada'; 
 } 
 //Halaman
 $banyakHalaman = ceil($banyakData / $limit);
echo '</br><div id="page" style="font-size:17px">Halaman: ';
for($i = 1; $i <= $banyakHalaman; $i++){
 if($page != $i){
 echo '  [<a href="cari.php?page='.$i.'&q='.$q.'">'.$i.'</a>]  ';
 }else{
 echo "[<span style='color:silver'>$i</span>] ";
 }
}
echo '&nbsp&nbsp<a href="index.php"><b>Ulangi Pencarian</b></a>';
//END HALAMAN
} 


?>