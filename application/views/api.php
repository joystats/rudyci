<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Welcome to Rest API by CodeIgniter</title>
<style type="text/css">

</style>
</head>
<body>

<div id="container">
	<h1>Rest API by CodeIgniter</h1>
	<ul>
		<li><a href="<?=base_url();?>index.php/api/rudy">Rudy</a></li>
		<li><a href="<?=base_url();?>index.php/api/map">Restaurants in Bangsue</a></li>
		<li><a href="<?=base_url();?>index.php/api/find?q=x">Find X, Y, Z or any by q={any}</a></li>
		<li><a href="<?=base_url();?>index.php/api/testCache">ตัวอย่าง Test Cache ที่ใช้</a></li>
		<li>Line Messaging API. <br/>
			<ul>
				<li>1. เพิ่มเพื่อน bot id : @586borrp</li>
				<li>2. ส่งข้อความหา bot เช่น สวัสดีครับ</li>
				<li>3. ส่งข้อความหา bot ที่มีคำว่า "ข้อมูลบริษัท" เช่น ขอข้อมูลบริษัทครับ</li>
			</ul>
			<br/>
			<br/>
			<img src="<?=base_url();?>images/screenshot.jpg">
		</li>
	</ul>
</div>

</body>
</html>
