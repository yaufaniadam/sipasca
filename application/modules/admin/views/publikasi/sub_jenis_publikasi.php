<?php
$sql = $this->db->query("select * from sub_jenis_publikasi where id_jenis_publikasi='".$_GET['kode']."'");	
?>




<?php
if($_GET['kode']==3)
{
?>

<input name="sub_jenis_publikasi_text" type="text" required class="form-control">
<?php
}
else
{

?>

<select   name="id_sub_jenis_publikasi" required class="form-control" >
<option value="">Pilih..</option>
<?php
 
foreach($sql->result_array() as $a)
{
?>			
 <option value="<?=$a['id_sub_jenis_publikasi'];?>"><?=$a['sub_jenis_publikasi'];?></option>
<?php
}
?>
</select>
<?php
}
?>