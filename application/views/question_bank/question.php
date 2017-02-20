<div class="body">
<h1>考试系统</h1>
<?php
$num = 0;
$xu  = 0;
foreach ($ti as $temp) 
{
foreach ($temp as $value) 
{
// var_dump($value);
{
$num ++;
if($value['multi'] == "N")
{

echo '<div class="d_select">';
echo '<div class="d_test">';
echo '<div class="test">';
echo '<span>'.$num	.'</span>';
echo "<div>";
echo '<label for ="'.$value['id'] .'">'. $value['title'].'</label><hr/>';
echo '<label for =  "myradio'.$num.'_'.$xu.'"><input type="radio" class = "radio" id = "myradio'.$num.'_'.$xu.'" name="'.$value['id'] .'" value = "A"/>'.$value['Options_A'].'<hr/>'.'</label>';
$xu ++;
echo '<label for =  "myradio'.$num.'_'.$xu.'"><input type="radio" class = "radio" id = "myradio'.$num.'_'.$xu.'" name="'.$value['id'] .'" value = "B"/>'.$value['Options_B'].'<hr/>'.'</label>';
$xu ++;
echo '<label for =  "myradio'.$num.'_'.$xu.'"><input type="radio" class = "radio" id = "myradio'.$num.'_'.$xu.'" name="'.$value['id'] .'" value = "C"/>'.$value['Options_C'].'<hr/>'.'</label>';
// $xu ++;
// echo '<label for =  "myradio'.$num.'_'.$xu.'"><input type="radio" id = "myradio'.$num.'_'.$xu.'" name="'.$value['id'] .'"value = "D"/>'.$value['Options_D'].'<hr/>'.'</label>';
echo "</div></div></div></div>";
}
elseif($value['multi'] == "Y")
{
echo '<div class="f_select">
<h3>多选题</h3>
<div class="f_test">
<div class="test">
<span>11</span>
<div>
<p>    --!  题目  !--   </p>
<br>';
// echo $value['Options_E'];
// exit();
echo '<label for =  "mycheckbox'.$num.'_'.$xu.'"><label for ="'.$value['id'] .'">'. $value['title'].'（多选）</label><hr/>';
echo '<input type="checkbox" class="checkbix" name="'.$value['id'] .'[]" value = "A"/>'.$value['Options_A'].'<hr/>';
echo '<input type="checkbox" class="checkbix" name="'.$value['id'] .'[]" value = "B"/>'.$value['Options_B'].'<hr/>';
echo '<input type="checkbox" class="checkbix" name="'.$value['id'] .'[]" value = "C"/>'.$value['Options_C'].'<hr/>';
echo '<input type="checkbox" class="checkbix" name="'.$value['id'] .'[]" value = "D"/>'.$value['Options_D'].'<hr/>';
if(isset($value['Options_E']))
echo '<input type="checkbox" class="checkbi	x" name="'.$value['id'] .'[]" value = "E"/>'.$value['Options_E'].'<hr/>';
if(isset($value['Options_F']))
echo '<input type="checkbox" class="checkbix" name="'.$value['id'] .'[]" value = "F"/>'.$value['Options_F'].'<hr/>';
if(isset($value['Options_G']))
echo '<input type="checkbox" class="checkbix" name="'.$value['id'] .'[]" value = "G"/>'.$value['Options_G'].'<hr/>';
if(isset($value['Options_H']))
echo '<input type="checkbox" class="checkbix" name="'.$value['id'] .'[]" value = "H"/>'.$value['Options_H'].'<hr/>';
echo '
</div>
</div>
</div>
</div>
</div>
';
}
}
}
}
?>
<div class="b_score">
	<button class="show-layer" onclick="y()" data-show-layer="hw-layer" role="button">提交</button>
</div>
		<div id="time">
		<h5>所剩时间：</h5>
		<p>&nbsp;</p>
		<font id="resttime" align="center"  color = "#ff0000"></font>
		<p>分钟</p>
		</div>

